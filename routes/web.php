<?php

Route::get('/', ['as' => 'home','uses' => 'IndexController@index']);

Route::get('/login', ['as' => 'login','uses' => 'IndexController@getLogin']);
Route::post('/login', ['as' => 'login','uses' => 'IndexController@postLogin']);
Route::get('/signup-user', 'IndexController@getSignupUser');
Route::post('/signup-user', 'IndexController@postSignupUser');
Route::get('/signup-company', 'IndexController@getSignupCompany');
Route::post('/signup-company', 'IndexController@postSignupCompany');