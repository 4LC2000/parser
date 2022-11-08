<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "./vendor/autoload.php";

use Db\Post;
use Parsers\Kg;
use Parsers\Telegraph;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// $telegraphParser = new Telegraph($_ENV['Telegraph_RSSurl']); //проверить работу env file
// $news = $telegraphParser->parse()->getItems();

// dd($news);

// $postModel = new Post($_ENV);
// $postModel->get();

$kgParser = new Kg($_ENV['Kg_RSSurl']);
$newsKg = $kgParser->parse()->getItems();
dd($newsKg);
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
