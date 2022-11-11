<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class ExamStatus
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $label;

    public function __toString()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return ExamStatus
     */
    public function setLabel(string $label): ExamStatus
    {
        $this->label = $label;
        return $this;
    }

}
