<?php

// include some namespace 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

// load all the dependacies 
require __DIR__ . '/../vendor/autoload.php';

// create an app 
$app = AppFactory::create();


$app->get('/', function(Request $request, Response $response){
    $response->getBody()->write("Bonjour, SlimPhP!");
    return $response;
});

$app->run();