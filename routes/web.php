<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'BlogController@index')->name('home');
Route::get('/show/{post}', 'BlogController@show')->name('post.show');
Route::post('/comment', 'BlogController@storeComment')->name('comment.store');

Route::group(['namespace' => 'Auth'], function () {
	Route::group(['middleware' => ['guest']], function () {
		Route::get('login', 'LoginController@showForm')->name('loginForm');
		Route::post('login', 'LoginController@login')->name('login');
		Route::get('register', 'RegisterController@showForm')->name('registerForm');
		Route::post('register', 'RegisterController@register')->name('register');
	});
	Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.', 'namespace' => 'Admin'], function () {
	Route::resource('post', 'PostController')->except(['show']);
	Route::resource('user', 'UserController')->except(['show']);
});

Route::group(['middleware' => ['auth']], function () {
	Route::view('/admin', 'admin.home')->name('admin.home');
	Route::get('profile', 'Admin\UserController@profile')->name('profile');
	Route::put('profile', 'Admin\UserController@updateProfile')->name('profile.update');
});
