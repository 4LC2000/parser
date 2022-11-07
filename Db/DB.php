<?php

namespace Db;

use PDOException;

abstract class DB
{
    protected $config;
    protected $connection;
    protected const table = self::table;
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->connect();
    }
    protected function connect()
    {
        try{
            $this->connection = new \PDO(
                "mysql:host={$this->config['host']};dbname={$this->config['dbname']};charset=utf8mb4",
                $this->config['username'],
                $this->config['pass']
            );
        } catch(\PDOException $e){
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

    
    }

    //to do insert item object only in post class
    public function store(array $insertData): void
    {

        $valuesString = implode(", :", array_keys($insertData));
        $keysString = implode(",", array_keys($insertData));
        $this->connection
            ->prepare("INSERT ".static::table." ($keysString) VALUE (:$valuesString)")
            ->execute($insertData);
    }
    // public function read()
    // {
    //     $queryRead = $this->connection->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10;");
    //     $queryRead->execute();
    //     $all = $queryRead->fetchAll(\PDO::FETCH_ASSOC);
    //     var_dump($all);
    // }
    // public function update($id, $fieldName, $value )
    // {
    //     $queryUpdate = $this->connection->prepare("UPDATE posts SET $fieldName='$value' WHERE id='$id'");
    //     $queryUpdate->execute();
    // }
    // public function delete($id)
    // {
    //     $queryDelete = $this->connection->prepare("DELETE FROM posts  WHERE id='$id'");
    //     $queryDelete->execute();
    // }

}














// config.php url
// index
// parse telegraph
// database


