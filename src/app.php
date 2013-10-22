<?php

use OpenTonic\Services\WorklogsRepository;
use OpenTonic\Controllers;

/**
 * Services Providers Registration.
 */
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
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
$app['opentonic.controllers.home'] = $app->share(function() use ($app){
    return new Controllers\Home($app['twig'], $app['opentonic.worklogs.repository']);
});
$app['opentonic.controllers.worklogs'] = $app->share(function() use ($app){
    return new Controllers\Worklogs($app['twig'], $app['opentonic.worklogs.repository'], $app['request']);
});
$app['opentonic.controllers.users'] = $app->share(function() use ($app){
    return new Controllers\Users($app['twig'], $app['opentonic.worklogs.repository']);
});



/**
 * All routes declaration.
 */
// Home.
$app->get('/', 'opentonic.controllers.home:homeAction')->bind('home');

// Worklogs.
$app->get('/worklogs/{id}', 'opentonic.controllers.worklogs:detailAction')
    ->convert('id', function($id){ return (int) $id; })
    ->bind('worklog')
;
$app->post('/worklogs', 'opentonic.controllers.worklogs:saveAction')->bind('save_worklog');

// Users.
$app->get('/users/{id}/worklogs', 'opentonic.controllers.users:worklogsAction')
    ->convert('id', function($id){ return (int) $id; })
    ->bind('worklogs_by_user')
;
