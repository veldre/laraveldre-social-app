@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Latest posts</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center">
                <th class="header-left poster">Posted by</th>
                <th class="header title">Title</th>
                <th class="header text">Text</th>
                <th class="header time">Posted at</th>
            </tr>

            </thead>

            <tbody>
            @foreach($posts as $post)
                <tr class="row text-center">
                    <td class="poster"><a href="/users/{{$post->user_id}}/user-posts">{{$post->user_id}}</a></td>
                    <td class="title"><a href="/posts/{{$post->id}}/show">{{$post->title}}</a></td>
                    <td class="text">{{$post->text}}</td>
                    <td class="time">{{  strftime("%d %b %Y",strtotime($post->updated_at)) }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection

