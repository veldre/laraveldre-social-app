<?php


use App\User;

function getAllPostsByUser($id)
{
    return User::find($id)->posts;
}
