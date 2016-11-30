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
            $activities = Activity::where("creator_username", $username);
        } else {
            $activities = Activity::all()->sortByDesc("start");
        }

        foreach ($activities as $activity) {
            $activity = $this->activityLogic->dealWithActivity($activity);
        }

        return view('pages.activity')->with("activities", $activities);
    }

    public function activity_detail_page(Request $request, $id) {
        $activity = $this->activityLogic->findSimpleActivity($id);
        $participators = $this->activityLogic->findParticipatorRank($activity);
        echo json_encode($participators);

        return view('pages.activity-detail')->with([
            "activity"=>$activity,
            "participators"=>$participators
        ]);

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
