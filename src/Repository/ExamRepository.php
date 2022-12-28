<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use App\Entity\Exam;
use App\Entity\SchoolSubject;
use App\Entity\User;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method null|Exam find(int $id)
 * @method null|Exam findOneBy(array $data)
 * @method Exam[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method Exam[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class ExamRepository extends AbstractRepositoryFactory
{

    public function __construct()
    {
        parent::__construct(Exam::class);
    }

    /*

    public function selectAll(): array
    {
        return $this->QueryBuilder(Exam::class,'e')
            ->select('e.id, e.key_question AS keyQuestion')
            ->getQuery()
            ->getResult()
        ;
    }

    public function selectOne($value = 5): ?Exam
    {
        return $this->QueryBuilder(Exam::class,'e')
            ->select('e.id, e.key_question AS keyQuestion')
            ->andWhere('e.id = :id')
            ->setParameter('id',$value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    */

    public function search($query): array
    {
        return $this->queryBuilder(Exam::class,'ex')
            ->select('ex.id, ex.year, ex.key_question AS keyQuestion, ex.topic_id AS topicId')
            ->join('exam_has_school_subject','e','ex.id = e.exam_id')
            ->join('school_subject','s', 'e.school_subject_id = s.id')
            ->join('topic','t','ex.topic_id = t.id')
            ->orWhere('ex.key_question LIKE :query')
            ->orWhere('s.label LIKE :query')
            ->orWhere('s.abbr LIKE :query')
            ->orWhere('t.title LIKE :query')
            ->orWhere('t.description LIKE :query')
            ->setParameter('query',"%$query%")
            ->groupBy('ex.key_question')
            ->orderBy('ex.year','desc')
            ->getQuery()
            ->getResult()
        ;
    }

    public function countExams()
    {
        return $this->queryBuilder(Exam::class,'e')
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    /**
     * @param int $id
     * @param array $orderBy
     * @return SchoolSubject[] Gibt ein Array mit Objekten der jeweiligen ORM Entity zurück
     */
    public function joinSchoolSubjects(int $id, array $orderBy = []): array
    {
        return $this->queryBuilder(SchoolSubject::class,'s')
            ->select('e.id, e.is_main_school_subject AS isMainSchoolSubject')
            ->select('s.label, s.abbr, s.id')
            ->join('exam_has_school_subject','e','e.school_subject_id = s.id')
            ->andWhere('e.exam_id = :id')
            ->setParameter('id',$id)
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @param int $isMainSchoolSubject
     * @param array $orderBy
     * @return Exam[]
     */
    public function findBySubject(int $id,int $isMainSchoolSubject, array $orderBy = []): array
    {
        return $this->queryBuilder(Exam::class,'ex')
            ->select('ex.id AS id, ex.year AS year, ex.key_question AS keyQuestion, ex.topic_id AS topicId')
            ->join('exam_has_school_subject','e','ex.id = e.exam_id')
            ->join('school_subject','s','e.school_subject_id = s.id')
            ->andWhere('e.school_subject_id = :id')
            ->andWhere('e.is_main_school_subject = :is_main_subject')
            ->setParameter('id',$id)
            ->setParameter('is_main_subject',$isMainSchoolSubject)
            ->groupBy('ex.key_question')
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $id
     * @param array $orderBy
     * @return false|Exam
     */
    public function findOneBySubject(int $id, array $orderBy = [])
    {
        return $this->queryBuilder(Exam::class,'ex')
            ->select('ex.id, ex.year, ex.key_question AS keyQuestion, ex.topic_id AS topicId')
            ->join('exam_has_school_subject','e','ex.id = e.exam_id')
            ->join('school_subject','s','e.school_subject_id = s.id')
            ->andWhere('e.exam_id = :id')
            ->setParameter('id',$id)
            ->orderBy($orderBy)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param array $orderBy
     * @return Exam[]
     */
    public function findExamsGroupByKeyQuestion(array $orderBy = []): array
    {
        return $this->queryBuilder(Exam::class,'ex')
            ->select('ex.key_question AS keyQuestion, ex.id, ex.year, ex.topic_id AS topicId')
            ->join('exam_has_school_subject','e','ex.id = e.exam_id')
            ->join('school_subject','s','e.school_subject_id = s.id')
            ->groupBy('ex.key_question')
            ->orderBy($orderBy)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param int $examId
     * @param array $orderBy
     * @return false|User
     */
    public function findUserByExamId(int $examId, array $orderBy = [])
    {
        return $this->queryBuilder(User::class,'u')
            ->selectOrm()
            ->join('exam_has_school_subject','e','u.id = e.user_id')
            ->andWhere('e.exam_id = :id')
            ->setParameter('id',$examId)
            ->orderBy($orderBy)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
