@extends('layouts/app', ['title' => $user->name . ' ' . $user->surname])


@section('content')
    <div class="container justify-content-center text-center">
        <h1>Info on {{$user->name}} {{$user->surname}}</h1>
    </div>

    <div class="info-on-user">
        <ul>
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

        </ul>
    </div>

    <a href="{{route('users.posts',[$user,$user->name,$user->surname])}}" class="btn btn-success btn-lg btn-block">Show
        all posts by {{$user->name}}</a>


@endsection
