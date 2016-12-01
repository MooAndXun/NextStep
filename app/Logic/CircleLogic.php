<?php
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/12/1
 * Time: 20:00
 */

namespace App\Logic;

use App\Models\Circle;

class CircleLogic
{
    public function checkIsJoin($username,$circle_id)
    {
        $circle = Circle::find($circle_id);
        $user = $circle->members()->where('member_username', $username)->get();
        if($user){
            return true;
        }
        return false;
    }
}