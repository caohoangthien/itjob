<?php
// Home - site
Route::get('/', ['as' => 'home-site','uses' => 'SiteController@index']);

// Login - Logout
Route::get('login', ['as' => 'login','uses' => 'LoginController@getLogin']);
Route::post('login', ['as' => 'login','uses' => 'LoginController@postLogin']);
Route::get('logout', ['as' => 'logout','uses' => 'LoginController@logout']);

Route::get('companies/signup', ['as' => 'signup-company','uses' => 'CompanyController@getSignup']);
Route::post('companies/signup', ['as' => 'signup-company','uses' => 'CompanyController@postSignup']);
Route::get('members/signup', ['as' => 'signup-member','uses' => 'MemberController@getSignup']);
Route::post('members/signup', ['as' => 'signup-member','uses' => 'MemberController@postSignup']);

Route::group(['middleware' => 'auth', 'prefix' => 'managers'], function () {
    Route::resource('members', 'MemberController');
    Route::resource('companies', 'CompanyController');
    Route::resource('admins', 'AdminController');
    Route::resource('jobs', 'JobController');
    Route::get('profile/company', ['as' => 'companies.profile','uses' => 'CompanyController@profile']);
    Route::get('profile/member', ['as' => 'members.profile','uses' => 'MemberController@profile']);
    Route::get('profile/admin', ['as' => 'admins.profile','uses' => 'AdminController@profile']);
});