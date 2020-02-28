@extends('layouts.app', ['title' => 'Upload photo'])

@section('content')
    @include('includes.message-block')


    <div class="row justify-content-center">
        <h1>Upload new photo</h1>
    </div>
    <div class="container-fluid d-inline-flex justify-content-center">

        <div class="col-md-6 pt-4">
            <div class="panel-body">
                <form action="{{route('photos.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="album-id" value="{{$albumId}}">
                    <div class="form-group">
                        <label for="photo-title">Title:</label>
                        <input type="text" name="photo-title" id="photo-title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo-description">Description:</label>
                        <input type="text" name="photo-description" id="photo-title" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="col-3 p-0">
                            <label for="photo" class="text-muted">Photo</label>
                            <input type="file" name="photo" id="photo" class="mb-3 text-muted">


                        </div>

                        <button class="btn btn-success btn-block text-uppercase" type="submit">
                            Upload photo
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
