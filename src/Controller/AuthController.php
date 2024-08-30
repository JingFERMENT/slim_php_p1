<?php

namespace App\Controller;

// question 3: pourquoi ces Response & Request ? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends Controller {

    public function Login (Request $request, Response $response) {
        echo $this->ci->get('session')->get('count');
        $this->ci->get('session')->set('count', $this->ci->get('session')->get('count') + 1);
        $html = $this->render($response, 'login.html');
        return $html;
    }

}