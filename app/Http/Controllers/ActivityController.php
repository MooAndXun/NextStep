<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use App\Models\Activity;

class ActivityController extends Controller
{
    // Page
    public function activity_page(Request $request, $isMine) {
        if($isMine=='my') {
            $username = session("username");
        } else {
            $username = null;
        }

        if(!$username) {
            $activities = Activity::where("creator_username", $username);
        } else {
            $activities = Activity::all()->sortByDesc("start");
        }

        foreach ($activities as $activity) {
            $activity['people_now'] = Activity::find($activity['id'])->participators()->count();
            $start = strtotime($activity['start']);
            $end = strtotime($activity['end']);
            $activity['left-time'] = ($end-$start)/3600;

            switch ($activity['type']) {
                case 1:
                    $activity['type'] = '多人竞赛';
                    break;
                case 2:
                    $activity['type'] = '目标竞赛';
                    break;
            }
        }

        return view('pages.activity')->with("activities", $activities);
    }


    // Ajax
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
