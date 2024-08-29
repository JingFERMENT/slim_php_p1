<?php 

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
// question 1: pourquoi ces réponses ??
use Slim\Psr7\Response;

class ExceptionController extends Controller {
    
    public function notFound(Request $request) {

        $response = new Response;
        $html= $this->render($response, 'not_found.html');
        return $html;

    }
}