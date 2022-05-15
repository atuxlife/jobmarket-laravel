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
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');
    Route::get('users', 'AuthController@allusers');
    // Endpoints de Ofertas de trabajo
    Route::get('jobs', 'JobController@index');
    Route::get('jobs/{id}', 'JobController@show');
    Route::get('apply/{id}', 'JobController@apply');
    Route::post('jobs', 'JobController@store');
    Route::put('jobs/{id}', 'JobController@update');
    Route::get('jobslist', 'JobController@jobslist');
});
