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
Route::get('/home/search/{searchText1}/{fieldToSearch1}', 'HomeController@search');
Route::get('/home/search/{searchText1}/{fieldToSearch1}/{searchText2}/{fieldToSearch2}', 'HomeController@search');

Route::resource('users', 'UsersController');

Route::get('/crews/{applicantNo}', 'CrewsController@show201');
