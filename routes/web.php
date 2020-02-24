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


Auth::routes(['verify' => true]);

Route::post('users/{id}', 'FriendsController@friendsCount');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::patch('','UsersController@addProfileImage')->name('users.addProfileImage');  // pievieno profila bildi
Route::get('users', 'UsersController@index')->name('users.index');  // visi juzeri
Route::get('users/{id}-{name}-{surname}', 'UsersController@show')->name('users.show'); // konkrets juzeris
Route::get('users/{id}-{name}-{surname}/posts', 'UsersController@showPosts')->name('users.posts');  // visi viena juzera posti
Route::get('users/{id}-{name}-{surname}/friends', 'UsersController@showFriends')->name('users.friends');  //visi juzera draugi
Route::get('users/{id}-{name}-{surname}/followers', 'UsersController@showFollowers')->name('users.followers');  //visi juzera sekotaji
Route::get('users/{id}-{name}-{surname}/followings', 'UsersController@showFollowings')->name('users.followings');  //visim kuriem juzeris seko


Route::post('users/add-friend/{id}','FriendsController@sendFriendRequest')->name('friends.sendFriendRequest');  // pievieno draugu
Route::post('add-friend/{id}','FriendsController@checkIfFriends')->name('friends.checkIfFriends');

Route::post('accept-friend/{id}','FriendsController@acceptFriend')->name('friends.acceptFriend');
Route::post('unaccept-friend/{id}','FriendsController@unacceptFriend')->name('friends.unacceptFriend');
Route::get('friends/unconfirmed-friends','FriendsController@unconfirmedFriends')->name('friends.unconfirmedFriends');
Route::get('friends/my-friends','FriendsController@index')->name('friends.my-friends');

Route::post('users/{id}-{name}-{surname}/follow', 'UsersController@followUser')->name('users.follow');
Route::post('users/{id}/unfollow', 'UsersController@unFollowUser')->name('users.unfollow');


Route::get('posts', 'PostsController@index')->name('posts.index');  // visi posti
Route::get('posts/create-post', 'PostsController@createPost')->name('posts.create-post'); // jauna posta izveides lapa
Route::post('posts/create-post', 'PostsController@storePost'); //jauna posta ievietosana DB
Route::get('posts/{id}-{title}', 'PostsController@show')->name('posts.show');  //kokrets posts
Route::get('posts/edit/{id}-{title}', 'PostsController@edit')->name('posts.edit-post');
Route::put('posts/{id}/update', 'PostsController@update')->name('posts.update-post');
Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');  // konkrēta posta dzēšana


//Route::resource('users', 'UsersController');
//Route::resource('posts', 'PostsController');








