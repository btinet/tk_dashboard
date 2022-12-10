<?php

namespace App\Entity;

use App\Repository\SchoolSubjectRepository;
use Core\Model\DateTimeEntityTrait;
use Core\Model\IdEntityTrait;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

final class SchoolSubject
{
    use IdEntityTrait;
    use DateTimeEntityTrait;

    private AbstractRepositoryFactory $repository;
    private bool $isMainSchoolSubject;
    private SchoolSubjectType $schoolSubjectType;


    protected string $label;
    protected string $abbr;
    protected int $schoolSubjectTypeId;
    protected string $color;

    public function __construct()
    {
        $this->repository = new SchoolSubjectRepository();
    }

    public function __toString()
    {
        return $this->abbr;
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
     * @return SchoolSubject
     */
    public function setLabel(string $label): SchoolSubject
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbbr(): string
    {
        return $this->abbr;
    }

    /**
     * @param string $abbr
     * @return SchoolSubject
     */
    public function setAbbr(string $abbr): SchoolSubject
    {
        $this->abbr = $abbr;
        return $this;
    }

    /**
     * @return SchoolSubjectType
     */
    public function getSchoolSubjectType(): SchoolSubjectType
    {
        return $this->repository->find(SchoolSubjectType::class,$this->schoolSubjectTypeId);
    }

    /**
     * @return int
     */
    public function getSchoolSubjectTypeId(): int
    {
        return $this->schoolSubjectTypeId;
    }

    /**
     * @param int $schoolSubjectTypeId
     * @return SchoolSubject
     */
    public function setSchoolSubjectTypeId(int $schoolSubjectTypeId): SchoolSubject
    {
        $this->schoolSubjectTypeId = $schoolSubjectTypeId;
        return $this;
    }

    /**
     * @param bool $isMainSchoolSubject
     * @return SchoolSubject
     */
    public function setIsMainSchoolSubject(bool $isMainSchoolSubject): SchoolSubject
    {
        $this->isMainSchoolSubject = $isMainSchoolSubject;
        return $this;
    }

    public function isMainSchoolSubject(): bool
    {
        return $this->isMainSchoolSubject;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return SchoolSubject
     */
    public function setColor(string $color): SchoolSubject
    {
        $this->color = $color;
        return $this;
    }

    public function countExams(): int
    {
        return ($this->repository->countExams($this->id, SchoolSubject::class))?$this->repository->countExams($this->id, SchoolSubject::class)->count:0;
    }

}

