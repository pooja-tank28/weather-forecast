<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class WeatherController extends Controller
{
    public function index(City $city, Request $request)
    {
        $apiUrl = env('WEATHER_FORECAST_API_URL', 'https://openweathermap.org/forecast5');
        $apiKey = env('WEATHER_FORECAST_API_KEY', '858f15fed9292cbe25c341a754c55e45');
        $response = Http::get($apiUrl, [
            'q' => $city->name,
            'appid' => $apiKey,
        ]);
        if ($response->ok()) {
            $data =[
               'data' => $response->object()->list
            ];
            return response()->json($data, 200);
        } else {
            $data =[
               'data' => [],
               'error' => $response->clientError()
            ];
            return response()->json($data, 200);
        }
    }
}
