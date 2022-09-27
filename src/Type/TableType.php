<?php

namespace App\Type;

use Core\Component\TemplateComponent\AbstractTemplateComponent;
use Core\Component\TemplateComponent\TemplateComponentInterface;

class TableType extends AbstractTemplateComponent implements TemplateComponentInterface
{
    protected string $templateFile = 'app/table/_table.html';

}