<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    public $timestamps = false;
    protected  $table = 'heartbeat';
}
