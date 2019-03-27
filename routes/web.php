<?php


/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'AlbumsController@index');
Route::get('/albums', 'AlbumsController@index');
Route::get('/albums/create', 'AlbumsController@create');
Route::get('/albums/{id}', 'AlbumsController@show');
Route::post('/albums/store', 'AlbumsController@store');
Route::delete('/albums/{id}', 'AlbumsController@destroy');


Route::get('/photos/create/{id}', 'PhotosController@create');
Route::post('/photos/store', 'PhotosController@store');
Route::get('/photos/{id}', 'PhotosController@show');
Route::delete('/photos/{id}', 'PhotosController@destroy');
