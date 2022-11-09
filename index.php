<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "./vendor/autoload.php";

use Db\Post;
use Parsers\Kg;
use Parsers\Telegraph;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

 $telegraphParser = new Telegraph($_ENV['Telegraph_RSSurl']);
 $news = $telegraphParser->parse()->getItems();
 
 $kgParser = new Kg($_ENV['Kg_RSSurl']);
 $newsKg = $kgParser->parse()->getItems();

$postModel = new Post($_ENV);

foreach ($news as $post) {
    $postModel->store($post);
}
foreach ($newsKg as $post) {
    $postModel->store($post);
}





