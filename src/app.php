<?php

use OpenTonic\Services\WorklogsRepository;

/**
 * Services Providers Registration.
 */
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/OpenTonic/views'
));
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'dbs.options' => array (
        'default' => array(
            'driver'    => 'pdo_mysql',
            'host'      => 'localhost',
            'dbname'    => 'workshop',
            'user'      => 'softonic',
            'password'  => 'softonic',
            'charset'   => 'utf8',
        )
    ),
));

$app['opentonic.worklogs.repository'] = $app->share(function() use ($app){
    return new WorklogsRepository($app['db']);
});


/**
 * All routes declaration.
 */
$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig', array(
        'worklogs' => $app['opentonic.worklogs.repository']->getList()
    ));
});
