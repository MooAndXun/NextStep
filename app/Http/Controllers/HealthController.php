<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthController extends Controller
{
    public function getTodayStep(Request $request){
        $username = $request->session()->get('username');
        $today = date("Y-m-d");
        $response = null;
        if($username){
            
        }else{
            $response = array(
                'status' => 'failed',
                'msg' => '用户未登录'
            );
        }
    }
}
