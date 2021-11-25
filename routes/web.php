<?php

use Illuminate\Support\Facades\Route;
//https://github.com/mtrajano/laravel-swagger
//resolveRequestSignature
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

 
Route::group(['prefix'=> 'api/v3'], function(){
//Route::group(['middleware' => ['cors', 'json.response']], function () {
        // ...
  //  });
  
  Route::group(['middleware' => ['throttle:30,1']], function() {

    Route::post('/forgotpassword', 'PasswordController@forgotpassword');
    Route::post('/verify','PasswordController@verify');
    Route::post('/changepassword','PasswordController@changepassword');
    Route::post('/user','AuthController@register');
    Route::post('user/login', 'AuthController@login');
    Route::post('user/logout', 'AuthController@logout');
    Route::post('user/info','AuthController@testphone');
    Route::get('user','AuthController@getuser');
    Route::post('tokens','AccesTokenController@generate');
    Route::get('tokens','AccesTokenController@index');
  });


Route::group(['middleware' => ['jwt.verify']], function() {

Route::resource('channels','ChannelController',['except'=>['edit','create']]);
Route::resource('channels/{channel}/videos', 'VideoController')->only(['index', 'store']);
Route::resource('videos', 'VideoController')->only(['update', 'destroy', 'show']);
Route::put('channels/{channel}/subscribes', 'ChannelController@subscribes');
Route::put('channels/{channel}/unsubscribes', 'ChannelController@unsubscribes');
Route::get('/user/profile/channels','ProfileController@getchannel');
Route::get('/user/profile','ProfileController@getuser');
Route::PATCH('/user/profile/','ProfileController@edit');

});
});
Route::group(['prefix'=> 'api/v4'], function(){

  Route::group(['middleware' => ['jwt.verify']], function() {
  Route::post('/videos/{video}/trailer','FController@traileruploadv1');
  Route::get('/videos/{video}/trailer','FController@getfile1');
  });
});


// file logo upload api 
Route::group(['prefix'=> 'api/v3.1/logo'], function(){
Route::group(['middleware' => ['jwt.verify']], function() {
Route::post('user/file','FController@logouploadv1');
Route::get('user/file/{file}','FController@getfile1');
});
});

Route::group(['prefix'=> 'api/v3.2/logo'], function(){
  Route::group(['middleware' => ['jwt.verify']], function() {
  Route::post('/user/file','FController@logouploadv2');
  Route::get('/user/file/{file}','FController@getfile2');
  });
});

  Route::group(['prefix'=> 'api/v3.3/logo'], function(){
    Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/user/file','FController@logouploadv3');
    Route::get('/user/file/{file}','FController@getfile3');
    });
  });

//upload trailer 
// file logo upload api 

//Route::group(['prefix' => 'api/v1.1/apikey'], function () {
 // Route::group(['middleware' => ['jwt.verify']], function() {

 // Route::get('/', 'ّApiKeyController@getallapikey');
  //Route::post('/','ّApiKeyController@createApikeyv1');
  //Route::delete('/{id}/revoke','ّApiKeyController@revokeApikey');
  //Route::get('/{id}','ّApiKeyController@getApikey');
  //Route::put('/{id}/refresh','ّApiKeyController@rfereshApikey');

//});
//});
Route::group(['prefix' => 'api/v1.3/apikey'], function () {
  Route::group(['middleware' => ['jwt.verify']], function() {

  Route::get('/', 'ّApiKeyController@getallapikey');
  Route::post('/','ّApiKeyController@createApikeyv3');
  //Route::delete('/{id}/revoke','ّApiKeyController@revokeApikey');
  //Route::get('/{id}','ّApiKeyController@getApikey');
  //Route::put('/{id}/refresh','ّApiKeyController@rfereshApikey');

});
});
Route::group(['prefix' => 'api/v1.4/apikey'], function () {
  Route::group(['middleware' => ['jwt.verify']], function() {
  Route::get('/', 'ّApiKeyController@getallapikey');
  Route::post('/','ّApiKeyController@createApikeyv4');

});
});






