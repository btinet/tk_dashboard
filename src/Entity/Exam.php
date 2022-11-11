<?php

namespace App\Entity;

use App\Repository\ExamRepository;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use stdClass;

final class Exam
{
    /**
     * Allgemeine MySQL-Felder können als Trait dazugeladen werden.
     */
    use IdEntityTrait;
    use DateTimeEntityTrait;

    /**
     * Properties (private) sind nur für interne Zwecke
     */
    private ExamRepository $repository;
    private ?UserHasExam $topic;

    /**
     * Properties (protected) in CamelCase entsprechen den MySQL-Feldern in snake_case
     */
    protected string $keyQuestion;
    protected int $year;
    protected int $topicId;

    public function __construct()
    {
        $this->repository = new ExamRepository();
    }

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
     * @return ?int
     */
    public function getYear(): ?int
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
     * @return ?int
     */
    public function getTopicId(): ?int
    {
        return $this->topicId;
    }

    /**
     * @param int $topicId
     * @return $this
     */
    public function setTopicId(int $topicId): Exam
    {
        $this->topicId = $topicId;
        return $this;
    }

    /**
     * @return array|false|object|stdClass|string
     */
    public function getTopic()
    {
        return $this->repository->findOneBy(UserHasExam::class, [
            'id' => $this->getTopicId()
        ]);
    }


    /**
     * @return array|false|string
     */
    public function getUser()
    {
         return $this->repository->findUserByExamId($this->id, User::class);
    }

    /**
     * @return array|false
     */
    public function getSchoolSubjects()
    {

        return $this->repository->joinSchoolSubjects($this->id, SchoolSubject::class);

    }

    /**
     * @return ExamRepository
     */
    public function getRepository(): ExamRepository
    {
        return $this->repository;
    }

}
