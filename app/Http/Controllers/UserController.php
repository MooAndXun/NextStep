<?php

namespace App\Http\Controllers;

use App\Logic\UserLogic;
use Illuminate\Http\Request;
use League\Flysystem\Exception;

use App\Models\User;
use App\Logic\HealthLogic;

class UserController extends Controller
{
    protected $healthLogic;
    protected $userLogic;

    public function __construct(HealthLogic $healthLogic, UserLogic $userLogic)
    {
        $this->healthLogic = $healthLogic;
        $this->userLogic = $userLogic;
    }

    // Page
    public function login(Request $request){
        try{
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);
        }catch (Exception $exception){
            return redirect("/login/error/format");
        }

        $name = $request->get('username');
        $password = $request->get('password');
        $response = null;
        $user = User::where('username', $name)->first();
        if($user){
            $test_password = md5($password);
            if($test_password == $user->password){
                $request->session()->put('user', $user);
//                $request->session()->put('aver_step',$this->healthLogic->getAverStep($name));
                return redirect("/home/today");
            }else{
                return redirect("/login/error/password");
            }
        }else{
            return redirect("/login/error/username");
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

    public function edit_page(Request $request) {
        return view('pages.user-edit')
            ->with(['page_name'=>'个人信息', 'tab_index'=>0, 'sub_tab_index'=>-1]);
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
    }

    public function updateUserInfo(Request $request){
        $user = session('user');
        if($user){
            $user->nick_name = $request->get('nick_name')?$request->get('nick_name'):$user->nick_name;
            $user->description = $request->get('description')?$request->get('description'):$user->description;
            $user->gender = $request->get('gender')!=null?$request->get('gender'):$user->gender;
            $user->height = $request->get('height')?$request->get('height'):$user->height;
            $user->weight = $request->get('weight')?$request->get('weight'):$user->weight;
            $user->step_goal = $request->get('step_goal')?$request->get('step_goal'):$user->step_goal;
            $user->weight_goal = $request->get('weight_goal')?$request->get('weight_goal'):$user->weight_goal;
            try{
                $user->save();
//                echo json_encode($user);
                return redirect('/user/edit');
            }catch (Exception $exception){
                return redirect('/user/edit');
            }
        }else{
            return redirect('/login');
        }
    }


}
