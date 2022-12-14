<?php

namespace App\Entity;

use App\Repository\GenericRepository;
use App\Repository\SchoolSubjectRepository;
use App\Repository\UserExamRepository;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

final class UserHasExam
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    private AbstractRepositoryFactory $repository;

    protected int $userId;
    protected string $keyQuestion;
    protected int $topicId;
    protected int $mainSubjectId;
    protected int $secondarySubjectId;
    protected int $supervisorId;

    public function __construct()
    {
        $this->repository = new GenericRepository(UserHasExam::class);
    }

    public function __toString()
    {
        return 'set string';
    }

    /**
     * Repository-Getter
     */

    public function getUser(){return $this->repository->setEntity(User::class)->find($this->userId);}
    public function getTopic(){return $this->repository->setEntity(Topic::class)->find($this->topicId);}
    public function getMainSchoolSubject(){return $this->repository->setEntity(SchoolSubject::class)->find($this->mainSubjectId);}
    public function getSecondarySchoolSubject(){return $this->repository->setEntity(SchoolSubject::class)->find($this->secondarySubjectId);}
    public function getStatus(){
        $repository = new UserExamRepository();
        return $repository->joinStatusByUserExamId($this->id);
    }
    public function getSupervisor(){return $this->repository->setEntity(User::class)->find($this->supervisorId);}

    /**
     * @return ExamHasExamStatus[]
     */
    public function getAllExamStatus(): array
    {
        return $this->repository->setEntity(ExamHasExamStatus::class)->findBy(['user_exam_id' => $this->id],['created'=>'desc']);
    }

    /**
     * Entity-Getter
     */

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return UserHasExam
     */
    public function setUserId(int $userId): UserHasExam
    {
        $this->userId = $userId;
        return $this;
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
     * @return UserHasExam
     */
    public function setKeyQuestion(string $keyQuestion): UserHasExam
    {
        $this->keyQuestion = $keyQuestion;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopicId(): int
    {
        return $this->topicId;
    }

    /**
     * @param int $topicId
     * @return UserHasExam
     */
    public function setTopicId(int $topicId): UserHasExam
    {
        $this->topicId = $topicId;
        return $this;
    }

    /**
     * @return int
     */
    public function getMainSubjectId(): int
    {
        return $this->mainSubjectId;
    }

    /**
     * @param int $mainSubjectId
     * @return UserHasExam
     */
    public function setMainSubjectId(int $mainSubjectId): UserHasExam
    {
        $this->mainSubjectId = $mainSubjectId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSecondarySubjectId(): int
    {
        return $this->secondarySubjectId;
    }

    /**
     * @param int $secondarySubjectId
     * @return UserHasExam
     */
    public function setSecondarySubjectId(int $secondarySubjectId): UserHasExam
    {
        $this->secondarySubjectId = $secondarySubjectId;
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
     * @return UserHasExam
     */
    public function setSupervisorId(int $supervisorId): UserHasExam
    {
        $this->supervisorId = $supervisorId;
        return $this;
    }

}
