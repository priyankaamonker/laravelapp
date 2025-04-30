<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $client;
    protected $url;
    protected $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = env('WEATHER_API_URL');
        $this->apiKey = env('WEATHER_API_KEY');
    }

    public function getWeathertoday($city)
    {
        $response = $this->client->get($this->url."weather", [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'imperial'  // or 'imperial' for Fahrenheit
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getWeatherforecast($city, $duration)
    {
        $response = $this->client->get($this->url."forecast", [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'imperial',  // or 'imperial' for Fahrenheit
                'cnt' => $duration,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}

