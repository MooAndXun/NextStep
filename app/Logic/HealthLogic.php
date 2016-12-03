<?php
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/11/29
 * Time: 21:15
 */

namespace App\Logic;

use App\Models\Step;
use App\Utils\ObjectUtil;
use DB;


class HealthLogic
{
    public function friends_data($username,$date,$num){
        $users_data = null;
        if($num){
            $users_data = DB::select('SELECT nick_name,avatar as avatar_img,description,step.steps as steps FROM (SELECT * FROM follow WHERE follower_username = :username) follow
                                    JOIN user following ON follow.following_username = following.username
                                    JOIN step ON step.username = following.username
                                    WHERE step."date" = :date
                                  ORDER BY step.steps DESC LIMIT :num', [':username'=>$username,':date'=>$date, ':num'=>$num]);
        }else{
            $users_data = DB::select('SELECT nick_name,avatar as avatar_img,description,step.steps as steps FROM (SELECT * FROM follow WHERE follower_username = :username) follow
                                    JOIN user following ON follow.following_username = following.username
                                    JOIN step ON step.username = following.username
                                    WHERE step."date" = :date
                                  ORDER BY step.steps DESC', [':username'=>$username,':date'=>$date]);
        }

        $users_data = ObjectUtil::object_to_array($users_data);
        foreach($users_data as $data){
            $data = ObjectUtil::object_to_array($data);
        }
        return $users_data;
    }

    public function user_step_rank($username,$step,$date){
        $rank = DB::select('SELECT count(*)+1 AS rank FROM (SELECT * FROM follow WHERE follower_username = :username) follow
                                    JOIN user following ON follow.following_username = following.username
                                    JOIN step ON step.username = following.username
                                    WHERE step."date" = :date AND step.steps > :step
                                  ORDER BY step.steps', [':username'=>$username,':step'=>$step,':date'=>$date]);
        return $rank;
    }

    public function findTodayStep($username) {
        $data = Step::where(['username'=>$username, 'date'=>date('Y-m-d')])->first();
        return $data;
    }
    public function getAverStep($username){
        $aver = DB::select('SELECT (sum(steps)/count(*)) AS aver FROM step WHERE username = :username',['username'=>$username]);
        return $aver->aver;
//        echo json_encode(2$aver);
//        return 40404;
    }
}