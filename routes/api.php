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
// middleware para manejar el estandar en la respuesta del servidor
Route::middleware('json.response')->group(function () {
    Route::post('/user/register', 'ServicesController@registerUser');
    Route::post('/user/login', 'ServicesController@loginUser');
    // rutas protegidas con api_token
    Route::middleware('token.auth')->group(function () {
        Route::get('/user/logout', 'ServicesController@logoutUser');
        Route::post('/message/create', 'ServicesController@saveMessage');
    });
});
