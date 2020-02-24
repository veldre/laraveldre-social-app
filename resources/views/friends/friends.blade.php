@extends('layouts/app', ['title' => 'My friends'])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (auth()->user()->id == $user->id)
                <h1>My friends</h1>
            @else
                <h1>{{$user->name}} {{$user->surname}} friends</h1>
            @endif
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                @if (auth()->user()->id == $user->id)
                    <th class="header col-md-4">Name</th>
                    <th class="header col-md-4">Surname</th>
                    <th class="header col-md-3">Friendship started</th>
                    <th class="header col-md-1">Unfriend</th>
            </tr>
            @else
                <th class="header col-md-4">Name</th>
                <th class="header col-md-4">Surname</th>
                <th class="header col-md-4">Friendship started</th>
            @endif
            </thead>

            <tbody>
            @foreach($friends as $friend)

                <tr class="row text-center justify-content-center">
                    @if (auth()->user()->id == $user->id)
                        <td class="col-md-4">
                            <a href={{route('users.show',[$friend->user->id,$friend->user->name,$friend->user->surname])}}>{{$friend->user->name}}</a>
                        </td>
                        <td class="col-md-4">{{$friend->user->surname}}</td>
                        <td class="col-md-3">{{ strftime("%d %b %Y",strtotime($friend->user->created_at))}}</td>
                        <td class="col-md-1 text-center d-flex p-0 justify-content-center">
                            <form onclick="return confirm('Are you sure?')"
                                  action={{action('FriendsController@unacceptFriend', [$friend->user->id])}} method="post">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-times-circle" aria-hidden="true"
                                       style="font-size:24px; color: indianred" type="submit"></i>
                                </button>
                            </form>

                        </td>
                    @else
                        <td class="col-md-4">
                            <a href={{route('users.show',[$friend->user->id,$friend->user->name,$friend->user->surname])}}>{{$friend->user->name}}</a>
                        </td>
                        <td class="col-md-4">{{$friend->user->surname}}</td>
                        <td class="col-md-4">{{ strftime("%d %b %Y",strtotime($friend->user->created_at))}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{$friends->links()}}
            </div>
        </div>
    </div>

@endsection
