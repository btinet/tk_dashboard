<?php

namespace App\Entity;

use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;

class ExamHasSchoolSubject
{

    use IdEntityTrait;
    use DateTimeEntityTrait;

    protected int $examId;
    protected ?int $userId;
    protected int $schoolSubjectId;
    protected int $isMainSchoolSubject;

    /**
     * @return int
     */
    public function getExamId(): int
    {
        return $this->examId;
    }

    /**
     * @param int $examId
     * @return ExamHasSchoolSubject
     */
    public function setExamId(int $examId): ExamHasSchoolSubject
    {
        $this->examId = $examId;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return ExamHasSchoolSubject
     */
    public function setUserId(?int $userId): ExamHasSchoolSubject
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSchoolSubjectId(): int
    {
        return $this->schoolSubjectId;
    }

    /**
     * @param int $schoolSubjectId
     * @return ExamHasSchoolSubject
     */
    public function setSchoolSubjectId(int $schoolSubjectId): ExamHasSchoolSubject
    {
        $this->schoolSubjectId = $schoolSubjectId;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsMainSchoolSubject(): int
    {
        return $this->isMainSchoolSubject;
    }

    /**
     * @param bool $isMainSchoolSubject
     * @return ExamHasSchoolSubject
     */
    public function setIsMainSchoolSubject(bool $isMainSchoolSubject): ExamHasSchoolSubject
    {
        $this->isMainSchoolSubject = $isMainSchoolSubject;
        return $this;
    }

}
