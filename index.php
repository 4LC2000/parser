<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "./vendor/autoload.php";

use Db\Post;
use Parsers\RSS;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$telegraphParser = new RSS($_ENV['url']); //проверить работу env file
$news = $telegraphParser->parse()->getItems();



$postModel = new Post($_ENV);
$postModel->get();

// foreach ($news as $post) {
//     $postModel->store($post);
// }


// $readNewRecord = new DB_functionality();
// echo '<pre>';
// $readNewRecord->read();

// $updateRecord = new DB_functionality;
// // $updateRecord->update(313, 'title', 1);

// $deleteRecord = new DB_functionality;
// // $deleteRecord->delete(313);
