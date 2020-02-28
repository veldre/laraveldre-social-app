@extends('layouts.app', ['title' => 'Create album'])

@section('content')
    @include('includes.message-block')


    <div class="row justify-content-center">
        <h1>Create new album</h1>
    </div>
    <div class="container-fluid d-inline-flex justify-content-center">

        <div class="col-md-6 pt-4">
            <div class="panel-body">
                <form action="{{route('albums.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="album-name">Album name:</label>
                        <input type="text" name="album-name" id="album-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="album-description">Description:</label>
                        <input type="text" name="album-description" id="album-description" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="col-3 p-0">
                            <label for="cover-image" class="text-muted">Album cover image:</label>
                            <input type="file" name="cover-image" id="cover-image" class="mb-3 text-muted">


                        </div>

                        <button class="btn btn-success btn-block text-uppercase" type="submit">
                            Upload album
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
