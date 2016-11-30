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

    // Page
    public function login(Request $request){
        try{
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        }catch (Exception $exception){
            redirect("/login/error/format");
        }

        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            $test_password = md5($password);
            if($test_password == $user->password){
                $request->session()->put('user', $user);
                redirect("/home");
            }else{
                redirect("/login/error/password");
            }
        }else{
            redirect("/login/error/username");
        }
    }

    public function register(Request $request){
        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        } catch (Exception $exception) {
            redirect("/register/error/format");
        }

        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            redirect("/register/error/existed");
        }else{
            $user = new User();
            $user->username = $name;
            $user->nick_name = $name;
            $user->password = md5($password);
            try{
                $user->saveOrFail();
                redirect("/login");
            }catch (Exception $exception){
                redirect("/register/error");
            }
        }

        return response()->json($response);
    }


    // Ajax
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


}
