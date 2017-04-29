<?php
// Home - site
Route::get('/', 'SiteController@index')->name('home-site');

// Login - Logout
Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('company-signup', 'CompanyController@getSignup')->name('companies.signup');
Route::post('company-signup', 'CompanyController@postSignup')->name('companies.signup');
Route::get('member-signup', 'MemberController@getSignup')->name('members.signup');
Route::post('member-signup', 'MemberController@postSignup')->name('members.signup');

Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {
    Route::resource('members', 'MemberController');
    Route::resource('companies', 'CompanyController');
    Route::resource('admins', 'AdminController');
    Route::resource('jobs', 'JobController');
    Route::get('company-list', 'CompanyController@list')->name('companies.list');
    Route::get('member-list', 'CompanyController@list')->name('members.list');
    Route::get('job-list', 'JobController@list')->name('jobs.list');
    Route::get('companies/profile', 'CompanyController@profile')->name('companies.profile');
    Route::get('members/profile', 'CompanyController@profile')->name('members.profile');
    Route::get('admins/profile', 'AdminController@profile')->name('admins.profile');
    Route::get('admins/edit', 'AdminController@profile')->name('admins.edit-profile');
});