<?php
// Home - site
Route::get('/', 'SiteController@index')->name('home-site');
Route::get('company/{id}', 'SiteController@showCompany')->name('company.infor');
Route::get('contact', 'SiteController@contact')->name('contact');
Route::post('contact', 'SiteController@storeContact')->name('contact');

Route::post('search-job', 'JobController@search')->name('jobs.search');
Route::post('ajax-search-job', 'JobController@searchAjax')->name('jobs.search-ajax');
Route::get('search-title/{id}', 'JobController@searchTitle')->name('jobs.search-title');
Route::get('search-address/{id}', 'JobController@searchAddress')->name('jobs.search-address');
Route::get('full-job', 'JobController@getFullJob')->name('jobs.full');
Route::post('getChart', 'JobController@getChart')->name('getChart');

// Login - Logout
Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('forgot-password', 'LoginController@getForgot')->name('forgot-password');
Route::post('forgot-password', 'LoginController@postForgot')->name('forgot-password');

// Company
Route::get('company-signup', 'CompanyController@getSignup')->name('companies.signup');
Route::post('company-signup', 'CompanyController@postSignup')->name('companies.signup');

// Member
Route::get('member-signup', 'MemberController@getSignup')->name('members.signup');
Route::post('member-signup', 'MemberController@postSignup')->name('members.signup');

// auth
Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {

    // Admin
    Route::get('contacts/list', 'AdminController@listContact')->name('contacts.list');
    Route::get('contacts/{id}', 'AdminController@showContact')->name('contacts.show');
    Route::get('contacts/{id}/delete', 'AdminController@deleteContact')->name('contacts.delete');
    Route::resource('admins', 'AdminController');
    Route::get('profile/admins', 'AdminController@showProfile')->name('admins.profile.show');
    Route::get('profile/admins/edit', 'AdminController@editProfile')->name('admins.profile.edit');
    Route::post('profile/admins', 'AdminController@updateProfile')->name('admins.profile.update');
    Route::post('image/admins', 'AdminController@updateImage')->name('admins.image.update');
    Route::get('jobs-list/admins', 'AdminController@listJob')->name('admins.jobs.list');
    Route::get('company-list/admins', 'AdminController@listCompany')->name('admins.company.list');
    Route::get('show-company/admins/{id}', 'AdminController@showCompany')->name('admins.company.show');
    Route::get('show-job/admins/{id}', 'AdminController@showJob')->name('admins.jobs.show');
    Route::get('delete-job/admins/{id}', 'AdminController@deleteJob')->name('admins.jobs.delete');
    Route::get('show-member/admins/{id}', 'AdminController@showMember')->name('admins.members.show');
    Route::get('ajax-update-status/{id}', 'AdminController@updateStatus')->name('jobs.ajax-update-status');
    // Skill
    Route::resource('skills', 'SkillController');

    // Member
    Route::resource('members', 'MemberController');
    Route::get('list-member', 'MemberController@list')->name('members.list');
    Route::get('profile/members', 'MemberController@showProfile')->name('members.profile.show');
    Route::get('profile/members/edit', 'MemberController@editProfile')->name('members.profile.edit');
    Route::post('profile/members', 'MemberController@updateProfile')->name('members.profile.update');
    Route::post('image/members', 'MemberController@updateImage')->name('members.image.update');
    Route::get('show-job/members/{id}', 'MemberController@showJob')->name('members.show-job');

    // Company
    Route::resource('companies', 'CompanyController');
    Route::get('profile/companies', 'CompanyController@showProfile')->name('companies.profile.show');
    Route::get('profile/companies/edit', 'CompanyController@editProfile')->name('companies.profile.edit');
    Route::post('profile/companies', 'CompanyController@updateProfile')->name('companies.profile.update');
    Route::post('image/companies', 'CompanyController@updateImage')->name('companies.image.update');
    Route::post('list-member', 'CompanyController@listMember')->name('companies.members');
    Route::get('jobs-uncheck', 'CompanyController@listUncheckJob')->name('jobs.uncheck');
    Route::get('jobs-checked', 'CompanyController@listCheckedJob')->name('jobs.checked');
    Route::get('member-show/conpanies', 'CompanyController@sh')->name('companies.show-member');
    // Job of company
    Route::resource('jobs', 'JobController');
    Route::get('list-job', 'JobController@list')->name('jobs.listowMember');


});