@extends('layouts.app', ['title' => 'My wall'])

@section('content')
    @include('includes.message-block')
    <div class="row justify-content-center">
        <h1>Hello, {{ auth()->user()->name }}!</h1>
    </div>

    <div class="container-fluid d-inline-flex">
        <div class="col-md-2 pt-4">

            @if(auth()->user()->image)
                <img class="profile-image" src="{{asset('storage/'. auth()->user()->image)}}" alt="profile image">
            @else
                <img class="profile-image" src="/images/yourAd.png" alt="profile image">
            @endif


            {{--                <img class="profile-image" src="{!!auth()->user()->checkUserPicture(auth()->user())!!}" alt="profile image">--}}


            <form action="{{action('UsersController@addProfileImage')}}" method="post"
                  enctype="multipart/form-data">
                @method('PATCH')
                <div class="form-group">
                    <label for="image" class="text-muted">Profile image</label>
                    <input type="file" name="image" class="mb-3 text-muted">

                    <button type="submit" class="btn btn-info btn-sm profile-image-button ">Change profile image
                    </button>
                </div>
            </form>

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
                                        {{$post->user->name}} {{$post->user->surname}}</a>
                                </td>
                                <td class="col-md-3 text-left">
                                    {{$post->title}}
                                </td>

                                <td class="col-md-5 text-left">{!!$post->text!!}
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
