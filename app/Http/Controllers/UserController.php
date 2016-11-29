<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

use App\Models\User;
use App\Models\Participator;
use App\DAOs\HealthDAO;

class UserController extends Controller
{
    protected $healthDAO;

    public function __construct(HealthDAO $healthDAO)
    {
        $this->healthDAO = $healthDAO;
    }
    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = new User;
        $user->nick_name = $request->get('username');
        $user->password = $request->get('password');
        return view('home')->withUser($user);
    }

    public function login(Request $request){
        try{
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        }catch (Exception $exception){
            //TODO
        }

        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            $test_password = md5($password);
            if($test_password == $user->password){
                $request->session()->put('username', $name);
//                $request->session()->put('avatar', $user->avatar);
//                return view('pages.mine')->with(['user'=>$user]);
                return redirect("/home");
            }else{
                $response = array(
                    'status' => 'failed',
                    'msg' => '密码错误'
                );
            }

        }else{
            $response = array(
                'status' => 'failed',
                'msg' => '该用户不存在'
            );
        }

        return response()->json($response);
    }

    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            $response = array(
                'status' => 'failed',
                'msg' => '用户名已经存在'
            );
        }else{
            $user = new User();
            $user->username = $name;
            $user->nick_name = $name;
            $user->password = md5($password);
            try{
                $user->saveOrFail();
                $response = array(
                    'status' => 'success',
                    'msg' => '注册成功'
                );
            }catch (Exception $exception){
                $response = array(
                    'status' => 'failed',
                    'msg' => '数据库异常'
                );
            }
        }

        return response()->json($response);
    }

    public function getUserInfo(Request $request){
        $response = null;
        $name = $request->session()->get('username');
        $user = null;
        if($name){
            $user = User::where('username',$name)->first();
            $response = array(
                'status' => 'success',
                'msg' => $user
            );
        }else{
            $response = array(
                'status' => 'failed',
                'msg' => '用户未登录'
            );
        }
        return response()->json($response);
//        return view('home')->withUser($user);
    }

    public function updateUserInfo(Request $request){
        $response = null;
        $name = $request->session()->get('username');
        if($name){
            $user = User::where('username',$name)->first();
            $user->nick_name = $request->get('nick_name')?$request->get('nick_name'):$user->nick_name;
            $user->age = $request->get('age')?$request->get('age'):$user->age;
            $user->height = $request->get('height')?$request->get('height'):$user->height;
            $user->weight = $request->get('weight')?$request->get('weight'):$user->weight;
            $user->steps_goal = $request->get('steps_goal')?$request->get('steps_goal'):$user->steps_goal;
            $user->weight_goal = $request->get('weight_goal')?$request->get('weight_goal'):$user->weight_goal;
            try{
                $user->saveOrFail();
                $response = array(
                    'status' => 'success',
                    'msg' => '修改成功'
                );
            }catch (Exception $exception){
                $response = array(
                    'status' => 'failed',
                    'msg' => '数据库异常'
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

    //get
    public function friends($username){
        $date=new DateTime();
        $today = $date->format('Y-m-d');
        $friend_data = $this->healthDAO->friends_data($username,$today);
        return view('pages.firend').with([
            'friends' => $friend_data
        ]);
    }
}
