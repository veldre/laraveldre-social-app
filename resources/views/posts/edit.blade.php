@extends('layouts/app',['title' => 'Edit post'])


@section('content')

    <div class="container justify-content-center text-center">

        <h1>Edit your post</h1>
        @include('includes.message-block')
        <form action={{action('PostsController@update', [$post->id])}} method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="post-title">Title:</label>
                <input type="text" class="form-control" name="post-title" id="post-title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="post-text">Your post:</label>
                <textarea class="form-control" name="post-text" id="editor" rows="5">{{$post->text}}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Update post</button>
        </form>
    </div>

@endsection
