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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('/thread', 'ThreadsController', ['except'=>['show']]);

Route::get('/thread/{thread}', 'HomeController@show')->name('thread.show');

Route::get('/mythread', 'ThreadsController@showMyThread')->name('owner.thread');

Route::resource('/reply', 'RepliesController', ['except'=>['index','create','store']]);

Route::post('/thread/{thread}/replies', 'RepliesController@store')->name('store.reply');
