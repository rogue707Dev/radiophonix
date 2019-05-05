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

use Radiophonix\Http\Controllers\IndexController;

Route::get('/', IndexController::class);

/**
 * Cette route est une copie de celle présente côté front.
 * Elle est nécessaire pour pouvoir générer un lien lors de l'envoi
 * de l'email de réinitialisation de mot de passe.
 */
Route::get('/password-reset/{token}', IndexController::class)->name('password-reset');
