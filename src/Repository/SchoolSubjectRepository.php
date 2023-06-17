<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use App\Entity\Exam;
use App\Entity\ExamHasSchoolSubject;
use App\Entity\SchoolSubject;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method false|SchoolSubject find(int $id)
 * @method false|SchoolSubject findOneBy(array $data)
 * @method SchoolSubject[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method SchoolSubject[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class SchoolSubjectRepository extends GenericRepository
{

    public function __construct()
    {
        parent::__construct(SchoolSubject::class);
    }


    /**
     * @param int $id
     * @return ExamHasSchoolSubject[]
     */
    public function getSchoolSubjectState(int $id): array
    {
        return $this->queryBuilder(ExamHasSchoolSubject::class,'e')
            ->select('e.id, e.is_main_school_subject')
            ->select('s.label, s.abbr')
            ->join('school_subject','s','e.school_subject_id = s.id')
            ->andWhere('e.exam_id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult()
        ;

    }

    /**
     * @param int $id ID des Schulfachs, dessen Prüfungen gezählt werden sollen.
     * @return false|int Gibt die Anzahl der Datensätze als ganze Zahl oder false bei einem Fehler zurück.
     */
    public function countExams(int $id)
    {
        return $this->queryBuilder(Exam::class,'ex')

            // Die Reihenfolge der Methoden spielt keine Rolle. Die Angaben werden mit getQuery() zusammengesetzt.
            ->select('ex.id')
            ->join('exam_has_school_subject','e','e.exam_id = ex.id')
            ->andWhere('e.school_subject_id = :id')
            ->setParameter('id',$id)
            ->groupBy('ex.key_question')

            // getQuery() und get[..]Result() müssen immer am Ende folgen
            ->getQuery()
            ->getCountResult()
        ;

    }

}
