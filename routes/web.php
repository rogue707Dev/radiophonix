<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', 'Api\\V1\\ApiController@home');

Route::get('/', function () {
    return file_get_contents(__DIR__ . '/../public/index.html');
});
