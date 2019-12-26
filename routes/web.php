<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'api', 'as' => 'api'], function () {
    Route::post('register-user', 'Api\RegisterAndAuthController@registerUser');
    Route::post('sign-in-user', 'Api\RegisterAndAuthController@signInUser');
    Route::resource('companies','Api\CompaniesController')->except(['create', 'edit', 'show']);
    Route::get('companies-all', 'Api\CompaniesController@getAllCompanies');
    Route::resource('employees', 'Api\UserController')->except(['create', 'edit', 'show']);
});
