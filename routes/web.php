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

// Route::get('/', 'UsersController@login');
// Route::get('home/veripro', 'HomeController@index');
// Route::resource('users', 'UsersController');
// Route::resource('home', 'HomeController');
// Route::resource('users/login', 'UsersController', ['only' => [
//     'store'
// ]]);

Route::get('/', 'UsersController@login');
Route::get('/users/logout', 'UsersController@logout');
Route::get('/home', 'HomeController@index');
Route::get('/home/search/{searchText}/{searchField}', 'HomeController@search');

Route::resource('users', 'UsersController');

Route::get('/crew/{applicantNo}', 'CrewsController@show201');
