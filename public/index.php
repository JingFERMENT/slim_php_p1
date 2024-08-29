<?php

// include some namespace 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
// dependancy container 
use DI\Container;

// load all the dependacies 
require __DIR__ . '/../vendor/autoload.php';

// create the container 
$container = new Container();

$container->set('templating', function () {
    return new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(
            __DIR__ . '/../templates',
            ['extension' => '']
        )
    ]);
});

AppFactory::setContainer($container);

// Instantiate App
$app = AppFactory::create();

$app->get('/', '\App\Controller\ShopController:default');
// handle when the details is not numeric
$app->get('/details/{id}:[0-9]+', '\App\Controller\ShopController:details');

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// $app->get('/', '\App\Controller\SearchController:default');
// $app->get('/api', '\App\Controller\ApiController:search');
// $app->any('/form', '\App\Controller\SearchController:form');

$app->run();
