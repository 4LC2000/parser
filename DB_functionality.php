<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('config.php');

class DB_functionality
{
    protected $config;
    protected $connection;

    public function __construct()
    {
        $this->config = Config::get('database');
        $this->connection = new PDO(
            "mysql:host={$this->config->host};dbname={$this->config->dbname};charset=utf8mb4",
            $this->config->username,
            $this->config->pass
        );
    }
    public function create($values_array)
    {
        $values = array_map(function($item){
            if(is_int($item)){
                return $item;
            }
            return $this->connection->quote($item);
        }, $values_array);
        $values_string = implode(",", $values);
        $query = "INSERT posts (title, link, description, pub_date) VALUE ($values_string)";
        $count = $this->connection->exec($query);
    }
    public function read()
    {
        $queryRead = $this->connection->prepare("SELECT * FROM (
            SELECT * FROM posts ORDER BY id DESC LIMIT 10
           )Var1
           ORDER BY id ASC;");
        $queryRead->execute();
        $all = $queryRead->fetchAll(PDO::FETCH_ASSOC);
        var_dump($all);
    }
    public function update($id, $fieldName, $value )
    {
        $queryUpdate = $this->connection->prepare("UPDATE posts SET $fieldName='$value' WHERE id='$id'");
        $queryUpdate->execute();
    }
    public function delete($id)
    {
        $queryDelete = $this->connection->prepare("DELETE FROM posts  WHERE id='$id'");
        $queryDelete->execute();
    }

}














// config.php url
// index
// parse telegraph
// database


