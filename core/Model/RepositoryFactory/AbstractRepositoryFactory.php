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
     * @param $id
     * @param string $entity
     * @return false|mixed|object|string
     */
    public function find(string $entity, $id)
    {
        $preparedStatement = " id = :id ";
        try {
            $entityClass = self::setEntityClass($entity);
            $columns = self::setColumns($entityClass);
            $result = self::select("SELECT {$columns} FROM {$entityClass->getShortName()} WHERE {$preparedStatement}", ['id' => $id]);
            return $result->fetchObject($entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $entity
     * @param array $sortBy
     * @return array|false|string
     */
    public function findAll(string $entity, array $sortBy = [])
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $columns = self::setColumns($entityClass);
            $orderData = self::createOrderData($sortBy);
            $result = self::select("SELECT {$columns} FROM {$entityClass->getShortName()} $orderData");
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
            $columns = self::setColumns($entityClass);
            $orderData = self::createOrderData($sortBy);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$entityClass->getShortName()} WHERE ($preparedStatement) $orderData", $data);
            return $result->fetchAll(PDO::FETCH_CLASS, $entity);
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $entity
     * @param array $data
     * @return false|mixed|object|stdClass|string
     */
    public function findOneBy(string $entity, array $data)
    {
        try {
            $entityClass = self::setEntityClass($entity);
            $columns = self::setColumns($entityClass);
            $preparedStatement = self::setPreparedStatement($data);
            $data = self::setBindValues($data);
            $result = self::select("SELECT {$columns} FROM {$entityClass->getShortName()} WHERE ({$preparedStatement}) LIMIT 0,1", $data);
            if (false === $object = $result->fetchObject($entity)) return new stdClass();
            return $object;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        } catch (ReflectionException $e) {
            return $e->getMessage();
        }
    }

}