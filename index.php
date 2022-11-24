<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once "./vendor/autoload.php";

use Db\Post;
use Parsers\Kg;
use Parsers\Kt;
use Parsers\Telegraph;
use Controllers\PostController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $route = match ($_GET['route'] ?? 'view') {
        'view' => function () {
            $postList = new PostController;
            $postList->view();
        },
        'add' => function () {
            $postController = new PostController;
            $postController->addNews();
        },
        'post' => function () {
            $postController = new PostController;
            $postController->post();
        },
        'update' => function () {
            $postController = new PostController;
            $result = $postController->update();

            if ($result) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        },
        'save' => function () {
            $postController = new PostController;
            $postController->add();
        },
    };
    $route();
} catch (\UnhandledMatchError $e) {
    var_dump($e);
}

