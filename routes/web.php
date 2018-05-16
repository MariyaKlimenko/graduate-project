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

Route::post('users/updateGeneralInfo', 'UserController@update')
    ->name('users/updateGeneralInfo')
    ->middleware('auth', 'level:3');

Route::get('users/getUpdateGeneralInfoPartial/{id}', 'PartialsController@getUpdateGeneralInfo')
    ->name('users/getUpdateGeneralInfoPartial')
    ->middleware('auth', 'level:3');

Route::get('users/getAddEducationItemPartial/{index}', 'PartialsController@getAddEducationItem')
    ->name('users/getAddEducationItemPartial')
    ->middleware('auth', 'level:3');

Route::get('users/getAddExperienceItemPartial/{index}', 'PartialsController@getAddExperienceItem')
    ->name('users/getExperienceItemPartial')
    ->middleware('auth', 'level:3');

Route::get('users/getAddProjectItemPartial/{index}', 'PartialsController@getAddProjectItem')
    ->name('users/getAddProjectItemPartial')
    ->middleware('auth', 'level:3');

Route::get('users/getAddLabelItemPartial/{index}/{labelIndex}', 'PartialsController@getAddLabelItem')
    ->name('users/getAddLabelItemPartial')
    ->middleware('auth', 'level:3');

Route::post('users/picture/upload', 'UserController@upload')
    ->name('users/picture/upload')
    ->middleware('auth', 'level:3');

Route::get('users/pdf/{id}', 'UserController@pdf')
    ->name('users/pdf')
    ->middleware('auth', 'level:2');

Route::get('jira', 'JiraController@get')
    ->name('jira')
    ->middleware('auth', 'level:2');
