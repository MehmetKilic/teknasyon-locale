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

Route::get('/', function () {
    return view('welcome');
    //return Hash::make('010203');
});

Route::get('api', 'ApiController@test');

Route::get('api/locale', 'ApiController@getLocale');

Auth::routes();

// Admin home route
Route::any('/home', 'HomeController@index')->name('home');

// Users manage route
Route::any('/users', 'UsersController@index')->name('users');
Route::any('/users/add', 'UsersController@add')->name('users.add');
Route::any('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
Route::any('/users/delete/{id}', 'UsersController@delete')->name('users.delete');

// Projects manage route
Route::any('/projects', 'ProjectController@index')->name('projects');
Route::any('/projects/add', 'ProjectController@add')->name('projects.add');
Route::any('/projects/edit/{id}', 'ProjectController@edit')->name('projects.edit');
Route::any('/projects/delete/{id}', 'ProjectController@delete')->name('projects.delete');

// Language manage route
Route::any('/languages/{id}', 'LanguageController@index')->name('languages');
Route::any('/languages/add/{id}', 'LanguageController@add')->name('languages.add');
Route::any('/languages/edit/{id}', 'LanguageController@edit')->name('languages.edit');
Route::any('/languages/delete/{id}', 'LanguageController@delete')->name('languages.delete');
