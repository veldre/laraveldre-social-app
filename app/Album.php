<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Album extends Model
{
    protected $fillable = ['cover_image', 'name', 'description'];


    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAlbumCover(Album $album)
    {
        return Storage::url('album_covers/' . $album->cover_image);
    }
}
