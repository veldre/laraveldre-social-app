@extends('layouts.app')

@section('content')
    <div class="container justify-content-center text-center">
        <h1>All posts by {{$user->name}} {{$user->surname}}</h1>
    </div>
     <div class="container">
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center">

                <th class="header title">Title</th>
                <th class="header title">Text</th>
                <th class="header title">Posted</th>
            </tr>

            </thead>
            <tbody>
            @foreach($userPosts as $post)
                <tr class="row text-center">

                    <td class="title"><a href="/posts/{{$post->id}}/show">{{$post->title}}</a></td>
                    <td class="title">{{$post->text}}</td>
                    <td class="title">{{  strftime("%d %b %Y",strtotime($post->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
