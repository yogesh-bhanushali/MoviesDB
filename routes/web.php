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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/filter/genre', 'HomeController@filterMoviesByGenre')->name('movies.filter.genre');
Route::post('/filter/sort', 'HomeController@sortMovies')->name('movies.filter.sort');
Route::post('/filter/search', 'HomeController@searchMovies')->name('movies.filter.search');

Route::get('/manage-movies', 'HomeController@manageMovies')->name('manage-movies');
Route::post('/movie/delete', 'HomeController@deleteMovie')->name('movies.delete');