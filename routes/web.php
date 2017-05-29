<?php
// Home - site
Route::get('/', 'SiteController@index')->name('home-site');
Route::get('contact', 'SiteController@contact')->name('site.contact');
Route::post('contact', 'SiteController@storeContact')->name('site.contact');
Route::get('company/{id}', 'SiteController@showCompany')->name('company.infor');
Route::post('getChart', 'SiteController@getChart')->name('getChart');

Route::post('search-job', 'SiteController@searchJob')->name('jobs.search');
Route::post('ajax-search-job', 'SiteController@searchAjax')->name('jobs.search-ajax');
Route::get('search-title/{id}', 'SiteController@searchTitle')->name('jobs.search-title');
Route::get('search-address/{id}', 'SiteController@searchAddress')->name('jobs.search-address');
Route::get('full-job', 'SiteController@getFullJob')->name('jobs.full');

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
    Route::get('admins/member/{id}/show', 'AdminController@showMember')->name('admins.member.show');
    Route::get('admins/member/{id}/delete', 'AdminController@deleteMember')->name('admins.member.delete');
    // Job - Admin
    Route::get('admins/job/list', 'AdminController@listJob')->name('admins.job.list');
    Route::get('admins/job/{id}/show', 'AdminController@showJob')->name('admins.job.show');
    Route::get('admins/job/{id}/delete', 'AdminController@deleteJob')->name('admins.job.delete');
    Route::get('ajax-update-status/{id}', 'AdminController@updateJobStatus')->name('admins.job.ajax-update-status');
    // Company - Admin
    Route::get('admins/company/list', 'AdminController@listCompany')->name('admins.company.list');
    Route::get('admins/company/{id}/show', 'AdminController@showCompany')->name('admins.company.show');
    Route::get('admins/company/{id}/delete', 'AdminController@deleteCompany')->name('admins.company.delete');

    // Admin - Profile
    Route::get('admins', 'AdminController@index')->name('admins.index');
    Route::get('profile/admins', 'AdminController@showProfile')->name('admins.profile.show');
    Route::get('profile/admins/edit', 'AdminController@editProfile')->name('admins.profile.edit');
    Route::post('profile/admins', 'AdminController@updateProfile')->name('admins.profile.update');
    Route::post('image/admins', 'AdminController@updateImage')->name('admins.image.update');

    // Company
    Route::get('companies', 'CompanyController@index')->name('companies.index');
    Route::get('companies/job/create', 'CompanyController@createJob')->name('companies.job.create');
    Route::post('companies/job/create', 'CompanyController@storeJob')->name('companies.job.store');
    Route::get('companies/job/{id}/show', 'CompanyController@showJob')->name('companies.job.show');
    Route::get('companies/job/{id}/edit', 'CompanyController@editJob')->name('companies.job.edit');
    Route::post('companies/job/{id}/edit', 'CompanyController@updateJob')->name('companies.job.update');
    Route::get('companies/job/{id}/delete', 'CompanyController@deleteJob')->name('companies.job.delete');
    Route::get('companies/job/uncheck', 'CompanyController@listUncheckJob')->name('companies.job.uncheck');
    Route::get('companies/job/checked', 'CompanyController@listCheckedJob')->name('companies.job.checked');
    Route::get('companies/member/list', 'CompanyController@listMember')->name('companies.member.list');
    Route::get('companies/member/{id}/show', 'CompanyController@showMember')->name('companies.member.show');
    Route::get('companies/profile', 'CompanyController@showProfile')->name('companies.profile.show');
    Route::get('companies/profile/edit', 'CompanyController@editProfile')->name('companies.profile.edit');
    Route::post('companies/profile', 'CompanyController@updateProfile')->name('companies.profile.update');
    Route::post('companies/image', 'CompanyController@updateImage')->name('companies.image.update');

    // Member
    Route::get('members', 'MemberController@index')->name('members.index');
    Route::get('members/profile', 'MemberController@showProfile')->name('members.profile.show');
    Route::get('members/profile/edit', 'MemberController@editProfile')->name('members.profile.edit');
    Route::post('members/profile', 'MemberController@updateProfile')->name('members.profile.update');
    Route::post('members/image', 'MemberController@updateImage')->name('members.image.update');
    Route::get('members/show-job/{id}', 'MemberController@showJob')->name('members.show-job');
});