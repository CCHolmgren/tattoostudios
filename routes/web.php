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
});

Auth::routes();

Route::name('home')->get('/home', 'HomeController@index');

Route::prefix('s')->group(function() {
    Route::name('studio.store')->post('/', 'StudioController@store');
    Route::name('studio.create')->get('new', 'StudioController@create');
    Route::name('studio.show')->get('{studio}', 'StudioController@show');
    Route::name('studio.edit')->get('{studio}/edit', 'StudioController@edit');
    Route::name('studio.update')->post('{studio}', 'StudioController@update');
    Route::name('studio.artists.associate')->post('{studio}/artists', 'StudioController@associateWithArtist');
    Route::name('studio.artists.detach')->post('{studio}/artists/remove', 'StudioController@removeAssociationWithArtist');
});

Route::prefix('a')->group(function() {
    Route::name('artist.store')->post('/', 'ArtistController@store');
    Route::name('artist.create')->get('new', 'ArtistController@create');
    Route::name('artist.show')->get('{artist}', 'ArtistController@show');
    Route::name('artist.edit')->get('{artist}/edit', 'ArtistController@edit');
    Route::name('artist.update')->post('{artist}', 'ArtistController@update');
    Route::name('artist.studios.associate')->post('{artist}/studios', 'ArtistController@associateWithStudio');
    Route::name('artist.studios.detach')->post('{artist}/studios/remove', 'ArtistController@removeAssociationWithStudio');
});

Route::prefix('l')->group(function() {
    Route::name('artist.links.store')->post('a/{artist}', 'LinkController@storeForArtist');
    Route::name('studio.links.store')->post('s/{studio}', 'LinkController@storeForStudio');
});