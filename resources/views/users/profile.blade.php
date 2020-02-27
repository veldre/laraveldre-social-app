@extends('layouts.app', ['title' => 'My profile'])

@section('content')
    @include('includes.message-block')


    <div class="panel panel default">
        <div class="row justify-content-center">
            <h1>Edit profile</h1>
        </div>
        <div class="container">

            <div class="panel-body">
                <form action="{{route('users.profile.update')}}" method="post">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" value="{{old('address')}}">
                    </div>
                    <div class="form-group">
                        <label for="about">About you</label>
                        <textarea name="about" id="about" cols="6" rows="6" class="form-control">{{old('about')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" name="birthday" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New password</label>
                        <input type="password" name="new-password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm-new-password">Confirm new password</label>
                        <input type="password" name="confirm-new-password" class="form-control">
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
