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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// вывод всех записей
Route::get('country', 'App\Http\Controllers\Api\CountryController@country');

// вывод одной записи
Route::get('country/{id}', 'App\Http\Controllers\Api\CountryController@countryId');

// авторизация
Route::post('login', 'App\Http\Controllers\Api\LoginController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
    // добавление записи
    Route::post('country', 'App\Http\Controllers\Api\CountryController@countryCreate');

    // редактирование записи
    Route::put('country/{id}', 'App\Http\Controllers\Api\CountryController@countryEdit');

    // удаление записи
    Route::delete('country/{id}', 'App\Http\Controllers\Api\CountryController@countryDelete');

    // обновление токена авторизации
    Route::get('refresh', 'App\Http\Controllers\Api\LoginController@refresh');
});
