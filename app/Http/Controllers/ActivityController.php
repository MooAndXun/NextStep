<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;

use App\Models\Activity;
use App\Logic\ActivityLogic;

class ActivityController extends Controller
{
    protected $activityLogic;
    public function __construct(ActivityLogic $activityLogic)
    {
        $this->activityLogic = $activityLogic;
    }

    // Page
    public function activity_page(Request $request) {
        $isMine = $request->get("isMine");

        if($isMine) {
            $username = session("user")['username'];
        } else {
            $username = null;
        }

        if($username) {
            $page_name = '我的活动';
            $activities = Activity::where("creator_username", $username);
        } else {
            $page_name = '所有活动';
            $activities = Activity::all()->sortByDesc("start");
        }

        foreach ($activities as $activity) {
            $activity = $this->activityLogic->dealWithActivity($activity);
        }

        return view('pages.activity')
            ->with("activities", $activities)
            ->with(['page_name'=>$page_name, 'tab_index'=>1, 'sub_tab_index'=>-1]);
    }

    public function activity_detail_page(Request $request, $id) {
        $activity = $this->activityLogic->findSimpleActivity($id);
        $participators = $this->activityLogic->findParticipatorRank($activity);

        return view('pages.activity-detail')->with([
            "activity"=>$activity,
            "participators"=>$participators
        ])->with(['page_name'=>'活动详情', 'tab_index'=>1, 'sub_tab_index'=>-1]);
    }

    // Ajax
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
            'people_num' => 'required|numeric',
            'type' => 'required',
            'reward' => 'required',
            'description' => 'required'
        ]);
        $username = session("user")['username'];
//        $username = "Mike";
        $response = null;
        $activity = new Activity();
        $activity->name = $request->get('name');
        $activity->start = $request->get('start');
        $activity->end = $request->get('end');
        $activity->people_num = $request->get('people_num');
        $activity->type = $request->get('type');
        $activity->reward = $request->get('reward');
        $activity->description = $request->get('description');
        $activity->creator_username = $username;
        $activity->save();
        $response = array(
            'status' => 'success',
            'msg' => '创建成功'
        );
        return response()->json($response);
    }

    //Ajax
    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        $username = session("user")["username"];
//        $username = "Mike";
        $activity_id = $request->get("id");
        $response = [];
        $activity = Activity::find($activity_id);
        if($activity && ($activity['creator_username'] == $username)){
            $activity->delete();
            $response['status'] = 'success';
            $response['msg'] = '删除成功';
        }else{
            $response['status'] = 'failed';
            $response['msg'] = '权限不足或该活动不存在';
        }
        return response()->json($response);
    }

    //Ajax
    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        $username = session("user")['username'];
//        $username = "Mike";
        $activity_id = $request->get("id");
        $response = [];
        $activity = Activity::find($activity_id);
        if($activity && ($activity['creator_username'] == $username)) {
            $activity->name = ($request->get('name') =='') ? $activity->name:$request->get('name');
            $activity->start = ($request->get('start') =='') ? $activity->start:$request->get('start');
            $activity->end = ($request->get('end') =='') ? $activity->end:$request->get('end');
            $activity->people_num = ($request->get('people_num') =='') ? $activity->people_num:$request->get('people_num');
            $activity->type = ($request->get('type') =='') ? $activity->type:$request->get('type');
            $activity->reward = ($request->get('reward') =='') ? $activity->reward:$request->get('reward');
            $activity->description = ($request->get('description') =='') ? $activity->description:$request->get('description');
            $activity->save();
            $response = array(
                'status' => 'success',
                'msg' => '修改成功'
            );
        }else{
                $response['status'] = 'failed';
                $response['msg'] = '权限不足或该活动不存在';
        }
        return response()->json($response);
    }

    public function join(Request $request) {
        $username = $request->get("username");
        $activity_id = $request->get("activity_id");

        $activity = Activity::find($activity_id);
        $activity->participators()->attach($username, ['created_at'=>date('Y-m-d',time())]);
    }
}
