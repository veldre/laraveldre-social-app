@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Latest posts</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center justify-content-center">
                <th class="header col-md-2">Posted by</th>
                <th class="header col-md-3">Title</th>
                <th class="header col-md-5">Text</th>
                <th class="header col-md-2">Posted at</th>
            </tr>
            </thead>

            <tbody>
            @foreach($posts as $post)
                <tr class="row text-center justify-content-center">
                    <td class="col-md-2"><a
                            href="/users/{{$post->user_id}}/user-posts">{{$post->user->name}} {{$post->user->surname}}</a>
                    </td>
                    <td class="col-md-3"><a href="/posts/{{$post->id}}/show">{{$post->title}}</a></td>
                    <td class="col-md-5">{{$post->text}}</td>
                    <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->updated_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

