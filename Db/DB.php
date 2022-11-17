<?php

namespace Db;

use PDOException;

abstract class DB
{
    protected $config;
    protected $connection;
    protected const TABLE = self::TABLE;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->connect();
    }

    protected function connect()
    {
        try {
            $this->connection = new \PDO(
                "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset=utf8mb4",
                $this->config['username'],
                $this->config['pass']
            );
        } catch (\PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    abstract protected function validate(array $insertData): bool;

    public function store(array $insertData): void
    {
        if ($this->validate($insertData)) {
        $valuesString = implode(", :", array_keys($insertData));
        $keysString = implode(",", array_keys($insertData));
        $this->connection
            ->prepare("INSERT " . static::TABLE . " ($keysString) VALUE (:$valuesString)")
            ->execute($insertData);
        }
        else return;
    }

    public function get(int $limit = 20): array
    {
        $queryShow = $this->connection->prepare(
            "SELECT * FROM " . static::TABLE . " ORDER BY id DESC LIMIT :limit;"
        );
        $queryShow->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $queryShow->execute();
        return $queryShow->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update(int $id, string $fieldName, string $value): void
    {
        $queryUpdate = $this->connection
            ->prepare(
                "UPDATE " . static::TABLE . " SET `$fieldName`=:value WHERE `id`=:id"
            );
        $queryUpdate->bindValue(':value', $value);
        $queryUpdate->bindValue(':id', $id);

        $queryUpdate->execute();
    }

    public function delete(int $id): void
    {
        $queryDelete = $this->connection->prepare("DELETE FROM " . static::TABLE . " WHERE `id`=:id");
        $queryDelete->bindValue(':id', $id);
        $queryDelete->execute();
    }
    public function getRecordById(int $id)
    {
        $queryShow = $this->connection->prepare(
            "SELECT * FROM " . static::TABLE . " WHERE `id`=:id;"
        );
        $queryShow->bindValue(':id', $id, \PDO::PARAM_INT);
        $queryShow->execute();
        return $queryShow->fetch();
    }
}
