<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];
//    protected $fillable = [
//        'name', 'surname', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class); // tas pats, kas SELECT * FROM posts WHERE user_id = jūzera instances id (1, ja userim id ir 1)
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public static function getUsersInOrder()
    {
        $posts = self::orderBy('created_at', 'DESC')->where('id', '>', 0)->simplePaginate(10);
        return $posts;
    }



}
