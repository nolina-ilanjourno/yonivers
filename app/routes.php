<?php

use App\Helpers\Route;

Route::get('/', 'MessagesController@index');
Route::post('/', 'MessagesController@store');