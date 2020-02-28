@extends('layouts.app', ['title' => 'Change password'])

@section('content')
    @include('includes.message-block')


    <div class="row justify-content-center">
        <h1>Change password</h1>
    </div>
    <form action="{{route('users.change-password')}}" method="post">
        <div class="container-fluid d-inline-flex justify-content-center">
            <div class="col-md-6 pt-4">
                <div class="panel-body">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="current-password">Current password:</label>
                        <input type="password" name="current-password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New password:</label>
                        <input type="password" name="new-password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="confirm-new-password">Confirm new password:</label>
                        <input type="password" name="confirm-new-password" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success btn-block text-uppercase" type="submit">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
