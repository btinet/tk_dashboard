<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use App\Entity\Exam;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;

class ExamRepository extends AbstractRepositoryFactory
{

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

    public function search2($query): array
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

    /**
     * @return array|false
     */
    public function search(string $queryString,string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT ex.id, ex.year, ex.key_question AS keyQuestion, ex.topic_id AS topicId
                FROM exam ex
                    INNER JOIN exam_has_school_subject e
                        ON (ex.id = e.exam_id)
                    INNER JOIN school_subject s
                        ON (e.school_subject_id = s.id)
                    INNER JOIN topic t
                        ON (ex.topic_id = t.id)
                WHERE ex.key_question LIKE '%{$queryString}%'
                    OR s.label LIKE '%{$queryString}%'
                    OR s.abbr LIKE '%{$queryString}%'
                    OR t.title LIKE '%{$queryString}%'
                    OR t.description LIKE '%{$queryString}%'
                        GROUP BY ex.key_question
                {$orderData}
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function joinSchoolSubjects(int $id,string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT e.id, e.is_main_school_subject AS isMainSchoolSubject, s.label, s.abbr, s.id
                FROM school_subject s 
                    INNER JOIN exam_has_school_subject e ON (e.school_subject_id = s.id)
                WHERE e.exam_id = {$id}
                {$orderData}
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findBySubject(int $id,int $isMainSchoolSubject, string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT ex.id AS id, ex.year AS year, ex.key_question AS keyQuestion, ex.topic_id AS topicId
                FROM exam ex
                    INNER JOIN exam_has_school_subject e
                        ON (ex.id = e.exam_id)
                    INNER JOIN school_subject s
                        ON (e.school_subject_id = s.id)
                WHERE e.school_subject_id = {$id}
                  AND e.is_main_school_subject = {$isMainSchoolSubject}
                  GROUP BY ex.key_question
                {$orderData}
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    public function findOneBySubject(int $id, string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT ex.id, ex.year, ex.key_question AS keyQuestion, ex.topic_id AS topicId
                FROM exam ex
                    INNER JOIN exam_has_school_subject e
                        ON (ex.id = e.exam_id)
                    INNER JOIN school_subject s
                        ON (e.school_subject_id = s.id)
                WHERE e.exam_id = {$id}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return array|false
     */
    public function findExamsGroupByKeyQuestion(string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT ex.key_question AS keyQuestion, ex.id, ex.year, ex.topic_id AS topicId
                FROM exam ex
                    INNER JOIN exam_has_school_subject e
                        ON (ex.id = e.exam_id)
                    INNER JOIN school_subject s
                        ON (e.school_subject_id = s.id)
                        GROUP BY ex.key_question
                {$orderData}
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

    public function findUserByExamId(int $examId, string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT *
                FROM user u
                    INNER JOIN exam_has_school_subject e
                        ON (u.id = e.user_id)
                WHERE e.exam_id = {$examId}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }


}
