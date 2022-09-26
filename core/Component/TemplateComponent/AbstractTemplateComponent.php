<?php

namespace Core\Component\TemplateComponent;

use League\Plates\Engine as View;

class AbstractTemplateComponent
{

    protected string $templateFile;
    protected array $templateData;
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function render($templateFile = null, array $templateData = null): string
    {
        if(!$templateFile)
        {
            $templateFile = $this->templateFile;
        }
        if(!$templateData)
        {
            $templateData = $this->templateData;
        }
     return $this->view->render($templateFile,$templateData);
    }

}