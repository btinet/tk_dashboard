<?php

namespace Core\Component\TemplateComponent;

use League\Plates\Engine as View;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

abstract class AbstractTemplateComponent
{

    protected string $templateFile;
    protected array $fields;
    protected array $templateData;
    private View $view;
    protected HtmlComponentFactory $componentFactory;
    /**
     * @var array $data
     */
    protected array $data;

    private ReflectionClass $reflectionClass;
    private ReflectionProperty $reflectionProperty;
    private $entity;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function configureComponent(string $entity): self
    {
        try {
            $this->reflectionClass = new ReflectionClass($entity);
            if(class_exists($entity)){
                $this->entity = new $entity;
            } else {
                die('Class nicht aufrufbar!');
            }

        } catch (ReflectionException $e) {
            die('Fehler');
        }

        return $this;
    }

    public function add(string $field): self
    {
        try {
            $reflectionProperty = new ReflectionProperty($this->entity, $field);
            if($reflectionProperty->isProtected()){
                $field = ucfirst($field);
                $getProperty = "get$field";
                $this->fields['fields'][] = $field;
            }
        } catch (ReflectionException $e) {
            die('Fehler');
        }

        return $this;
    }

    public function setData(array $data):self
    {
        $this->data = $data;
        return $this;
    }

    public function render($templateFile = null, array $templateData = null): string
    {
        if(!$templateFile)
        {
            $templateFile = $this->templateFile;
        }

        if(!$templateData)
        {
            $this->addTemplateData($this->fields);
            $templateData = $this->templateData;
        }


     return $this->view->render($templateFile,$templateData);
    }

    /**
     * @return string
     */
    public function getTemplateFile(): string
    {
        return $this->templateFile;
    }

    /**
     * @param string $templateFile
     * @return AbstractTemplateComponent
     */
    public function setTemplateFile(string $templateFile): AbstractTemplateComponent
    {
        $this->templateFile = $templateFile;
        return $this;
    }

    public function addTemplateData(array $data): self
    {
        foreach ($data as $key => $value)
        {
            $this->templateData[$key] = $value;
        }
        return $this;
    }

}