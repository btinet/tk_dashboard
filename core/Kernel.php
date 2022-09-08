<?php
/*
 * Copyright (c) 2022. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Core;

use Core\Component\ConfigComponent\Config;
use Core\ErrorHandler\Exception\KernelException;
use Core\ErrorHandler\ExceptionHandler;
use Exception;
use Symfony\Component\Yaml\Yaml;

final class Kernel
{


    private static array $routes = array();
    private array $plainRoutes = array();
    private static ?string $pathNotFound = null;
    private static ?string $methodNotAllowed = null;
    protected Config $config;


    /**
     * Class-Konstruktor. Eine spezielle Methode, die bei der Instanziierung einer Klasse automatisch aufgerufen wird.
     */
    public function __construct()
    {
        /**
         * Routen auslesen und im Property $plainRoutes speichern.
         */
        self::setPlainRoutes(Yaml::parseFile(project_root.'/config/routes.yaml'));
        /**
         * Environment-Variablen auslesen und in $config-Variable als Array speichern.
         */
        $this->config = new Config('config/env.yaml');
    }

    /**
     * @return array
     */
    public function getPlainRoutes(): array
    {
        return $this->plainRoutes;
    }

    /**
     * @param array|mixed $plainRoutes
     */
    public function setPlainRoutes($plainRoutes): void
    {
        $this->plainRoutes = $plainRoutes;
    }

    /**
     * Methode zum Hinzufügen einer Route
     * @param string $expression Route string or expression
     * @param callable $function Function to call if route with allowed method is found
     * @param string|array $method Either a string of allowed method or an array with string values
     *
     */
    public function add(string $expression, callable $function, $method = 'get'): Kernel
    {
        self::$routes[] = array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        );
        return $this;
    }

    public function getAll(): array
    {
        return self::$routes;
    }

    public function pathNotFound($function)
    {
        self::$pathNotFound = $function;
    }

    public function methodNotAllowed($function)
    {
        self::$methodNotAllowed = $function;
    }

    /**
     * @param string $basePath
     * @param bool $case_matters
     * @param bool $trailing_slash_matters
     * @param bool $multimatch
     * @return void
     */
    public function run(string $basePath = '', bool $case_matters = false, bool $trailing_slash_matters = false, bool $multimatch = false)
    {

        // The basepath never needs a trailing slash
        // Because the trailing slash will be added using the route expressions
        $basePath = rtrim($basePath, '/');

        // Parse current URL
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = '/';

        // If there is a path available
        if (isset($parsed_url['path'])) {
            // If the trailing slash matters
            if ($trailing_slash_matters) {
                $path = $parsed_url['path'];
            } else {
                // If the path is not equal to the base path (including a trailing slash)
                if ($basePath . '/' != $parsed_url['path']) {
                    // Cut the trailing slash away because it does not matters
                    $path = rtrim($parsed_url['path'], '/');
                } else {
                    $path = $parsed_url['path'];
                }
            }
        }

        $path = urldecode($path);

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;

        $route_match_found = false;

        foreach (self::$routes as $route) {

            // If the method matches check the path

            // Add basepath to matching string
            if ($basePath != '' && $basePath != '/') {
                $route['expression'] = '(' . $basePath . ')' . $route['expression'];
            }

            // Add 'find string start' automatically
            $route['expression'] = '^' . $route['expression'];

            // Add 'find string end' automatically
            $route['expression'] = $route['expression'] . '$';

            // Check path match
            if (preg_match('#' . $route['expression'] . '#' . ($case_matters ? '' : 'i') . 'u', $path, $matches)) {
                $path_match_found = true;

                // Cast allowed method to array if it's not one already, then run through all methods
                foreach ((array)$route['method'] as $allowedMethod) {
                    // Check method match
                    if (strtolower($method) == strtolower($allowedMethod)) {
                        array_shift($matches); // Always remove first element. This contains the whole string

                        if ($basePath != '' && $basePath != '/') {
                            array_shift($matches); // Remove basepath
                        }

                        if ($return_value = call_user_func_array($route['function'], $matches)) {
                            echo $return_value;
                        }

                        $route_match_found = true;

                        // Do not check other routes
                        break;
                    }
                }
            }

            // Break the loop if the first found route is a match
            if ($route_match_found && !$multimatch) {
                break;
            }

        }

        // No matching route was found
        if (!$route_match_found) {
            // But a matching path exists
            if ($path_match_found) {
                if (self::$methodNotAllowed) {
                    call_user_func_array(self::$methodNotAllowed, array($path, $method));
                }
            } else {
                if (self::$pathNotFound) {
                    call_user_func_array(self::$pathNotFound, array($path));
                }
            }

        }
    }

    /**
     * @param $class
     * @param $method
     * @param array $mandatory
     * @return false|mixed
     */
    private function runControllerMethod($class, $method, array $mandatory = array())
    {
        if (!class_exists($class))throw new KernelException(sprintf('Class "%s" not found.',$class));
        $class = new $class;
        if(!method_exists($class,$method))throw new KernelException(sprintf('Method "%s" not found.',$method));
        if(!is_callable([$class,$method])) throw new KernelException(sprintf('Method "%s" not callable.',$method));

        return call_user_func_array(array($class, $method), $mandatory);
    }

    /**
     * @throws Exception
     */
    private function setNotFoundController()
    {
        if(!isset($_ENV['NOTFOUND_CONTROLLER']))
        {
            throw new Exception('NOTFOUND_CONTROLLER: is not set in env.yaml');
        }
        return $_ENV['NOTFOUND_CONTROLLER'];
    }


    /**
     * Methode zum Hinzufügen der Routen aus dem Array $plainRoutes
     * @return $this
     */
    public function addRoutes(): Kernel
    {
        foreach (self::getPlainRoutes() as $route)
        {
            self::add($route['expression'], function () use ($route) {
                $arguments = func_get_args();
                try {
                    return self::runControllerMethod($route['controller'], $route['method'], $arguments);
                } catch (KernelException $e) {
                    $exceptionHandler =  new ExceptionHandler($e);
                    $exceptionHandler->renderView();
                    exit;
                }
            }, $route['request']);
        }
        return $this;
    }

    public function addNotFound(): Kernel
    {
        self::pathNotFound(function() {
            header('HTTP/1.0 404 Not Found');
            try {
                $controller = self::setNotFoundController();
                return self::runControllerMethod($controller,'notFound',func_get_args());
            } catch (KernelException $e) {
                $exceptionHandler =  new ExceptionHandler($e);
                return $exceptionHandler->getException()->getMessage();
            }
        });
        return $this;
    }

}
