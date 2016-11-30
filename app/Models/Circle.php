<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    public $timestamps = false;
    protected  $table = 'circle';

    public function members(){
        return $this->belongsToMany('App\Models\user', 'circle_member', 'circle_id', 'member_username');
    }
}
