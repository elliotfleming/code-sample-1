<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Home Page
Route::get('/', array(
    'as'   => 'home',
    'uses' => 'HomeController@getIndex'
));

// Account
Route::controller('account', 'AccountController', [
	'getIndex'    => 'account.home', // This routes to /account/index
	'getPrivacy'  => 'account.privacy',
	'getProfile'  => 'account.profile',
	'getSettings' => 'account.settings'
]);

// Admin Users
Route::resource('admin/users', 'AdminUsersController');
Route::get('admin/users/restore/{id}', ['as' => 'admin.users.restore', 'uses' => 'AdminUsersController@restore']);

// Admin
Route::controller('admin', 'AdminController');

// Auth
Route::controller('auth', 'AuthController');
Route::get('signup', ['as' => 'auth.signup', 'uses' => 'AuthController@getSignup']);
Route::post('signup', ['as' => 'auth.signup.post', 'uses' => 'AuthController@postSignup']);
Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
Route::post('login', ['as' => 'auth.login.post', 'uses' => 'AuthController@postLogin']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogout']);

// Splash Page
Route::controller('splash', 'SplashController', ['getIndex' => 'splash']);

// Users
Route::resource('users', 'UsersController');
