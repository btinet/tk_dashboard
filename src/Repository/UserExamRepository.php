<?php

namespace App\Repository;

use App\Entity\ExamStatus;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;

class UserExamRepository extends AbstractRepositoryFactory
{

    public function joinStatusByUserExamId(int $userExamId, array $sortBy = [],string $entity = ExamStatus::class)
    {
        try {
            $orderData = self::createOrderData($sortBy);
            $result = self::select
            ("
                SELECT e.id, e.label, MAX(e.created), e.updated
                FROM exam_status e 
                    INNER JOIN exam_has_exam_status es ON (es.exam_status_id = e.id)
                WHERE es.user_exam_id = {$userExamId}
                    GROUP BY e.id
                {$orderData}
                    ");
            return $result->fetchObject($entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

}
