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

    public function details(Request $request, Response $response, Array $args = [])
    {
        // load the album data from a JSON File and decode it into a PHP array
        $bikes = json_decode(file_get_contents(__DIR__ . '/../../data/bikes.json'), true);

        $key = array_search($args['id'], array_column($bikes, 'id'));

        $html = $this->render($response, 'details.html', ['bike'=> $bikes[$key]] );

        return $html;
    }

    
}
