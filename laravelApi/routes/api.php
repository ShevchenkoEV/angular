<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('registration', 'AuthController@registration');
    Route::get('home', 'MainController@getAllPosts');
});

Route::group(['namespace' => 'api', 'middleware'=>'auth:api'], function (){
    Route::get('adminMenus', 'MenuController@getMenu');
});

Route::group(['namespace' => 'api\admin', 'middleware' => 'auth:api'], function(){
    Route::resource('users', 'UserController');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('menus', 'MenuController');
});