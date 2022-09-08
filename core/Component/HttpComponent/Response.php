<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Component\HttpComponent;

use Core\Component\ConfigComponent\RouteConfig;
use Core\ErrorHandler\Exception\ResponseException;

class Response
{
    protected RouteConfig $config;
    protected string $parsedRoute;

    public function __construct(RouteConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param $status
     * @param $url
     */
    public function redirect($status, $url = null)
    {
        header('Location: ' .$this->getProtocol().$_SERVER['HTTP_HOST'].'/'.$url, true, $status);
        exit;
    }

    public function generateUrlFromRoute(string $route, array $mandatory = null,$anchor = null): string
    {
        $routeData = $this->config->getRoute($route);
        $routeExpression = ltrim($routeData['expression'],'/');
        $routeArray = explode('/',$routeExpression);


        $k = 0;
        foreach($routeArray as $key => $value)
        {
            if($value === '([0-9]*)' or $value === '([a-z]*)' )
            {
                if (!isset($mandatory[$k])){
                    $k++;
                    $mandatoryCount = count($mandatory);
                    throw new ResponseException(sprintf('Missing mandatory "%s".',$k),$route);
                }
                $routeArray[$key] = $mandatory[$k];
                $k++;
            }
        }
        $this->parsedRoute = '/'.implode('/',$routeArray);


        if($anchor){
            $route .= "#$anchor";
        }
        return $this->getProtocol().$_SERVER['HTTP_HOST'].$this->parsedRoute;
    }

    public function generateUrlFromString(string $route, array $mandatory = null,$anchor = null): string
    {
        if ($mandatory) {
            foreach ($mandatory as $name => $value) {
                $route .= "/$value";
            }
        }
        if($anchor){
            $route .= "#$anchor";
        }
        return $this->getProtocol().$_SERVER['HTTP_HOST'].$route;
    }

    private function getProtocol(): string
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    }

}
