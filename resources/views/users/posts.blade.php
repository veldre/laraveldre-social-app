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
                    <td class="col-md-3"><a href={{route('posts.show',[$post->id,$post->title])}}>{{$post->title}}</a></td>
                    <td class="col-md-5">{{$post->text}}</td>
                    <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->created_at)) }}</td>
                    <th class="col-md-2 action-buttons">
                        <form action="" method="post">
                            {{--                            <input type="hidden" name="_method" value="PUT">--}}
                            <input type="button" class="btn-dark btn-sm" data-toggle="modal"
                                   data-target="#edit{{$post->id}}"
                                   value="Edit">
                        </form>
                        <form action={{route('posts.destroy',$post->id)}} method="post">
                                                {{method_field('DELETE')}}
                            <input class="btn-dark btn-sm" onclick="return confirm('Are you sure?')" id="menu"
                                   type="submit" value="Delete">
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="edit{{$post->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$post->title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                {{--                <form action={{action('PostsController@update')}} method="post">--}}
                {{--                    {{method_field('PUT')}}--}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection


