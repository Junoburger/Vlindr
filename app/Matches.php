<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{



 protected $fillable = ['liker_id', 'liked_id', 'match_status',];
}
