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
Route::get('/', function() {
	return view('dashboard');
});
//page awal login
Route::get('/dashboard', function() {
	return view('dashboard');
})->name('dashboard');

//sign up
Route::post('/signup', 'authcontroller@signup')->name('signup');
//login route
Route::post('/login', 'authcontroller@login')->name('login');
//logout route
Route::get('/logout', 'authcontroller@logout')->name('logout');

//forum
Route::get('/forum', 'forumcontroller@index')->name('forum');
Route::post('/forum_create', 'forumcontroller@create')->name('forum_create');
Route::get('{id}/view', 'forumcontroller@view')->name('view');
Route::post('/edit_f', 'forumcontroller@edit')->name('edit_f');
Route::get('/search_f', 'forumcontroller@search_f')->name('search_f');
Route::get('{search}/search_utility', 'forumcontroller@search_utility')->name('search_utility');
//komentar
Route::post('komentar', 'forumcontroller@komentar_create')->name('komentar');
Route::post('/edit_k', 'forumcontroller@edit_k')->name('edit_k');
Route::get('{id}/delete_k', 'forumcontroller@delete_k')->name('delete_k');


Route::group(['middleware' => ['auth','cekrole:admin']], function(){
	//penambahan data
	Route::post('store', 'TaskController@store')->name('store');
	//edit data
	Route::get('{id}/edit', 'TaskController@edit')->name('edit');
	Route::put('update', 'TaskController@update')->name('update');
	//delete data
	Route::get('{id}/delete', 'TaskController@delete')->name('delete');
});

Route::group(['middleware' => ['auth','cekrole:admin,user']], function(){
	//page awal login
	Route::get('/index', 'TaskController@index')->name('index')->middleware('auth');
});