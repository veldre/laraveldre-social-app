@extends('layouts/app', ['title' => $user->name . ' ' . $user->surname])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{$user->name}} {{$user->surname}}</h1>
        </div>
        @include('includes.message-block')
        <div class="col-md-3 pt-4">
            @if($user->image)
                <img class="profile-image" src="{{asset('storage/'. auth()->user()->image)}}"
                     alt="profile image">
            @else
                <img class="profile-image" src="/images/yourAd.png" alt="profile image">
            @endif
            @if ($user != auth()->user())
                <form action="{{route('users.addFriend',['id' => $user->id])}}" method="post">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-sm profile-image-button ">Send friend request
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <ul class="col-md-3 pt-2">
            <div class="user-data">
                <label for="name">Name:</label>
                <li id="name">{{ $user->name }}</li>
            </div>
            <div class="user-data">
                <label for="surname">Surname:</label>
                <li id="name">{{ $user->surname }}</li>
            </div>
            <div class="user-data">
                <label for="email">Email:</label>
                <li id="email">{{ $user->email }}</li>
            </div>
            <div class="user-data">
                <label for="registered-at">Registered:</label>
                <li id="registered-at">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</li>
            </div>
            <div class="user-data">
                <label for="posts-count">Posts count:</label>
                <li id="posts-count">{{  $user->posts->count() }}</li>
            </div>
            <a href="{{route('users.posts',[$user,$user->name,$user->surname])}}"
               class="btn btn-success btn-md btn-block">Show
                all posts by {{$user->name}}</a>
        </ul>
    </div>

@endsection
