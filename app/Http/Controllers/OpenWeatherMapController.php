<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OpenWeatherMapController extends Controller
{
    private $apiKey = 'ef2b8925cf5368a8fec284e1ea7252bb';
    private $baseUri = 'http://api.openweathermap.org/data/2.5/';

    public function getCurrentWeather(Request $request, $city)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'weather', [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => $request->input('units', 'metric'),
            ]
        ]);

        return $response->getBody();
    }

    public function getCurrentWeatherById(Request $request, $cityId)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'weather', [
            'query' => [
                'id' => $cityId,
                'appid' => $this->apiKey,
                'units' => $request->input('units', 'metric'),
            ]
        ]);

        return $response->getBody();
    }

    public function getCurrentWeatherByCoordinates(Request $request, $lat, $lon)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'weather', [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->apiKey,
                'units' => $request->input('units', 'metric'),
            ]
        ]);

        return $response->getBody();
    }

    public function getForecast(Request $request, $city)
    {
        $client = new Client();
        $response = $client->get($this->baseUri . 'forecast', [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => $request->input('units', 'metric'),
            ]
        ]);

        return $response->getBody();
    }

}
