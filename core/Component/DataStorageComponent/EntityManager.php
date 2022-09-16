<?php

namespace Core\Component\DataStorageComponent;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class EntityManager extends EntityManagerComponent
{

    protected ReflectionClass $entity;

    /**
     * @throws ReflectionException
     */
    public function persist($entity, $id = false){
        self::generateReflectionClass($entity);
        $class_name = strtolower($this->entity->getShortName());
        foreach($this->entity->getProperties() as $property){
            foreach ($property as $key => $value){
                if($key == 'name'){
                    $rp = new ReflectionProperty($entity, $value);
                    if($rp->isInitialized($entity)){
                        $mvalue = ucfirst($value);
                        $method = "get$mvalue";
                        $entityProperty = $entity->$method();
                        if ($entityProperty instanceof \DateTime){
                            $entityProperty = $entityProperty->format('Y-m-d H:i:s');
                        }
                        $data[$value] = $entityProperty;
                    }
                }
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
    }

    public function remove($entity, $id)
    {
        self::generateReflectionClass($entity);
        $class_name = strtolower($this->entity->getShortName());
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
        self::generateReflectionClass($entity);
        $class_name = strtolower($this->entity->getShortName());
        try {
            return $this->truncate($class_name);
        } catch (Exception $e){
            return 'Exception abgefangen: '. $e->getMessage() . "\n";
        }
    }

    protected function generateReflectionClass($entity){
        try {
            return $this->entity = new ReflectionClass($entity);
        } catch (ReflectionException $reflectionException){
            return 'Exception abgefangen: '. $reflectionException->getMessage() . "\n";
        }
    }
}