@extends('layouts/app', ['title' => $user->name . ' ' . $user->surname])


@section('content')
    @include('includes.message-block')

    <div class="row justify-content-center">
        <h1>{{$user->name}} {{$user->surname}}`s wall</h1>
    </div>

    <div class="container-fluid d-inline-flex">
        <div class="col-md-2 pt-4">

            <img class="profile-image" src="{{$user->checkUserPicture($user)}}" alt="profile image">

            @if(!auth()->user()->checkIfFriends($user))

                @if(!auth()->user()->checkFriendRequest($user))
                    <form action="{{route('friends.sendFriendRequest',$user->id)}}" method="post">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-sm profile-image-button">Send friend
                                request
                            </button>
                        </div>
                    </form>

                @else
                    <div class="form-group">
                        <button class="btn btn-info btn-sm profile-image-button" disabled="disabled">
                            Friend request sent
                        </button>
                    </div>
                @endif
            @endif
            @if(auth()->user()->checkIfFriends($user))

                <form action="{{route('friends.unfriend', [$user->id,$user->name,$user->surname])}}" method="post">
                    <div class="form-group">
                        <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-info btn-sm profile-image-button">Unfriend
                        </button>
                    </div>
                </form>
            @endif

            @if (!auth()->user()->checkIfFollowing($user))
                <form action="{{ route('users.follow', [$user->id,$user->name,$user->surname]) }}" method="post">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-sm profile-image-button">Follow
                        </button>
                    </div>
                </form>
            @else
                <form action="{{ route('users.unfollow', [$user->id,$user->name,$user->surname]) }}" method="post">
                    <div class="form-group">
                        <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-info btn-sm profile-image-button">Unfollow
                        </button>
                    </div>
                </form>
            @endif

            @include('includes.profile-info')

            <div class="user-data">
                <label for="posts-count">Posts:</label>
                <li id="posts-count"><a href="{{route('users.posts',[ $user->id, $user->name, $user->surname])}}">
                        {{  $user->posts->count() }}</a>
                </li>
            </div>
            <div class="user-data">
                <label for="friends-count">Friends:</label>
                <li id="friends-count"><a
                        href="{{route('users.friends',[ $user->id, $user->name, $user->surname])}}">
                        {{ $user->getFriendsCount($user)}}</a>
                </li>
            </div>
            <div class="user-data">
                <label for="followers-count">Followers:</label>
                <li id="followers-count"><a
                        href="{{route('users.followers',[ $user->id, $user->name, $user->surname])}}">
                        {{ $user->getFollowersCount($user)}}</a>
                </li>
            </div>
            <div class="user-data">
                <label for="followings-count">Following:</label>
                <li id="followings-count"><a
                        href="{{route('users.followings',[ $user->id, $user->name, $user->surname])}}">
                        {{ $user->getFollowingsCount($user)}}</a>
                </li>
            </div>
            </ul>
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

                                <td class="col-md-5 text-left">
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
