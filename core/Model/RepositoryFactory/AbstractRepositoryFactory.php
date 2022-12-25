<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Model\RepositoryFactory;

use Core\Component\DataStorageComponent\EntityManagerComponent;
use Core\Model\QueryBuilder;
use PDO;
use PDOException;
use ReflectionException;

class AbstractRepositoryFactory extends EntityManagerComponent
{

    protected QueryBuilder $queryBuilder;

    /**
     * @param string $entity ORM entity class representing the database table
     * @param string|null $alias alias of the base table
     * @return QueryBuilder
     */
    public function QueryBuilder(string $entity, string $alias = null): QueryBuilder
    {
        return $this->queryBuilder = new QueryBuilder($entity,$alias);
    }


    /**
     * @param string $entity
     * @return int|string|null
     */
    public function count(string $entity)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $entityShortName = self::generateSnakeTailString($entityClass->getShortname());

            $result = self::select("SELECT * FROM {$entityShortName}");
            return $result->rowCount();
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            echo $e->getMessage();

        }
        return null;
    }

    /**
     * @param string $entity
     * @return int|string|null
     */
    public function countDistinctBy(string $entity, string $column)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $tableName = self::generateSnakeTailString($entityClass->getShortName());
            $column = self::setColumns($entityClass);
            $result = self::select("SELECT DISTINCT {$column} FROM {$tableName}");
            return $result->rowCount();
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            echo $e->getMessage();

        }
        return null;
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
    public function findAll(string $entity, array $sortBy = [], int $limit = 100, int $offset = 0 )
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
     * @return false|object|string|array
     */
    public function findOneBy(string $entity, array $data)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $tableName = self::generateSnakeTailString($entityClass->getShortName());
            $columns = self::setColumns($entityClass);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$tableName} WHERE ({$preparedStatement}) LIMIT 1", $data);
            return ($result->rowCount() !== 0 ) ? $result->fetchObject($entity):false;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

}