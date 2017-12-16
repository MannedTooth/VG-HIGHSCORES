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

//Games
Route::get('/games', 'GamesController@browse');
Route::get('/games/{nickname}/records', 'GamesController@show');
Route::get('/games/create', 'GamesController@create');
Route::post('/games/create', 'GamesController@store');
Route::get('/games/edit/{nickname}', 'GamesController@edit');
Route::put('/games/edit/{nickname}', 'GamesController@update');
Route::delete('/games/{game}', 'GamesController@delete');

//Genres
Route::get('/genres', 'GenresController@browse');
Route::get('/genres/create', 'GenresController@create');
Route::post('/genres/create', 'GenresController@store');
Route::get('/genres/edit/{genre}', 'GenresController@edit');
Route::put('/genres/edit/{genre}', 'GenresController@update');
Route::delete('/genres/{genre}', 'GenresController@delete');
