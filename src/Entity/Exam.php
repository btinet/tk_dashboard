<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

final class Exam
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected string $keyQuestion;
    protected int $year;
    protected string $title;
    protected ?string $description;

    public function __toString()
    {
        return $this->keyQuestion;
    }

    /**
     * @return string
     */
    public function getKeyQuestion(): string
    {
        return $this->keyQuestion;
    }

    /**
     * @param string $keyQuestion
     * @return Exam
     */
    public function setKeyQuestion(string $keyQuestion): Exam
    {
        $this->keyQuestion = $keyQuestion;
        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Exam
     */
    public function setYear(int $year): Exam
    {
        $this->year = $year;
        return $this;
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
     * @return Exam
     */
    public function setTitle(string $title): Exam
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Exam
     */
    public function setDescription(string $description): ?Exam
    {
        $this->description = $description;
        return $this;
    }

}
