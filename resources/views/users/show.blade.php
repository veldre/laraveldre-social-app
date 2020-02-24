@extends('layouts/app', ['title' => $user->name . ' ' . $user->surname])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{$user->name}} {{$user->surname}}</h1>
        </div>
        @include('includes.message-block')
        <div class="col-md-3 pt-4">


{{--            {!!$picture!!}--}}
            @if($user->image)
                <img class="profile-image" src="{{asset('storage/'.$user->image)}}"
                     alt="profile image">
            @else
                <img class="profile-image" src="/images/yourAd.png" alt="profile image">
            @endif

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
                <form action="{{action('UsersController@unfriendUser', $user->id)}}" method="post">
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

        </div>
        <ul class="col-md-3 pt-2">
            <div class="user-data">
                <label for="name">Name:</label>
                <li id="name">{{ $user->name }}</li>
            </div>
            <div class="user-data">
                <label for="surname">Surname:</label>
                <li id="name">{{ $user->surname }}</li>
            </div>
            <div class="user-data">
                <label for="email">Email:</label>
                <li id="email">{{ $user->email }}</li>
            </div>
            <div class="user-data">
                <label for="registered-at">Registered:</label>
                <li id="registered-at">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</li>
            </div>
            <div class="user-data">
                <label for="posts-count">Posts:</label>
                <li id="posts-count"><a href="{{route('users.posts',[ $user->id, $user->name, $user->surname])}}">
                        {{  $user->posts->count() }}</a>
                </li>
            </div>
            <div class="user-data">
                <label for="friends-count">Friends:</label>
                <li id="friends-count"><a href="{{route('users.friends',[ $user->id, $user->name, $user->surname])}}">
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


@endsection
