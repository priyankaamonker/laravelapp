<?php

namespace App\Http\Controllers;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $cities = array(
        "" => "Select",
        "New York" => "New York",
        "London" => "London",
        "Paris" => "Paris",
        "Texas" => "Texas",
        "San Francisco" => "San Francisco",
    );

    private $durations = array(
        "Today" => "Today",
        "5 days" => "5 days",
    );

    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $weatherData = "";
        if ($request->get('city') != "" && $request->get('duration') == "Today")
            $weatherData = $this->weatherService->getWeathertoday($request->get('city'));
        if ($request->get('city') != "" && $request->get('duration') == "5 days") {
            $weatherData = $this->weatherService->getWeatherforecast($request->get('city'), 40);
            foreach ($weatherData['list'] as $eachday) {
                $_weatherData[date('d-m-y', $eachday['dt'])] = [
                    'dt' => date('d-m-y', $eachday['dt']),
                    'temp' => $eachday['main']['temp'],
                    'feels_like' => $eachday['main']['feels_like'],
                    'temp_min' => $eachday['main']['temp_min'],
                    'temp_max' => $eachday['main']['temp_max'],
                    'description' => $eachday['weather'][0]['description'],
                    'humidity' => $eachday['main']['humidity'],
                    'speed' => $eachday['wind']['speed'],
                    'city' => $weatherData['city']['name'],
                ];
            }
            foreach ($_weatherData as $eachday) {
                $temp[] = $eachday;
            }
            $weatherData = $temp;

        }
        return view('weather.index', ['cities' => $this->cities, 'durations' => $this->durations], ['weather' => $weatherData]);
    }
}