<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', 'RegisterController');
Route::post('/login', 'LoginController');
Route::get('/logout', 'LogoutController');

Route::group([
    'middleware' => 'api.auth'
], function () {
    Route::get('/notebook', 'NotebookController@index');
    Route::post('/notebook', 'NotebookController@store');

    Route::group([
        'middleware' => 'api.auth.action'
    ], function () {
        Route::get('/notebook/{id}', 'NotebookController@show');
        Route::post('/notebook/{id}', 'NotebookController@update');
        Route::delete('/notebook/{id}', 'NotebookController@delete');
    });
});
