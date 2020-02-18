@extends('layouts.app', ['title' => 'My posts'])

@section('content')
    <div class="container justify-content-center text-center">
        <h1>All posts by {{$user->name}} {{$user->surname}}</h1>
    </div>
    @include('includes.message-block')
    <div class="container">
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center justify-content-center">
                @if (auth()->user()->id == $user->id)
                    <th class="header col-md-3">Title</th>
                    <th class="header col-md-5">Text</th>
                    <th class="header col-md-2">Posted</th>
                    <th class="header col-md-2">Actions</th>
                @else
                    <th class="header col-md-4">Title</th>
                    <th class="header col-md-6">Text</th>
                    <th class="header col-md-2">Posted</th>

            @endif
            </thead>
            <tbody>
            @foreach($userPosts as $post)
                <tr class="row text-center justify-content-center">
                    @if (auth()->user()->id == $user->id)
                        <td class="col-md-3 text-left"><a
                                href={{route('posts.show',[$post->id,$post->title])}}>{{$post->title}}</a>
                        </td>
                        <td class="col-md-5 text-left">{{$post->text}}</td>
                        <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->created_at)) }}</td>
                        <th class="col-md-2 action-buttons">
                            <form action={{route('posts.edit-post',[$post->id,$post->title])}} method="get">
                                <input class="btn-dark btn-sm" type="submit" value="Edit">
                            </form>
                            <form action={{route('posts.destroy',$post->id)}} method="post">
                                @method('DELETE')
                                <input class="btn-dark btn-sm" onclick="return confirm('Are you sure?')" id="menu"
                                       type="submit" value="Delete">
                            </form>
                        </th>
                    @else
                        <td class="col-md-4 text-left"><a
                                href={{route('posts.show',[$post->id,$post->title])}}>{{$post->title}}</a>
                        </td>
                        <td class="col-md-6 text-left">{{$post->text}}</td>
                        <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->created_at)) }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--        <div class="row">--}}
        {{--            <div class="col-12 text-center">--}}
        {{--                {{$userPosts->links()}}--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>

@endsection


