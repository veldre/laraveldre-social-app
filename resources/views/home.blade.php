@extends('layouts.app', ['title' => 'My wall'])

@section('content')
    @include('includes.message-block')
    <div class="row justify-content-center">
        <h1>My wall</h1>
    </div>

    <div class="container-fluid d-inline-flex">
        <div class="col-md-2 pt-4">

            @include('includes.change-profile-picture')

            <form action={{route('friends.unconfirmedFriends')}} method="get">
                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-sm profile-image-button font-weight-bold">Incoming
                        friend requests ({{auth()->user()->getFriendRequestsCount()}})
                    </button>
                </div>
            </form>
            <a href="{{route('users.friends',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
               class="btn btn-success btn-sm btn-block">My friends
                ({{ auth()->user()->getFriendsCount(auth()->user())}})
            </a>
            <a href="{{route('users.followers',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
               class="btn btn-success btn-sm btn-block">My followers
                ({{ auth()->user()->getFollowersCount(auth()->user())}})</a>
            <a href="{{route('users.followings',[ auth()->user()->id, auth()->user()->name, auth()->user()->surname])}}"
               class="btn btn-success btn-sm btn-block">Following
                ({{ auth()->user()->getFollowingsCount(auth()->user())}})</a>
            <a href="{{route('users.posts', [auth()->user()->id,auth()->user()->name,auth()->user()->surname])}}"
               class="btn btn-success btn-sm btn-block">My posts ({{ auth()->user()->posts->count('post')}})</a>
            <a href="/posts" class="btn btn-success btn-sm btn-block">Show all posts</a>
            <a href="/users" class="btn btn-success btn-sm btn-block">Show all users</a>
            <a href="/posts/create-post" class="btn btn-info btn-md btn-block font-weight-bold">Create post</a>

        </div>
        <div class="container border-dark">
            <div class="row justify-content-center">
                <div class="col-md-12 pt-4">
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
                            <tr class="row text-center justify-content-left">
                                <td class="col-md-2"><a
                                        href={{route('users.show',[$post->user_id,$post->user->name,$post->user->surname])}}>
                                        {{$post->user->name}} {{$post->user->surname}}

                                        <img class="small-profile-image"
                                             src="{{$post->user->checkUserPicture($post->user)}}"></a>
                                </td>
                                <td class="col-md-3 text-left">
                                    {{$post->title}}
                                </td>

                                <td class="col-md-5 text text-left">
                                    <p>{{Str::limit($post->text, $limit = 200, $end = '...')}}
                                        <a href="{{route('posts.show',[$post->id,$post->title])}}"
                                           class="stretched-link">read more</a></p>
                                </td>
                                <td class="col-md-2 text-center">{{$post->updated_at}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 text-center">
                            {{$posts->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>






@endsection
