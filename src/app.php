<?php

/**
 * Services Providers Registration.
 */
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views'
));


/**
 * All routes declaration.
 */
$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig');
});
