<?php
// Home - site
Route::get('/', 'SiteController@index')->name('home-site');
Route::get('contact', 'SiteController@contact')->name('site.contact');
Route::post('contact', 'SiteController@storeContact')->name('site.contact');




Route::get('company/{id}', 'SiteController@showCompany')->name('company.infor');

Route::post('getChart', 'SiteController@getChart')->name('getChart');

Route::post('search-job', 'JobController@search')->name('jobs.search');
Route::post('ajax-search-job', 'JobController@searchAjax')->name('jobs.search-ajax');
Route::get('search-title/{id}', 'JobController@searchTitle')->name('jobs.search-title');
Route::get('search-address/{id}', 'JobController@searchAddress')->name('jobs.search-address');
Route::get('full-job', 'JobController@getFullJob')->name('jobs.full');

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

// auth - managements
Route::group(['middleware' => 'auth', 'prefix' => 'managements'], function () {

    // Contact - Admin
    Route::get('contacts/list', 'AdminController@listContact')->name('admins.contact.list');
    Route::get('contacts/{id}', 'AdminController@showContact')->name('admins.contact.show');
    Route::get('contacts/{id}/delete', 'AdminController@deleteContact')->name('admins.contact.delete');
    // Skill - Admin
    Route::get('skills/create', 'AdminController@createSkill')->name('admins.skill.create');
    Route::post('skills/create', 'AdminController@storeSkill')->name('admins.skill.store');
    Route::get('skills/list', 'AdminController@listSkill')->name('admins.skill.list');
    Route::get('skills/{id}', 'AdminController@showSkill')->name('admins.skill.show');
    Route::get('skills/{id}/edit', 'AdminController@editSkill')->name('admins.skill.edit');
    Route::post('skills/{id}/update', 'AdminController@updateSkill')->name('admins.skill.update');
    Route::get('skills/{id}/delete', 'AdminController@deleteSkill')->name('admins.skill.delete');
    // Member - Admin
    Route::get('admins/member/list', 'AdminController@listMember')->name('admins.member.list');
    Route::get('admins/member/{id}', 'AdminController@showMember')->name('admins.member.show');
    Route::get('admins/member/{id}/delete', 'AdminController@deleteMember')->name('admins.member.delete');
    // Job - Admin
    Route::get('admins/job/list', 'AdminController@listJob')->name('admins.job.list');
    Route::get('admins/job/{id}', 'AdminController@showJob')->name('admins.job.show');
    Route::get('admins/job/{id}/delete', 'AdminController@deleteJob')->name('admins.job.delete');
    Route::get('ajax-update-status/{id}', 'AdminController@updateJobStatus')->name('admins.job.ajax-update-status');
    // Company - Admin
    Route::get('admins/company/list', 'AdminController@listCompany')->name('admins.company.list');
    Route::get('admins/company/{id}', 'AdminController@showCompany')->name('admins.company.show');
    Route::get('admins/company/{id}/delete', 'AdminController@deleteCompany')->name('admins.company.delete');



    Route::resource('admins', 'AdminController');
    Route::get('profile/admins', 'AdminController@showProfile')->name('admins.profile.show');
    Route::get('profile/admins/edit', 'AdminController@editProfile')->name('admins.profile.edit');
    Route::post('profile/admins', 'AdminController@updateProfile')->name('admins.profile.update');
    Route::post('image/admins', 'AdminController@updateImage')->name('admins.image.update');






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
    Route::get('list-member/companies', 'CompanyController@listMember')->name('companies.list-member');
    Route::get('jobs-uncheck', 'CompanyController@listUncheckJob')->name('jobs.uncheck');
    Route::get('jobs-checked', 'CompanyController@listCheckedJob')->name('jobs.checked');
    Route::get('member-show/conpanies/{id}', 'CompanyController@showMember')->name('companies.show-member');
    // Job of company
    Route::resource('jobs', 'JobController');
    Route::get('list-job', 'JobController@list')->name('jobs.listowMember');


});