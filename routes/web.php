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

Auth::routes(['verify' => true]);


//
//Route::get('/', function () {
//    return view('index');
//});
//
//Route::get('/about', function () {
//    return view('about');
//});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('users', 'UsersController@index')->name('users.index');  // visi juzeri
Route::get('users/{id}-{name}-{surname}', 'UsersController@show')->name('users.show'); // konkrets juzeris
Route::get('users/{id}-{name}-{surname}/posts', 'UsersController@showPosts')->name('users.posts');  // visi viena juzera posti

Route::get('posts', 'PostsController@index')->name('posts.index');  // visi posti
Route::get('posts/create-post', 'PostsController@createPost')->name('posts.create-post'); // jauna posta izveides lapa
Route::post('posts/create-post', 'PostsController@storePost'); //jauna posta ievietosana DB
Route::get('posts/{id}-{title}', 'PostsController@show')->name('posts.show');  //kokrets posts
Route::post('posts/{id}-{title}', 'PostsController@edit')->name('posts.edit-post');
Route::put('posts/{id}/update', 'PostsController@update')->name('posts.update-post');
Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');  // konkrēta posta dzēšana


//Route::resource('users', 'UsersController');
//Route::resource('posts', 'PostsController');








