<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class Topic
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $title;
    protected ?string $description;

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Topic
     */
    public function setTitle(string $title): Topic
    {
        $this->title = $title;
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
     * @param string|null $description
     * @return Topic
     */
    public function setDescription(?string $description): Topic
    {
        $this->description = $description;
        return $this;
    }

}
