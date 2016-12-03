<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected  $table = 'user';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public function activities(){
        return $this->belongsToMany('App\Models\activity', 'activity_participator', 'participator_username', 'activity_id');
    }

    public function ownActivities(){
        return $this->hasMany('App\Models\activity', 'creator_username', 'username');
    }

    public function steps(){
        return $this->hasMany('App\Models\step', 'username', 'username');
    }

    public function sleep(){
        return $this->hasMany('App\Models\sleep', 'username', 'username');
    }

    public function followers(){
        return $this->belongsToMany($this, 'follow', 'following_username', 'follower_username');
    }

    public function followings(){
        return $this->belongsToMany($this, 'follow', 'follower_username', 'following_username');
    }
}
