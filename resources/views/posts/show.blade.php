@extends('layouts/app', ['title' => $post->title])


@section('content')
    <div class="container justify-content-center text-center">
        <h5>Posted by: {{$post->user->name}} {{$post->user->surname}}
            on {{  strftime("%d %b %Y %H:%M",strtotime($post->created_at)) }}</h5>
        <h1>{{ $post->title }}</h1>
        <h4 class="text-left">{!! $post->text !!} </h4>
    </div>

@endsection
