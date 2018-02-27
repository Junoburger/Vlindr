<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Friendships extends Model
{
    //


    protected $fillable = ['sender_id', 'recipient_id', 'status',];


}
