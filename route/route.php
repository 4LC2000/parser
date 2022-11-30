<?php

use Controllers\PostController;
use Controllers\AuthController;

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
    'registration' => function () {
        $authController = new AuthController;
        $authController->view();
    },
};