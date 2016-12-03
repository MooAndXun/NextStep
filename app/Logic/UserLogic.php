<?php
namespace App\Logic;
use App\Models\User;
use App\Utils\ObjectUtil;
use Illuminate\Support\Facades\DB;

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
                                    WHERE step."date" = :date AND following.username<>:username
                                  ORDER BY step.steps', [':username'=>$username,':date'=>$date]);
        return $friend;
    }

    public function getAllUserWithStep($username) {
        $all_user = DB::select('
              SELECT user.username as username, nick_name, avatar as avatar_img, description, (CASE WHEN(steps ISNULL) THEN 0 ELSE steps END) AS steps FROM user
                  LEFT JOIN (SELECT username, steps  FROM step WHERE date=datetime(\'yyyy-mm-dd\')) step ON user.username = step.username
              WHERE  user.username NOT IN (
                SELECT following_username FROM follow WHERE follower_username = :username)'
            , [':username'=>$username]);
        return ObjectUtil::object_to_array($all_user);
    }

}