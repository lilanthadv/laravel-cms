<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts(){
        $this->morphedByMany('App\Post', 'taggable');
    }

    public function videos(){
        $this->morphedByMany('App\Video', 'taggable');
    }
}
