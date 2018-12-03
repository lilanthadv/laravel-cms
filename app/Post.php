<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected  $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'content'
    ];


    /**
     * @desc this function use to get post owner
     * @param
     *  - user_id : this user id
     *  - post_id : this is post id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *  - return post owner
     * @author Lilantha jakerocheleau@gmail.com 01-11-2018
     * @modifiedBy Lahiru lahiru@mobisec.lk 02-11-2018
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
