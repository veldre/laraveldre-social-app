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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
//
//Route::get('/', function () {
//    return view('index');
//});
//
//Route::get('/about', function () {
//    return view('about');
//});

//Route::get('/{slug}', 'UsersController@show');
//Route::get('/{user}', 'UsersController@show');


Route::get('users', 'UsersController@index')->name('users.index');  // visi juzeri
Route::get('users/{user}/show', 'UsersController@show')->name('users.show'); // konkrets juzeris
Route::get('users/{id}/user-posts', 'UsersController@showPosts')->name('users.user-posts');  // visi viena juzera posti

Route::get('posts/create-post', 'PostsController@createPost')->name('posts.create-post'); // jauna posta izveides lapa
Route::post('posts/create-post', 'PostsController@storePost'); //jauna posta ievietosana DB
Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');  // konkrēta posta dzēšana
Route::get('posts', 'PostsController@index')->name('posts.index');  // visi posti
Route::get('posts/{id}/show', 'PostsController@show')->name('posts.show');  //kokrets posts





