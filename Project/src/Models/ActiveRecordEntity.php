<?php
namespace src\Models;

use src\Services\Db;
use src\Exceptions\DbException;

abstract class ActiveRecordEntity
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelcase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelcase(string $name): string
    {
        return lcfirst(str_replace('_', '', ucwords($name, '_')));
    }

    public static function findAll(): ?array
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '`';
        return $db->query($sql, [], static::class);
    }

    public static function getById(int $id): ?static
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `id`=:id';
        $result = $db->query($sql, [':id' => $id], static::class);
        return $result ? $result[0] : null;
    }

    public function save(): bool
    {
        if ($this->getId()) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    private function update(): bool
    {
        $properties = $this->mapPropertiesToDbFormat();
        
        $columns = [];
        $params = [];
        
        foreach ($properties as $column => $value) {
            $param = ':' . $column;
            $columns[] = "`$column` = $param";
            $params[$param] = $value;
        }
        
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columns) . ' WHERE `id` = :id';
        $params[':id'] = $this->id;
        
        $db = Db::getInstance();
        return $db->query($sql, $params) !== null;
    }

    private function insert(): bool
    {
        $properties = $this->mapPropertiesToDbFormat();
        
        $columns = [];
        $params = [];
        $placeholders = [];
        
        foreach ($properties as $column => $value) {
            $columns[] = "`$column`";
            $param = ':' . $column;
            $placeholders[] = $param;
            $params[$param] = $value;
        }
        
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(', ', $columns) . ') 
                VALUES (' . implode(', ', $placeholders) . ')';
        
        $db = Db::getInstance();
        $result = $db->query($sql, $params);
        
        if ($result) {
            $this->id = $db->getLastInsertId();
            return true;
        }
        
        return false;
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        
        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            if ($propertyName === 'id') {
                continue;
            }
            
            $snakeCaseName = $this->camelToSnakeCase($propertyName);
            $mappedProperties[$snakeCaseName] = $this->$propertyName;
        }
        
        return $mappedProperties;
    }

    private function camelToSnakeCase(string $name): string
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $name));
    }

    abstract protected static function getTableName(): string;
}