<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ShopController extends Controller
{
    public function default(Request $request, Response $response)
    {
        $bikes = json_decode(file_get_contents(__DIR__ . '/../../data/bikes.json'), true);

        $html = $this->render($response, 'default.html', ['bikes' => $bikes]);
        return $html;
    }

    
}
