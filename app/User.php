<?php

namespace App;
use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use App\Friendships;
use App\Traits\Matchable;
use App\Matches;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use Notifiable;

     use Friendable;

         use Matchable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dob', 'gender', 'email', 'User', 'avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

public function posts(){
    return $this->hasMany('App\Post');
}

public function profile(){

return $this->hasOne('App\Profile');

}

public function friends()
{
    return $this->hasMany('App\Friendships');
}

public function messages(){

    return $this->hasMany(Message::class);
}

}
