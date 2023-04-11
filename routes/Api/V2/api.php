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

Route::get('/notebook', 'NotebookController@index');
Route::post('/notebook', 'NotebookController@store');
Route::get('/notebook/{?id}', 'NotebookController@index');
Route::post('/notebook/{?id}', 'NotebookController@store');
Route::delete('/notebook/{?id}', 'NotebookController@delete');
