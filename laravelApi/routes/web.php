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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/','HomeController@index')->name('home');

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', 'AuthController@registerForm')->name('register.create');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::get('/login', 'AuthController@loginForm')->name('login.create');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function (){
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::group(['prefix'=>'admin', 'namespace'=>'admin'], function (){
    Route::get('/', 'MainController@index')->name('main.page');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/menus', 'MenuController');
});