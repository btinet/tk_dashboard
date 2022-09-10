<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;

class ExamRepository extends AbstractRepositoryFactory
{


    /**
     * @return array|false
     */
    public function joinSchoolSubjects(int $id,string $entity, array $sortBy = [])
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT e.id, e.is_main_school_subject AS isMainSchoolSubject, s.label, s.abbr
                FROM school_subject s 
                    INNER JOIN exam_has_school_subject e ON (e.school_subject_id = s.id)
                WHERE e.exam_id = {$id}
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
                SELECT ex.id, ex.year, ex.key_question AS keyQuestion, ex.topic_id AS topicId
                FROM exam ex
                    INNER JOIN exam_has_school_subject e
                        ON (ex.id = e.exam_id)
                    INNER JOIN school_subject s
                        ON (e.school_subject_id = s.id)
                WHERE e.school_subject_id = {$id}
                  AND e.is_main_school_subject = {$isMainSchoolSubject}
                GROUP BY ex.key_question
                    ");
            return $result->fetchAll(self::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

}
