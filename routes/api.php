<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\WeatherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::middleware(['api'])->group(function () {
        Route::namespace('Api\v1')->group(function () {
                Route::get('cities', 'CityController@index');
                Route::post('cities', 'CityController@store');
                Route::get('cities/{city}', 'CityController@show');
                Route::get('weather/{city}', 'WeatherController@index');
        });
    });
});
