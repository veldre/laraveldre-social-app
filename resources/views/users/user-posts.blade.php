@extends('layouts.app')

@section('content')
    <div class="container justify-content-center text-center">
        <h1>All posts by {{$user->name}} {{$user->surname}}</h1>
    </div>
    @include('includes.message-block')
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center justify-content-center">
                <th class="header col-md-3">Title</th>
                <th class="header col-md-5">Text</th>
                <th class="header col-md-2">Posted</th>
                <th class="header col-md-2">Actions</th>
            </thead>
            <tbody>
            @foreach($userPosts as $post)
                <tr class="row text-center justify-content-center">
                    <td class="col-md-3"><a href={{route('posts.show',$post)}}>{{$post->title}}</a></td>
                    <td class="col-md-5">{{$post->text}}</td>
                    <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->created_at)) }}</td>
                    <th class="col-md-2 action-buttons">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="">
                            <input class="btn-dark btn-sm" name="editButton" id="menu" type="submit"
                                   value="Edit">
                        </form>
                        <form action={{route('posts.destroy',$post->id)}} method="post">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input class="btn-dark btn-sm" onclick="return confirm('Are you sure?')" id="menu"
                                   type="submit" value="Delete">
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
