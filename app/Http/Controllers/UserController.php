<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use App\Models\User;
use League\Flysystem\Exception;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
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
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            $test_password = md5($password);
            if($test_password == $user->password){
                $request->session()->put('username', $name);
                $response = array(
                    'status' => 'success',
                    'msg' => '登录成功'
                );
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
                array(
                    'status' => 'failed',
                    'msg' => '数据库异常'
                );
            }
        }else{
            array(
                'status' => 'failed',
                'msg' => '用户未登录'
            );
        }

        return response()->json($response);
    }
}
