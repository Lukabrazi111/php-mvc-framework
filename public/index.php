<?php

include_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;
use app\core\controllers\SiteController;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'index');
$app->router->get('/contact', [SiteController::class, 'contact']);

$app->run();