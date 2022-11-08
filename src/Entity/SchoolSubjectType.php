<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class SchoolSubjectType
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $label;
    protected ?string $description;

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
     * @return SchoolSubjectType
     */
    public function setLabel(string $label): SchoolSubjectType
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SchoolSubjectType
     */
    public function setDescription(string $description): SchoolSubjectType
    {
        $this->description = $description;
        return $this;
    }

}
