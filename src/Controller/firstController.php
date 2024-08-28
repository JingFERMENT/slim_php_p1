<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class FirstController
{
    private $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function homepage(Request $request, Response $response)
    {

        $templating = $this->ci->get('templating');
        $html = $templating->render('homepage.html');

        $response->getBody()->write($html);
        return $response;
    }
}
