<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SearchController extends Controller
{
    public function default(Request $request, Response $response)
    {
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        $html = $this->render($response, 'default.html', ['albums' => $albums]);
        return $html;
    }

    public function form(Request $request, Response $response)
    {
        // load the album data from a JSON File and decode it into a PHP array
        $albums = json_decode(file_get_contents(__DIR__ . '/../../data/albums.json'), true);

        // Get the 'q' query parameter from the request, defaulting to an empty string if it's not set
        $postData = $request->getParsedBody();
        $query = $postData ['q'] ?? '';

        if ($query) {

        // Filter the albums array to only include albums where the title or artist contains the query string
            $albums = array_values(array_filter($albums, function (
                $album
            ) use ($query) {
                return strpos($album['title'], $query) !== false ||
                    strpos($album['artist'], $query) !== false;
            }));
        }

        $html = $this->render(
            $response,
            'form.html',
            ['albums' => $albums, 'query' => $query]
        );
        return $html;
    }
}
