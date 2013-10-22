<?php

require_once __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);

$app = new Silex\Application();
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../src/views'
));

$app['debug'] = true;

$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig');
});

$app->run();
