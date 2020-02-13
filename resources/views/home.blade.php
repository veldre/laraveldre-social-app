@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Hello, {{ (auth()->user()->name) }}!</h1>
        </div>
        <div class="col-md-4">
            <img class="user-image" src="/images/yourAd.png">
            <br>
            <a href="/users" class="btn btn-success btn-lg btn-block">Show all users</a>
            <a href="/posts" class="btn btn-success btn-lg btn-block">Show all posts</a>
            <a href="/posts/create-post" class="btn btn-info btn-lg btn-block">Create post</a>
        </div>
    </div>



@endsection
