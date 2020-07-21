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

Route::get('/reviews/all', function () {
    return 'все';
});
Route::get('/reviews/{id}', function ($id) {
    return 'один-'.$id;
});
Route::post('/reviews/new', function () {
    return 'новый';
});
