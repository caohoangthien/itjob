<?php
// Home - site
Route::get('/', 'SiteController@index')->name('home-site');

// Login - Logout
Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('company-signup', 'CompanyController@getSignup')->name('companies.signup');
Route::get('forgot-password', 'LoginController@getForgot')->name('forgot-password');
Route::post('forgot-password', 'LoginController@postForgot')->name('forgot-password');
Route::post('company-signup', 'CompanyController@postSignup')->name('companies.signup');
Route::get('member-signup', 'MemberController@getSignup')->name('members.signup');
Route::post('member-signup', 'MemberController@postSignup')->name('members.signup');

// Search job
Route::post('search-job', 'JobController@search')->name('jobs.search');
Route::post('ajax-search-job', 'JobController@searchAjax')->name('jobs.search-ajax');
Route::post('getChart', 'SiteController@getChart')->name('getChart');

Route::get('full-job', 'SiteController@getFullJob')->name('jobs.full');

Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {
    Route::resource('members', 'MemberController');
    Route::resource('companies', 'CompanyController');
    Route::resource('admins', 'AdminController');
    Route::resource('jobs', 'JobController');

    Route::get('list-company', 'CompanyController@list')->name('companies.list');
    Route::get('list-member', 'MemberController@list')->name('members.list');
    Route::get('list-job', 'JobController@list')->name('jobs.list');

    Route::get('profile/admins', 'AdminController@showProfile')->name('admins.profile.show');
    Route::get('profile/admins/edit', 'AdminController@editProfile')->name('admins.profile.edit');
    Route::post('profile/admins', 'AdminController@updateProfile')->name('admins.profile.update');
    Route::post('image/admins', 'AdminController@updateImage')->name('admins.image.update');
    Route::get('jobs-list/admins', 'AdminController@listJob')->name('admins.jobs.list');
    Route::get('show-job/admins/{id}', 'AdminController@showJob')->name('admins.jobs.show');
    Route::get('show-member/admins/{id}', 'AdminController@showMember')->name('admins.members.show');

    Route::get('profile/members', 'MemberController@showProfile')->name('members.profile.show');
    Route::get('profile/members/edit', 'MemberController@editProfile')->name('members.profile.edit');
    Route::post('profile/members', 'MemberController@updateProfile')->name('members.profile.update');
    Route::post('image/members', 'MemberController@updateImage')->name('members.image.update');

    Route::get('profile/companies', 'CompanyController@showProfile')->name('companies.profile.show');
    Route::get('profile/companies/edit', 'CompanyController@editProfile')->name('companies.profile.edit');
    Route::post('profile/companies', 'CompanyController@updateProfile')->name('companies.profile.update');
    Route::post('image/companies', 'CompanyController@updateImage')->name('companies.image.update');

    Route::get('jobs-uncheck', 'CompanyController@listUncheckJob')->name('jobs.uncheck');
    Route::get('jobs-checked', 'CompanyController@listCheckedJob')->name('jobs.checked');
    Route::get('ajax-update-status/{id}', 'JobController@updateStatus')->name('jobs.ajax-update-status');
});