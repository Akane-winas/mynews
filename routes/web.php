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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
  //管理者ニュースポストに関して
  Route::get('news/create', 'Admin\NewsController@add');
  Route::post('news/create', 'Admin\NewsController@create');

  Route::get('news/edit', 'Admin\NewsController@edit');
  Route::post('news/edit', 'Admin\NewsController@update');

  Route::get('news', 'Admin\NewsController@index');
  Route::get('news/delete', 'Admin\NewsController@delete');

  //管理者プロフィールに関して
  Route::get('profile/create', 'Admin\ProfileController@add');
  Route::post('profile/create', 'Admin\ProfileController@create');

  Route::get('profile/edit', 'Admin\ProfileController@edit');
  Route::post('profile/edit', 'Admin\ProfileController@update');

  Route::get('profile', 'Admin\ProfileController@index');
  Route::get('profile/delete', 'Admin\ProfileController@delete');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//一般閲覧者側
Route::get('/', 'NewsController@index');

Route::get('/help', 'HelpController@index');
Route::post('/help/confirm', 'HelpController@confirm');
Route::post('/help/comfirm', 'HelpController@send');


Route::get('/profile', 'ProfileController@index');
