<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once "./vendor/autoload.php";
require_once "./route/route.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $route();
} catch (\UnhandledMatchError $e) {
    var_dump($e);
}
