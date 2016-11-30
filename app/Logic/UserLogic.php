<?php
namespace App\Logic;
use App\Models\User;
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/11/27
 * Time: 14:29
 */
class UserLogic
{
    public function getByName($name){
        try{
            $user = User::where('username', $name)->first();
            return $user;
        }catch (Exception $e){
            return null;
        }
    }

    public function getFriends($username,$date){
        $friend = DB::select('SELECT nick_name AS name,avatar as avatar_img,step.steps as steps FROM (SELECT * FROM follow WHERE follower_username = :username) follow
                                    JOIN user following ON follow.following_username = following.username
                                    JOIN step ON step.username = following.username
                                    WHERE step."date" = :date
                                  ORDER BY step.steps', [':username'=>$username,':date'=>$date]);
        return $friend;
    }

}