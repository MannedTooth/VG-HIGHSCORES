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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

//Genres
Route::get('/genres', 'GenresController@index');
Route::get('/genres/create', 'GenresController@create');
Route::post('/genres/create', 'GenresController@store');
Route::get('/genres/edit/{genre}', 'GenresController@edit');
Route::put('/genres/edit/{genre}', 'GenresController@update');
Route::delete('/genres/{genre}', 'GenresController@delete');
