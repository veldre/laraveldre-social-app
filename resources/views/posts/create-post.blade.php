@extends('layouts/app')


@section('content')

    <div class="container justify-content-center text-center">

        <h1>Create a post</h1>
        @include('includes.message-block')
        <form action="" method="post">
            <div class="form-group">
                <label for="post-title">Title:</label>
                <input type="text" class="form-control" name="post-title" id="post-title" placeholder="please write descriptive title for your post">
            </div>

            <div class="form-group">
                <label for="post-text">Your post:</label>
                <textarea class="form-control" name="post-text" id="post-text" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Create post</button>
        </form>

    </div>

@endsection
