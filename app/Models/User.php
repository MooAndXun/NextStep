<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected  $table = 'user';
    protected $primaryKey = 'username';
//    protected $fillable = ['username','password','avatar','nick_name','gender',
//                            'birthday','height','weight','description','followings',
//                            'followers','step_goal','weight_goal','permission'];
}
