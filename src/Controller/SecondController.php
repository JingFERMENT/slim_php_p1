<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SecondController extends Controller
{
    public function hello(Request $request, Response $response)
    {
        $html = $this->render($response, 'hello.html', ['name' => 'Jing'] );
        return $html;
    }
}
