<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    function index()
    {
        $response = Http::get('http://api.openweathermap.org/data/2.5/weather', [
            'q' => 'tokyo',
            'appid' => '01f87b1072a0fc3066fa1715cbc5f0aa'
        ]);
        $dataJson = json_decode($response->body());
       // dd($dataJson);
        $temperature = $dataJson->main->temp - 273;
        $weather = $dataJson->weather;
        $weatherType = $weather[0]->main;

        $data = [
            'temperature' => $temperature,
            'weather_type' => $weatherType,
            'city_name' => $dataJson->name
        ];

        return view('home', compact('data'));
    }
}
