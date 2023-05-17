<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsApiController;
use App\Http\Controllers\OpenWeatherMapController;

// Rutas para AuthController
Route::post('/signin', [AuthController::class, 'signin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Rutas para NewsApiController
    Route::get('/news/top-headlines', [NewsApiController::class, 'getTopHeadlines']);
    Route::get('/news/everything', [NewsApiController::class, 'getEverything']);
    Route::get('/news/sources', [NewsApiController::class, 'getSources']);
    Route::get('/news/top-headlines/{category}', [NewsApiController::class, 'getTopHeadlinesByCategory']);

    // Rutas para OpenWeatherMapController
    Route::get('/weather/current/{city}', [OpenWeatherMapController::class, 'getCurrentWeather']);
    Route::get('/weather/current/id/{cityId}', [OpenWeatherMapController::class, 'getCurrentWeatherById']);
    Route::get('/weather/current/coordinates/{lat}/{lon}', [OpenWeatherMapController::class, 'getCurrentWeatherByCoordinates']);
    Route::get('/weather/forecast/{city}', [OpenWeatherMapController::class, 'getForecast']);
});
