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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/user/profile/edit', 'UserController@profileShow')->name('user.profile');
Route::patch('/user/profile', 'UserController@profileUpdate')->name('user.save');
Route::delete('user/profile', 'UserController@destroy')->name('user.delete');
