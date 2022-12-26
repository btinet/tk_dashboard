<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Model\RepositoryFactory;

use Core\Model\QueryBuilder;
use PDO;
use PDOException;
use ReflectionException;

abstract class AbstractRepositoryFactory
{

    protected string $entity;

    protected QueryBuilder $queryBuilder;

    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

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
     * @return false|int
     */
    public function count()
    {
        return $this->queryBuilder($this->entity,'e')
            ->getQuery()
            ->getCountResult()
        ;

    }

    /**
     * @return false|int
     */
    public function countDistinctBy(string $column)
    {
        return $this->queryBuilder($this->entity,'e')
            ->selectDistinct(':column')
            ->setParameter('column',$column)
            ->getQuery()
            ->getCountResult()
        ;

    }

    /**
     * @param int $id
     * @return false|mixed
     */
    public function find(int $id)
    {
        return $this->queryBuilder($this->entity)
            ->selectOrm()
            ->andWhere('e.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult()
            ;

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