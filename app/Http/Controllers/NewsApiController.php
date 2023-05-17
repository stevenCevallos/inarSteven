<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class NewsApiController extends Controller
{
    private $apiKey = '19199a46ead7474a9ea6b66b47d00b75';
    private $baseUri = 'https://newsapi.org/v2/';

    public function getTopHeadlines(Request $request)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'top-headlines', [
            'query' => [
                'country' => $request->input('country', 'us'),
                'apiKey' => $this->apiKey,
            ]
        ]);

        return $response->getBody();
    }

    public function getEverything(Request $request)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'everything', [
            'query' => [
                'q' => $request->input('q', 'laravel'),
                'apiKey' => $this->apiKey,
            ]
        ]);

        return $response->getBody();
    }


    public function getSources(Request $request)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'sources', [
            'query' => [
                'language' => $request->input('language', 'en'),
                'apiKey' => $this->apiKey,
            ]
        ]);

        return $response->getBody();
    }

    

    public function getTopHeadlinesByCategory(Request $request, $category)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'top-headlines', [
            'query' => [
                'category' => $category,
                'country' => $request->input('country', 'us'),
                'apiKey' => $this->apiKey,
            ]
        ]);

        return $response->getBody();
    }
}
