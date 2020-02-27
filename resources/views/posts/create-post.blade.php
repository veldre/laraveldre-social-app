@extends('layouts/app', ['title' => 'Create new post'])


@section('content')

    <div class="container justify-content-center text-center">

        <h1>Create a post</h1>
        @include('includes.message-block')
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="post-title">Title:</label>
                <input type="text" class="form-control" name="post-title" id="post-title" value="{{old('post-title')}}"
                       placeholder="please write descriptive title for your post">
            </div>

            <div class="form-group">
                <label for="post-text">Your post:</label>
                <textarea class="form-control" name="post-text" id="editor" rows="5">{{old('post-text')}}</textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Create post</button>
        </form>
    </div>

@endsection
