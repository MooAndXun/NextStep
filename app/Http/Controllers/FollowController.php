<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 11:08
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\UserLogic;
use App\Logic\HealthLogic;
use App\Utils\ObjectUtil;


class FollowController
{
    protected $healthLogic;
    protected $userLogic;

    public  function __construct(HealthLogic $logic, UserLogic $userLogic){
        $this->healthLogic = $logic;
        $this->userLogic = $userLogic;
    }


    // Page
    public function friends_page(Request $request){
        $isMine = $request->get('isMine');
        if($isMine) {
            $username = session()->get('user')['username'];
            $today = date("Y-m-d");
            $friend_data = $this->healthLogic->friends_data($username,$today,null);
            $friend_data = ObjectUtil::object_to_array($friend_data);
            return view('pages.friend')
                ->with('friends' , $friend_data)
                ->with('is_mine', $isMine)
                ->with(['page_name'=>'我的关注', 'tab_index'=>4, 'sub_tab_index'=>0]);
        } else {
            $today = date("Y-m-d");
            $username = session()->get('user')['username'];
            $all_user = $this->userLogic->getAllUserWithStep($username);
            return view('pages.friend')
                ->with('friends' , $all_user)
                ->with('is_mine', $isMine)
                ->with(['page_name'=>'我的关注', 'tab_index'=>4, 'sub_tab_index'=>1]);
        }
    }


    // Ajax
    public function followUser(Request $request, $username){
        $following = $username;
        $follower = $request->session()->get('username');
        if($follower){
            $user = User::find($following);
            $own = User::find($follower);
            if($user){
                $own->followings()->save($user);
                return redirect('/follow?isMine=true');
            }else{
                return redirect('/follow?isMine=true');
            }
        }else{
            return redirect('/follow?isMine=true');
        }
    }
}