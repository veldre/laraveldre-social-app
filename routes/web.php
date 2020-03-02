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



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::get('users/profile', 'ProfilesController@index')->name('users.profile');
Route::patch('users/profile/update', 'ProfilesController@update')->name('users.profile.update');
Route::get('users/change-password', 'ProfilesController@changePasswordForm')->name('users.change-password-form');
Route::patch('users/change-password', 'ProfilesController@changePassword')->name('users.change-password');

Route::patch('','UsersController@addProfileImage')->name('users.addProfileImage');
Route::get('users', 'UsersController@index')->name('users.index');  // visi juzeri
Route::get('users/{id}-{name}-{surname}', 'UsersController@show')->name('users.show');
Route::get('users/{id}-{name}-{surname}/posts', 'UsersController@showPosts')->name('users.posts');
Route::get('users/{id}-{name}-{surname}/albums', 'UsersController@showAlbums')->name('users.albums');
Route::get('users/{id}-{name}-{surname}/friends', 'UsersController@showFriends')->name('users.friends');
Route::get('users/{id}-{name}-{surname}/followers', 'UsersController@showFollowers')->name('users.followers');
Route::get('users/{id}-{name}-{surname}/followings', 'UsersController@showFollowings')->name('users.followings');
Route::post('users/{id}-{name}-{surname}/follow', 'UsersController@followUser')->name('users.follow');
Route::post('users/{id}/unfollow', 'UsersController@unFollowUser')->name('users.unfollow');
Route::delete('users/destroy', 'UsersController@destroy')->name('users.destroy');

Route::post('users/{id}-{name}-{surname}/unfriend', 'FriendsController@unfriend')->name('friends.unfriend');
Route::post('users/add-friend/{id}','FriendsController@sendFriendRequest')->name('friends.sendFriendRequest');
Route::post('accept-friend/{id}','FriendsController@acceptFriend')->name('friends.acceptFriend');
Route::post('unaccept-friend/{id}','FriendsController@unacceptFriend')->name('friends.unacceptFriend');
Route::get('friends/unconfirmed-friends','FriendsController@unconfirmedFriends')->name('friends.unconfirmedFriends');
Route::get('friends/my-friends','FriendsController@index')->name('friends.my-friends');

Route::get('posts', 'PostsController@index')->name('posts.index');
Route::get('posts/create', 'PostsController@createPost')->name('posts.create');
Route::post('posts/create', 'PostsController@storePost');
Route::get('posts/{id}-{title}', 'PostsController@show')->name('posts.show');
Route::get('posts/edit/{id}-{title}', 'PostsController@edit')->name('posts.edit');
Route::put('posts/{id}/update', 'PostsController@update')->name('posts.update');
Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');


Route::resource('albums','AlbumsController');
Route::resource('photos','PhotosController');
Route::get('photos/create/{albumId}', 'PhotosController@create')->name('photos.create');






