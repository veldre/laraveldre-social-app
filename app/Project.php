<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
public function user()
{
    return $this->belongsTo(User::class );  // tas pats, kas SELECT * FROM user WHERE project_id = projekta id
}
}
