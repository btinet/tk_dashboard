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
    public function findExamsJoinTopic()
    {
        try {
            $result = self::select("SELECT exam.id, exam.key_question, exam.year, topic.title, topic.description FROM exam  RIGHT JOIN topic ON exam.topic_id = topic.id");
            return $result->fetchAll(8);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

}
