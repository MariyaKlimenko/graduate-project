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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('users/create', 'UserController@showCreateForm')
    ->name('showUserCreateForm')
    ->middleware('auth', 'level:3');

Route::post('users/store', 'UserController@store')
    ->name('storeUser')
    ->middleware('auth', 'level:3');

Route::get('users/show/all', 'UserController@showAll')
    ->name('showAllUsers')
    ->middleware('auth', 'level:2');

Route::get('users/getDataTableData', 'UserController@getData')
    ->name('users/getDataTableData')
    ->middleware('auth', 'level:2');

Route::get('users/show/{id}', 'UserController@show')
    ->name('users/show')
    ->middleware('auth', 'level:2');

Route::get('users/delete/{id}', 'UserController@delete')
    ->name('users/delete')
    ->middleware('auth', 'level:3');
