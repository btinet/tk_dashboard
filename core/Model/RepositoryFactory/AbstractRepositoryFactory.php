<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Model\RepositoryFactory;

use Core\Component\DataStorageComponent\EntityManagerComponent;
use PDO;
use PDOException;
use ReflectionException;
use stdClass;

class AbstractRepositoryFactory extends EntityManagerComponent
{


    /**
     * @param string $entity
     * @return false|mixed|string|null
     */
    public function count(string $entity)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $entityShortName = self::generateSnakeTailString($entityClass->getShortname());

            $result = self::select("SELECT COUNT(*) FROM {$entityShortName}");
            $count = $result->fetch(PDO::FETCH_NUM);
            return array_pop($count);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    /**
     * @param $id
     * @param string $entity
     * @return false|mixed|object|string
     */
    public function find(string $entity, $id)
    {
        $preparedStatement = " id = :id ";
        try {
            $entityClass = self::setEntityClass($entity);
            $tableName = self::generateSnakeTailString($entityClass->getShortName());
            $columns = self::setColumns($entityClass);
            $result = self::select("SELECT {$columns} FROM {$tableName} WHERE {$preparedStatement}", ['id' => $id]);
            return ($result->rowCount() !== 0 ) ? $result->fetchObject($entity):false;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $entity
     * @param array $sortBy
     * @param int $limit
     * @param int $offset
     * @return array|false|string
     */
    public function findAll(string $entity, array $sortBy = [], int $limit = 10, int $offset = 0 )
    {
        if($limit){
            $limit = "LIMIT $limit";
    } else {
            $limit = '';
        }
        if($offset){
            $offset = "OFFSET $offset";
        } else {
            $offset = '';
        }
        try {
            $entityClass = self::setEntityClass($entity);
            $entityShortName = self::generateSnakeTailString($entityClass->getShortname());

            $columns = self::setColumns($entityClass);
            $orderData = self::createOrderData($sortBy);
            $result = self::select("SELECT {$columns} FROM {$entityShortName} $orderData $limit $offset");
            return $result->fetchAll(PDO::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    /**
     * @param string $entity
     * @param array $data
     * @param array $sortBy
     * @return array|false|string
     */
    public function findBy(string $entity, array $data, array $sortBy = [])
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $tableName = self::generateSnakeTailString($entityClass->getShortName());
            $columns = self::setColumns($entityClass);
            $orderData = self::createOrderData($sortBy);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$tableName} WHERE ($preparedStatement) $orderData", $data);
            return ($result->rowCount() !== 0 ) ? $result->fetchAll(PDO::FETCH_CLASS, $entity):false;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $entity
     * @param array $data
     * @return false|object|stdClass|string|array
     */
    public function findOneBy(string $entity, array $data)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $tableName = self::generateSnakeTailString($entityClass->getShortName());
            $columns = self::setColumns($entityClass);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$tableName} WHERE ({$preparedStatement}) LIMIT 0,1", $data);
            if (false === $object = $result->fetchObject($entity)) return new stdClass();
            return $object;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

}