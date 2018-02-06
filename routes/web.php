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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('dashboard','Backend\DashboardController');
    Route::resource('user','Backend\UsersController');
    Route::resource('group','Backend\GroupsController');
    Route::get('profile/showProfile', ['as' => 'profile.showProfile', 'uses' => 'Backend\ProfileController@showProfile']);
    Route::get('profile/editProfile', ['as' => 'profile.editProfile', 'uses' => 'Backend\ProfileController@editProfile']);
    Route::get('profile/editPassword', ['as' => 'profile.editPassword', 'uses' => 'Backend\ProfileController@editPassword']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
