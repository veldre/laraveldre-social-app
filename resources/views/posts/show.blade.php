@extends('layouts/app')


@section('content')
    <div class="container justify-content-center text-center">
        <h5>Posted by: {{$postedBy->name}} {{$postedBy->surname}}</h5>
        <h1>{{ $post->first()->title }}</h1>
        <h2>{{ $post->first()->text }} </h2>
    </div>

@endsection
