<?php

namespace App\Entity;

use App\Repository\GenericRepository;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

final class ExamHasExamStatus
{

    use IdEntityTrait;
    use DateTimeEntityTrait;

    /**
     * Repository-Attributes
     */

    private AbstractRepositoryFactory $repository;

    /**
     * @return false|User
     */
    public function getSupervisor(){
        return $this->repository->setEntity(User::class)->find($this->supervisorId);
    }

    /**
     * @return false|UserHasExam
     */
    public function getUserExam(){
        return $this->repository->setEntity(UserHasExam::class)->find($this->userExamId);
    }

    /**
     * @return false|ExamStatus
     */
    public function getExamStatus(){
        return $this->repository->setEntity(ExamStatus::class)->find($this->examStatusId);
    }

    /**
     * Entity-Attributes
     */

    protected string $info;
    protected int $userExamId;
    protected int $examStatusId;
    protected int $supervisorId;

    public function __construct()
    {
        $this->repository = new GenericRepository(ExamHasExamStatus::class);
    }

    /**
     * @return string
     */
    public function getInfo(): string
    {
        return $this->info;
    }

    /**
     * @param string $info
     * @return ExamHasExamStatus
     */
    public function setInfo(string $info): ExamHasExamStatus
    {
        $this->info = $info;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserExamId(): int
    {
        return $this->userExamId;
    }

    /**
     * @param int $userExamId
     * @return ExamHasExamStatus
     */
    public function setUserExamId(int $userExamId): ExamHasExamStatus
    {
        $this->userExamId = $userExamId;
        return $this;
    }

    /**
     * @return int
     */
    public function getExamStatusId(): int
    {
        return $this->examStatusId;
    }

    /**
     * @param int $examStatusId
     * @return ExamHasExamStatus
     */
    public function setExamStatusId(int $examStatusId): ExamHasExamStatus
    {
        $this->examStatusId = $examStatusId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSupervisorId(): int
    {
        return $this->supervisorId;
    }

    /**
     * @param int $supervisorId
     * @return ExamHasExamStatus
     */
    public function setSupervisorId(int $supervisorId): ExamHasExamStatus
    {
        $this->supervisorId = $supervisorId;
        return $this;
    }

}
