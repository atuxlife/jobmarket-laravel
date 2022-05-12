<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router){
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::get('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::get('users', 'App\Http\Controllers\AuthController@allusers');
    // Endpoints de Ofertas de trabajo
    Route::get('jobs', 'App\Http\Controllers\JobController@index');
    Route::get('jobs/{id}', 'App\Http\Controllers\JobController@show');
    Route::get('apply/{id}', 'App\Http\Controllers\JobController@apply');
    Route::post('jobs', 'App\Http\Controllers\JobController@store');
    Route::put('jobs/{id}', 'App\Http\Controllers\JobController@update');
});
