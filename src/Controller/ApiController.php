<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ApiController extends Controller
{
    public function search(Request $request, Response $response)
    {
        // load the album data from a JSON File and decode it into a PHP array
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        // Get the 'q' query parameter from the request, defaulting to an empty string if it's not set
        $query = $request->getQueryParams()['q'] ?? '';

        if ($query) {

        // Filter the albums array to only include albums where the title or artist contains the query string
            $albums = array_values(array_filter($albums, function (
                $album
            ) use ($query) {
                return strpos($album['title'], $query) !== false ||
                    strpos($album['artist'], $query) !== false;
            }));
        }

        $response->getBody()->write(json_encode($albums));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
