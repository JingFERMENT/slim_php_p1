<?php 

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class Authenticate {
    
    private $session;

    public function __construct($session){
        
        $this->session = $session;
    }

    // run the middleware

    public function __invoke(Request $request, RequestHandler $handler){

        if($this->session->exists('user')){
            // User is authenticated, proceed to the next handler
            return $handler->handle($request);
        }

      $response = new \Slim\Psr7\Response();;
        return $response->withHeader('Location', '/')->withStatus(302);
    }
    
}