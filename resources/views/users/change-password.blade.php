@extends('layouts.app', ['title' => 'My profile'])

@section('content')
    @include('includes.message-block')


    <div class="row justify-content-center">
        <h1>Change password</h1>
    </div>
    <div class="container-fluid d-inline-flex justify-content-center">

        <div class="col-md-6 pt-4">
            <div class="panel-body">
                <form action="{{route('users.change-password')}}" method="post">
                    {{csrf_field()}}
                    @method('PATCH')

                    <div class="form-group">
                        <label for="current-password">Current password</label>
                        <input type="password" name="current-password" class="form-control">
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
