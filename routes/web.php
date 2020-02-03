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

Route::get('/', 'ListController@show');

//for google login
Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');

Route::match(['get','post'],'/login','ListController@login');
Route::match(['get','post'],'/register','ListController@register');
Route::get('/checkUserEmail','ListController@checkUserEmail');
Route::match(['get','post'], '/verify-email/{id}/{token}', 'ListController@verifyEmail');

// forgot password starts
Route::get('/user-forgot-password','ListController@forgotPassword');
Route::post('/user-send-link-forgot-password','ListController@sendLink');
Route::get('/user-reset-password-link/{key}/{id}','ListController@confirmationMessage');
Route::match(['get','post'],'/user-reset-password','ListController@resetPassword'); 

Route::match(['get','post'],'/uploadImage','ListController@uploadImage');

Route::group(['middleware'=>'CheckUserAuth'],function(){
	Route::match(['get','post'],'/create-project','ListController@createProject');
	Route::match(['get','post'],'/project-list','ListController@projectList');
	Route::match(['get','post'],'/logout','ListController@logout');
	Route::match(['get','post'],'/gallery','ListController@gallery');
});

