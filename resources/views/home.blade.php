@extends('layouts.app', ['title' => 'My account'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Hello, {{ auth()->user()->name }}!</h1>
        </div>
        @include('includes.message-block')
        <div class="col-md-3 pt-4">

            @if(auth()->user()->image)
                <img class="profile-image" src="{{asset('storage/'. auth()->user()->image)}}" alt="profile image">
            @else
                <img class="profile-image" src="/images/yourAd.png" alt="profile image">
            @endif

            <form action="{{action('UsersController@addProfileImage')}}" method="post"
                  enctype="multipart/form-data">
                @method('PATCH')
                <div class="form-group">
                    <label for="image" class="text-muted">Profile image</label>
                    <input type="file" name="image" class="mb-3 text-muted">

                    <button type="submit" class="btn btn-info btn-sm profile-image-button ">Change profile image
                    </button>
                </div>
            </form>

            <form action={{route('friends.unconfirmedFriends')}} method="get">
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-sm profile-image-button font-weight-bold">Incoming
                        friend requests
                    </button>
                </div>
            </form>
            <a href="/friends/my-friends" class="btn btn-success btn-sm btn-block">My friends
                ({{ App\Http\Controllers\FriendsController::friendsCount(auth()->user()->id)}})</a>
            <a href="{{route('users.posts', [auth()->user()->id,auth()->user()->name,auth()->user()->surname])}}"
               class="btn btn-success btn-sm btn-block">Show all
                my posts</a>
            <a href="/posts" class="btn btn-success btn-sm btn-block">Show all posts</a>
            <a href="/users" class="btn btn-success btn-sm btn-block">Show all users</a>
            <a href="/posts/create-post" class="btn btn-info btn-md btn-block font-weight-bold">Create post</a>

        </div>
    </div>



@endsection
