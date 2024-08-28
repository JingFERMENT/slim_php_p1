<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

abstract class Controller
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    protected function render(Response $response, $template, array $data = [])
    {

        $templating = $this->ci->get('templating');
        $html = $templating->render($template, $data);

        $response->getBody()->write($html);
        return $response;
    }
}

