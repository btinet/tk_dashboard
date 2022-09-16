<?php

namespace Core\Component\DataStorageComponent;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class EntityManager extends EntityManagerComponent
{



    /**
     * @throws ReflectionException
     */
    public function persist($entity, $id = false){
        $data = [];
        try {
            $entity_class = self::generateReflectionClass($entity);
            $class_name = self::generateSnakeTailString($entity_class->getShortName());
            foreach($entity_class->getProperties() as $property){
                if(!in_array($property->getName(),['id','created','updated'])) {
                    $propertyName = ucfirst($property->getName());
                    $method = "get$propertyName";

                    $data[self::generateSnakeTailString($propertyName)] = $entity->$method();
                }
            };

            if ($id){
                $row = $this->select("SELECT * FROM $class_name WHERE id = :id", ['id' => $id]);
                if ($row){
                    return $this->update($class_name, $data, ['id' => $id]);
                }
            } else {
                return $this->insert($class_name, $data);
            }
            return false;
        } catch (ReflectionException $exception)
        {

        }
        return false;
    }

    public function remove($entity, $id)
    {
        $entity_class = self::generateReflectionClass($entity);
        $class_name = strtolower($entity_class->getShortName());
        if ($id) {
            $row = $this->select("SELECT * FROM $class_name WHERE id = :id", ['id' => $id]);
            if ($row) {
                return $this->delete($class_name, ['id' => $id]);
            }
        }
        return false;
    }

    public function truncate($entity): string
    {
        $entity_class = self::generateReflectionClass($entity);
        $class_name = strtolower($entity_class->getShortName());
        try {
            return $this->truncate($class_name);
        } catch (Exception $e){
            return 'Exception abgefangen: '. $e->getMessage() . "\n";
        }
    }

    protected function generateReflectionClass($entity){
        try {
            return new ReflectionClass($entity);
        } catch (ReflectionException $reflectionException){
            return 'Exception abgefangen: '. $reflectionException->getMessage() . "\n";
        }
    }
}