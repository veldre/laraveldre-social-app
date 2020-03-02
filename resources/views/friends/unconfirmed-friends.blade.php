@extends('layouts/app', ['title' => 'Received friendship requests'])


@section('content')
    @include('includes.message-block')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Received friendship requests</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                <th class="header col-md-4">Name</th>
                <th class="header col-md-4">Surname</th>
                <th class="header col-md-3">Date</th>
                <th class="header col-md-1">Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($unconfirmedFriends as $friend)

                <tr class="row text-center justify-content-center">
                    <td class="col-md-4">
                        <a href={{route('users.show',[$friend->id,$friend->name,$friend->surname])}}>{{$friend->name}}</a>
                    </td>
                    <td class="col-md-4">{{$friend->surname}}</td>
                    <td class="col-md-3">{{$friend->created_at}}</td>
                    <td class="col-md-1 text-center d-flex p-0 justify-content-center">
                        <form action={{action('FriendsController@acceptFriend', [$friend->id])}} method="post">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-check-circle" aria-hidden="true" style="font-size:24px"></i>
                            </button>
                        </form>
                        <form action={{action('FriendsController@unacceptFriend', [$friend->id])}} method="post">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-times-circle" aria-hidden="true"
                                   style="font-size:24px; color: indianred" type="submit"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
{{--                                {{$unconfirmedFriends->links()}}--}}
            </div>
        </div>
    </div>

@endsection
