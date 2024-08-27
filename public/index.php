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

AppFactory::setContainer($container);

// Instantiate App
$app = AppFactory::create();

// Define app routes

// 1st route
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, SlimPhP!");
    return $response;
});

// 2nd route
$app->get('/hello/jing', function (Request $request, Response $response) {
    $response->getBody()->write("Hello, Jing");
    return $response;
});

// 3nd route by using a parameter
// array $args = parameters 
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = ucfirst($args['name']);
    $response->getBody()->write(sprintf("Hello, %s!", $name));
    return $response;
});

$app->run();
