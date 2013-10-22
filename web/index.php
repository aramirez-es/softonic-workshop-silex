<?php

/**
 * Front controller is the entry point of the application
 */
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

require_once __DIR__ . '/../src/app.php';

$app->run();
