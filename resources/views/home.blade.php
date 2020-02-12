@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
{{--            <h1>Hello, {{ $user->name }}</h1>--}}
            <div class="col-md-4">
                <img src="/images/yourAd.png" style="height: 150px">
            </div>
        </div>
        <br>
        <a href="/users" class="btn btn-success btn-lg btn-block">Show all users</a>
        <a href="/posts" class="btn btn-success btn-lg btn-block">Show all posts</a>
    </div>




@endsection
