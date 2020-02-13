@extends('layouts.app')

@section('content')
    <div class="container justify-content-center text-center">
        <h1>All posts by {{$user->name}} {{$user->surname}}</h1>
    </div>
     <div class="container">
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center justify-content-center">

                <th class="col-md-3">Title</th>
                <th class="col-md-4">Text</th>
                <th class="col-md-5">Posted</th>
            </tr>

            </thead>
            <tbody>
            @foreach($userPosts as $post)
                <tr class="row text-center">

                    <td class="col-md-3"><a href="/posts/{{$post->id}}/show">{{$post->title}}</a></td>
                    <td class="col-md-4">{{$post->text}}</td>
                    <td class="col-md-5">{{  strftime("%d %b %Y",strtotime($post->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
