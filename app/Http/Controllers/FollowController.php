<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 11:08
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\HealthLogic;
use App\Utils\ObjectUtil;


class FollowController
{
    protected $healthLogic;
    public  function __construct(HealthLogic $logic){
        $this->healthLogic = $logic;
    }


    // Page
    public function friends_page(Request $request){
        $username = session()->get('user')['username'];
//        $username = 'Nick';
        $today = date("Y-m-d");
        $friend_data = $this->healthLogic->friends_data($username,$today,null);
        $friend_data = ObjectUtil::object_to_array($friend_data);
        return view('pages.friend')
            ->with('friends' , $friend_data)
            ->with(['page_name'=>'我的关注', 'tab_index'=>0, 'sub_tab_index'=>2]);
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