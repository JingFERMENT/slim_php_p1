<?php

namespace App\Controller;

// question 3: pourquoi ces Response & Request ? 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController extends Controller {

    public function Login (Request $request, Response $response) {
        
        // check if the session works
        // echo $this->ci->get('session')->get('count');
        // $this->ci->get('session')->set('count', $this->ci->get('session')->get('count') + 1);
        
        if($request->getMethod() === 'POST'){

            // when the post method, we use getParseBody
            $body = $request->getParsedBody('email');
            $email = $body['email'];

            $this->ci->get('session')->set('user', $email);

            return $response->withHeader('Location', '/secure')->withStatus(302);
        }
        
        $html = $this->render($response, 'login.html');
        return $html;
    }

    public function Logout(Request $request, Response $response) {
        
        $this->ci->get('session')->delete('user');
        return $response->withHeader('Location', '/')->withStatus(302);
    }

}