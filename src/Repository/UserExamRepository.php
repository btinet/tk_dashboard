<?php

namespace App\Repository;

use App\Entity\ExamStatus;
use App\Entity\UserHasExam;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;

/**
 * @method false|UserHasExam find(int $id)
 * @method false|UserHasExam findOneBy(array $data)
 * @method UserHasExam[] findBy(array $data, array $sortBy = [], int $limit = null, int $offset = null)
 * @method UserHasExam[] findAll(array $orderBy = [], int $limit = null, int $offset = null)
 */

class UserExamRepository extends AbstractRepositoryFactory
{

    public function __construct()
    {
        parent::__construct(UserHasExam::class);
    }


    public function joinStatusByUserExamId(int $userExamId, array $orderBy = ['es.created'=>'desc'])
    {
        return $this->queryBuilder(ExamStatus::class,'e')
            ->select('es.id, e.label, MAX(e.created) as created, e.updated, es.info')
            ->join('exam_has_exam_status','es','es.exam_status_id = e.id')
            ->andWhere('es.user_exam_id = :user_exam_id')
            ->setParameter('user_exam_id',$userExamId)
            ->groupBy('e.id')
            ->setMaxResults(1)
            ->orderBy($orderBy)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }

    /**
     * @param int $id
     * @return false|int
     */
    public function countSupervisorLoad(int $id)
    {
        return $this->queryBuilder(UserHasExam::class,'ue')
            ->andWhere('ue.supervisor_id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getCountResult()
        ;

    }

}
