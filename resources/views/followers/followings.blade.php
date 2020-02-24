@extends('layouts/app', ['title' => 'Following'])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (auth()->user()->id == $user->id)
                <h1>Following</h1>
            @else
                <h1>{{$user->name}} {{$user->surname}} following</h1>
            @endif
        </div>
        @include('includes.message-block')
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                @if (auth()->user()->id == $user->id)
                    <th class="header col-md-4">Name</th>
                    <th class="header col-md-4">Surname</th>
                    <th class="header col-md-3">Following since</th>
                    <th class="header col-md-1">Unfollow</th>
            </tr>
            @else
                <th class="header col-md-4">Name</th>
                <th class="header col-md-4">Surname</th>
                <th class="header col-md-4">Following since</th>
            @endif
            </thead>

            <tbody>
            @foreach($followings as $following)

                <tr class="row text-center justify-content-center">
                    @if (auth()->user()->id == $user->id)
                        <td class="col-md-4">
                            <a href={{route('users.show',[$following->id,$following->name,$following->surname])}}>{{$following->name}}</a>
                        </td>
                        <td class="col-md-4">{{$following->surname}}</td>
                        <td class="col-md-3">{{ strftime("%d %b %Y",strtotime($following->created_at))}}</td>
                        <td class="col-md-1 text-center d-flex p-0 justify-content-center">
                            <form onclick="return confirm('Are you sure?')"
                                  action={{action('UsersController@unFollowUser', [$following->id])}} method="post">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-times-circle" aria-hidden="true"
                                       style="font-size:24px; color: indianred" type="submit"></i>
                                </button>
                            </form>

                        </td>
                    @else
                        <td class="col-md-4">
                            <a href={{route('users.show',[$following->id,$following->name,$following->surname])}}>{{$following->name}}</a>
                        </td>
                        <td class="col-md-4">{{$following->surname}}</td>
                        <td class="col-md-4">{{ strftime("%d %b %Y",strtotime($following->created_at))}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
{{--                {{$followings->links()}}--}}
            </div>
        </div>
    </div>

@endsection
