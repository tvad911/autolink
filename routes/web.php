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
use Ixudra\Curl\Facades\Curl;

Route::get('/', function () {
    //return view('welcome');
	// $long_url = urlencode('https://www.youtube.com/watch?v=fngk6-I-Bc4');
 //    $api_token = '7365e35e0e326060ea46486d2a3b217e84075620';
 //    $api_url = "http://123link.co/api?api={$api_token}&url={$long_url}&alias=CustomAlias";
 //    $result = @json_decode(file_get_contents($api_url),TRUE);

 //    dd($api_url);
    // if($result["status"] === 'error') {
    //  echo $result["message"];
    // } else {
    //  echo $result["shortenedUrl"];
    // }
    // $long_url = urlencode('https://shorte.st/login');
    // $api_token = 'af35ed0994ef0128f31ea30ee7f59c68b71fa6da';
    // $api_url = "https://megaurl.in/api?api={$api_token}&url={$long_url}&alias=CustomAlias";
    // $result = @json_decode(file_get_contents($api_url),TRUE);

    // dd($result);
    $long_url = urlencode('biquyetmuasam.com');
    $api_token = 'af35ed0994ef0128f31ea30ee7f59c68b71fa6da';
    $api_url = "https://megaurl.in/api?api={$api_token}&url={$long_url}&alias=CustomAlias";
    $result = @json_decode(file_get_contents($api_url),TRUE);

    dd($result);
    // if($result["status"] === 'error') {
    //     echo $result["message"];
    // } else {
    //     echo $result["shortenedUrl"];
    // }
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('dashboard','Backend\DashboardController');
    Route::resource('user','Backend\UsersController');
    Route::resource('group','Backend\GroupsController');
    Route::resource('link','Backend\LinksController');
    Route::get('profile/showProfile', ['as' => 'profile.showProfile', 'uses' => 'Backend\ProfileController@showProfile']);
    Route::get('profile/editProfile', ['as' => 'profile.editProfile', 'uses' => 'Backend\ProfileController@editProfile']);
    Route::get('profile/editPassword', ['as' => 'profile.editPassword', 'uses' => 'Backend\ProfileController@editPassword']);
    Route::get('profile/apiShortestUrl', ['as' => 'profile.apiShortestUrl', 'uses' => 'Backend\ProfileController@apiShortestUrl']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
