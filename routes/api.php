<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('slug', function (Request $request) {
    return str_slug($request->slug);
});

Route::get('user/count', ['as' => 'user.count', 'uses' => 'Api\UsersController@countAll']);
Route::post('user/updatemulti', ['as' => 'user.updatemulti', 'uses' => 'Api\UsersController@postUpdateMulti']);
Route::resource('user','Api\UsersController');

Route::get('group/count', ['as' => 'group.count', 'uses' => 'Api\GroupsController@countAll']);
Route::post('group/updatemulti', ['as' => 'group.updatemulti', 'uses' => 'Api\GroupsController@postUpdateMulti']);
Route::resource('group','Api\GroupsController');

Route::get('profile/showProfile', ['as' => 'video.showProfile', 'uses' => 'Api\ProfileController@showProfile']);
Route::get('profile/editProfile', ['as' => 'video.editProfile', 'uses' => 'Api\ProfileController@editProfile']);
Route::post('profile/updateProfile', ['as' => 'video.updateProfile', 'uses' => 'Api\ProfileController@updateProfile']);
Route::get('profile/editPassword', ['as' => 'video.editPassword', 'uses' => 'Api\ProfileController@editPassword']);
Route::post('profile/updatePassword', ['as' => 'video.updatePassword', 'uses' => 'Api\ProfileController@updatePassword']);
Route::resource('profile','Api\ProfileController');