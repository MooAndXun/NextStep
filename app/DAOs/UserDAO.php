<?php
namespace App\DAOs;
use App\Models\User;
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/11/27
 * Time: 14:29
 */
class UserDAO
{
    public function getByName($name){
        try{
            $user = User::where('username', $name)->first();
            return $user;
        }catch (Exception $e){
            return null;
        }
    }

}