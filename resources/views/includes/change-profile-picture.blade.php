<img class="profile-image" src="{{auth()->user()->checkUserPicture(auth()->user())}}" alt="profile image">

<form action="{{action('UsersController@addProfileImage')}}" method="post"
      enctype="multipart/form-data">
    {{csrf_field()}}
    @method('PATCH')
    <div class="form-group">
        <label for="image" class="text-muted">Profile image</label>
        <input type="file" name="image" class="mb-3 text-muted">

        <button type="submit" class="btn btn-info btn-sm profile-image-button ">Change profile image
        </button>
    </div>
</form>
