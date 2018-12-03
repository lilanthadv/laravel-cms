<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post(){
        return $this->hasOne('App\Post', 'user_id', 'id');
    }

    public function posts(){
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function roles(){
        return $this->belongsToMany('App\Role')->withPivot('created_at');
    }

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }
}
