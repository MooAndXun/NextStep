<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected  $table = 'user';
    protected $primaryKey = 'username';
    public $incrementing = false;
//    protected $fillable = ['username','password','avatar','nick_name','gender',
//                            'birthday','height','weight','description','followings',
//                            'followers','step_goal','weight_goal','permission'];
    public function activities(){
        return $this->belongsToMany('App\Models\activity', 'activity_participator', 'participator_username', 'activity_id');
    }

    public function ownActivities(){
        return $this->hasMany('App\Models\activity', 'creator_username', 'username');
    }
}
