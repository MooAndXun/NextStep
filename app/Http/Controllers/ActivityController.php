<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function create(Request $request){
        try{
            $this->validate($request, [
                'name' => 'required',
                'start' => 'required',
                'end' => 'required',
                'people_num' => 'required|numeric',
                'type' => 'required',
                'reward' => 'required',
                'description' => 'required'
            ]);
        }catch (Exception $exception){
            //TODO
        }
        $username = $request->session()->get('username');
        $response = null;
        if($username){
            $activity = new Activity();
            $activity->name = $request->get('name');
            $activity->start = $request->get('start');
            $activity->end = $request->get('end');
            $activity->people_num = $request->get('people_num');
            $activity->type = $request->get('type');
            $activity->reward = $request->get('reward');
            $activity->description = $request->get('description');
            $activity->save();
            $response = array(
                'status' => 'success',
                'msg' => '创建成功'
            );
        }else{
            $response = array(
                'status' => 'failed',
                'msg' => '用户未登录'
            );
        }
        return response()->json($response);
    }
}
