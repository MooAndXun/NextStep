<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 11:08
 */

namespace App\Http\Controllers;


class FollowController
{
    // Page
    public function friends_page($username){
        $date=new DateTime();
        $today = $date->format('Y-m-d');
        $friend_data = $this->healthDAO->friends_data($username,$today);
        return view('pages.friend').with([
                'friends' => $friend_data
            ]);
    }


    // Ajax
    public function followUser(Request $request){
        $this->validate($request, [
            'username' => 'required'
        ]);
        $response = null;
        $name = $request->session()->get('username');
        if($name){
            $user = User::find($request->get('username'));
            $own = User::find($name);
            if($user){
//                $follow = new Follow();
//                $follow->follower_username = $name;
//                $follow->following_username = $user->username;
//                $follow->save();
                $own->followings()->save($user);
                $response = array(
                    'status' => 'success',
                    'msg' => '关注成功'
                );
            }else{
                $response = array(
                    'status' => 'failed',
                    'msg' => '该用户不存在'
                );
            }

        }else{
            $response = array(
                'status' => 'failed',
                'msg' => '用户未登录'
            );
        }
        return response()->json($response);
    }
}