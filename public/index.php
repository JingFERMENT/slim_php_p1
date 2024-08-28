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

// Define app routes
$app->get('/hello/{parameters}', function (Request $request, Response $response, array $args = []) {
    
    $templating = $this->get('templating');
    
    $html = $templating->render('hello.html', [
        'name' => ucfirst($args['parameters'])
    ]);

    $response->getBody()->write($html);

    return $response;
});

$app->run();
