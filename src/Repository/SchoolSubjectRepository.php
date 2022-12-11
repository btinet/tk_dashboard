<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;

class SchoolSubjectRepository extends AbstractRepositoryFactory
{


    /**
     * @return array|false
     */
    public function getSchoolSubjectState(int $id,string $entity)
    {
        try {
            $result = self::select
            ("
                SELECT e.id, e.is_main_school_subject, s.label, s.abbr
                FROM exam_has_school_subject e  
                    INNER JOIN school_subject s ON (e.school_subject_id = s.id)
                WHERE e.exam_id = {$id}
                    ");
            return $result->fetchAll(8, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }


    public function countExams(int $id,string $entity)
    {
        try {
            $result = self::select
            ("
                SELECT ex.id
                FROM exam ex                 
                INNER JOIN exam_has_school_subject e  ON e.exam_id = ex.id
                WHERE e.school_subject_id = {$id}
                GROUP BY ex.key_question
                    ");
            return $result->rowCount();
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

}
