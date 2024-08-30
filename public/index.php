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

$container->set('session', function () {
    return new \SlimSession\Helper();
});

AppFactory::setContainer($container);

// Instantiate App
$app = AppFactory::create();

$app->add(new \Slim\Middleware\Session);

$app->any('/', '\App\Controller\AuthController:login');
$app->get('/secure', '\App\Controller\SecureController:default')
->add(new \App\Middleware\Authenticate($app->getContainer()->get('session')));
$app->get('/logout', '\App\Controller\AuthController:logout');


// $app->get('/', '\App\Controller\ShopController:default');
// // handle when the details is not numeric
// $app->get('/details/{id:[0-9]+}', '\App\Controller\ShopController:details');

// Add Error Middleware
// put "false" in production 
// $errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Set Custom Error Handler for 404 Not Found
// $errorMiddleware->setErrorHandler(
//     Slim\Exception\HttpNotFoundException::class, function(
//         Psr\Http\Message\ServerRequestInterface $request) use ($container) {
//             $controller = new App\Controller\ExceptionController(
//                 $container);
//             return $controller->notFound($request);
//         }
// );

// $app->get('/', '\App\Controller\SearchController:default');
// $app->get('/api', '\App\Controller\ApiController:search');
// $app->any('/form', '\App\Controller\SearchController:form');

$app->run();
