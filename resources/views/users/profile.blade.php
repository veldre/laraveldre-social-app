@extends('layouts.app', ['title' => 'My profile'])

@section('content')
    @include('includes.message-block')



    <div class="row justify-content-center">
        <h1>Edit profile</h1>
    </div>
    <div class="container-fluid d-inline-flex">
        <div class="col-md-3 pt-4 profile-info">
            @include('includes.change-profile-picture')
            @include('includes.profile-info')
            <form action="{{route('users.change-password-form')}}" method="get" class="form-group">
                <button class="btn btn-success btn-sm btn-block text-uppercase mt-3" type="submit">Change password
                </button>
            </form>
        </div>
        <div class="col-md-6 pt-4">
            <div class="panel-body">
                <form action="{{route('users.profile.update')}}" method="post">
                    {{csrf_field()}}
                    @method('PATCH')

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{auth()->user()->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="{{auth()->user()->address}}">
                    </div>
                    <div class="form-group">
                        <label for="about">About you</label>
                        <textarea name="about" id="about" cols="6" rows="6"
                                  class="form-control">{{auth()->user()->about}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" name="birthday" class="form-control" value="{{auth()->user()->birthday}}">
                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success btn-block text-uppercase" type="submit">
                                Save changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
