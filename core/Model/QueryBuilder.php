<?php

namespace Core\Model;

use Core\Component\ConfigComponent\Config;
use PDO;
use PDOException;
use PDOStatement;
use ReflectionClass;
use ReflectionException;

class QueryBuilder
{
    /**
     * @var array|null[]
     */
    private array $dsn = [
        'host' => 'localhost',
        'dbname' => null,
        'charset' => 'utf8',
    ];
    /**
     * @var string|null
     */
    private ?string $username = null;

    /**
     * @var string|null
     */
    private ?string $password = null;

    private string $dsnString;

    private Config $config;

    protected string $entity;
    protected string $alias;
    protected ?string $projection = null;
    protected array $conditions = [];
    protected array $parameters = [];
    protected array $query = [];
    protected array $joins = [];
    protected array $groupBy = [];
    protected array $orderBy = [];

    protected PDOStatement $statement;
    protected PDO $pdo;

    public function __construct
    (
        string $entity,
        string $alias = null
    )
    {
        $this->entity = $entity;
        $this->alias = $alias;

        $type = 'mysql';

        $this->config = new Config('config/env.yaml');
        $databaseConfig = $this->config->getConfig('database');
        $this->dsn['host'] = $databaseConfig['DB_HOST'];
        $this->dsn['dbname'] = $databaseConfig['DB_NAME'];
        $this->username = $databaseConfig['DB_USER'];
        $this->password = $databaseConfig['DB_PASS'];

        try {
            $this->dsnString = "{$type}:";
            $i = 0;
            foreach ($this->dsn as $key => $value) {
                $this->dsnString .= "{$key}={$value}";
                if (++$i !== count($this->dsn)) $this->dsnString .= ";";
            }

            // Neue PDO Instanz statt extend PDO, damit nur die QueryBuilder Methoden direkt verfügbar sind.
            $this->pdo = new PDO($this->dsnString, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
            $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        } catch (PDOException $e) {
            echo 'Exception abgefangen: ' . $e->getMessage() . "\n";
        }
    }

    /**
     * @throws ReflectionException
     */
    protected function setEntityClass($entity): ReflectionClass
    {
        if (!class_exists($entity)) throw new ReflectionException();
        return new ReflectionClass($entity);
    }

    protected function generateSnakeTailString(string $value): string
    {
        $valueAsArray = preg_split('/(?=[A-Z])/', $value);
        return strtolower(ltrim($propertyNameAsSnakeTail = implode('_', $valueAsArray),'_'));
    }


    protected function getTableNameFromEntity(): string
    {
        try {
            return $this->generateSnakeTailString($this->setEntityClass($this->entity)->getShortName());
        } catch (ReflectionException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Beginn der Builder-Methoden für die SQL-Queries
     */

    /**
     * @param string $fields
     * @return $this
     */
    public function select(string $fields): QueryBuilder
    {
        $this->projection = $fields;
        return $this;
    }

    /**
     * @param string $table
     * @param string $alias
     * @param string $condition
     * @return $this
     */
    public function join(string $table, string $alias, string $condition): QueryBuilder
    {
        $this->joins[] = "INNER JOIN {$table} {$alias} ON ({$condition})";
        return $this;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function andWhere(string $condition): QueryBuilder
    {
        if(0 == $count = count($this->conditions))
        {
            $this->conditions[] = "$condition";
        } else {
            $this->conditions[] = "AND $condition";
        }
        return $this;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function orWhere(string $condition): QueryBuilder
    {
        if(0 == $count = count($this->conditions))
        {
            $this->conditions[] = "$condition";
        } else {
            $this->conditions[] = "OR $condition";
        }
        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setParameter(string $key, string $value): QueryBuilder
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * @param int $row
     * @return $this
     */
    public function setFirstResult(int $row): QueryBuilder
    {
        return $this;
    }

    /**
     * @param int $amount
     * @return $this
     */
    public function setMaxResults(int $amount): QueryBuilder
    {
        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function orderBy(string $field, string $direction): QueryBuilder
    {
        $this->orderBy[$field] = $direction;
        return $this;
    }

    public function groupBy(string $field): QueryBuilder
    {
        $this->groupBy[] = $field;
        return $this;
    }

    /**
     * @return $this
     */
    public function getQuery(): QueryBuilder
    {

        if($this->projection)
        {
            $this->query['projection'] = "SELECT {$this->projection}";
        } else {
            $this->query['projection'] = "SELECT *";
        }



        $this->query['table'] = "FROM {$this->getTableNameFromEntity()} {$this->alias}";

        if (0 !== count($this->joins))
        {
            $this->query['joins'] = implode(' ',$this->joins);
        }

        if (0 !== count($this->conditions))
        {
            $this->query['condition'] = "WHERE " . implode(' ',$this->conditions);
        }

        if (0 !== count($this->groupBy))
        {
            $this->query['group'] = "GROUP BY " . implode(',',$this->groupBy);
        }

        if (0 !== count($this->orderBy))
        {
            $order = "ORDER BY ";
            foreach ($this->orderBy as $key => $value)
            {
                $value = strtoupper($value);
                $order .= "{$key} {$value},";
            }
            $this->query['order'] = rtrim($order,',');

        }

        $this->statement = $this->pdo->prepare( implode(' ',$this->query));

        foreach ($this->parameters as $key => $value)
        {
            $this->statement->bindValue(':' . $key, $value);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        if($this->statement->execute())
        {

            if($this->statement->rowCount() !== 0)
            {
                return $this->statement->fetchAll($this->pdo::FETCH_CLASS, $this->entity);
            }
        }

        return [];
    }

    public function getOneOrNullResult()
    {
        if($this->statement->execute())
        {
            if($this->statement->rowCount() !== 0)
            {
                return $this->statement->fetchObject($this->entity);
            }
        }

        return false;
    }

}
