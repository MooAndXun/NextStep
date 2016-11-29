<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;
    protected  $table = 'activity';
    public function participators(){
        return $this->belongsToMany('App\Models\user', 'activity_participator', 'activity_id', 'participator_username');
    }
}
