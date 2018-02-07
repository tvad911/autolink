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
	//$long_url = urlencode('http://youtube.test/admin/stream');
	// $long_url = "http://youtube.test/admin/stream";
 //    $api_token = 'aa457fc9f526a581bec02efb9f9197c9';
 //    $response = Curl::to('https://api.shorte.st/v1/data/url')
 //       	->withHeader('public-api-token: aa457fc9f526a581bec02efb9f9197c9')
 //       	->withData(array('urlToShorten' => "http://youtube.test/admin/stream"))
 //       	//->withContentType('application/json')
 //       	// ->asJson()
 //       	->put();

 //   dd($response);

 //    $result = @json_decode($response,TRUE);

 //    dd($result);
    $long_url = urlencode('yourdestinationlink.com');
    $api_token = '7365e35e0e326060ea46486d2a3b217e84075620';
    $api_url = "http://123link.co/api?api={$api_token}&url={$long_url}&alias=CustomAlias";
    $result = @json_decode(file_get_contents($api_url),TRUE);

    //dd($result);
    if($result['status'] == 'error')
    {
        echo $result['message'];
    }
    else{
        echo $result['shortenedUrl'];
    }
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
