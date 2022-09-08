<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Repository;

use App\Entity\Student;
use Core\Model\RepositoryFactory\AbstractRepositoryFactory;
use PDOException;
use ReflectionException;

class StudentRepository extends AbstractRepositoryFactory
{

    /**
     * @param string $entity
     * @param array $data
     * @param array $sortBy
     * @return array|false
     */
    public function findLastName(array $data, string $entity = Student::class, array $sortBy = [])
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $columns = self::setColumns($entityClass);
            $orderData = self::createOrderData($sortBy);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$entityClass->getShortName()} WHERE ($preparedStatement) $orderData", $data);
            return $result->fetchAll(8, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

}