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
        $username = session("user")['username'];
//        $username = "Mike";
        if($isMine) {
            $page_name = '我的活动';
            $sub_tab_index = 1;
            $activities = Activity::where("creator_username", $username)->get();
        } else {
//            $username = null;
            $page_name = '所有活动';
            $sub_tab_index = 0;
            $activities = Activity::all()->sortByDesc("start");
        }

        foreach ($activities as $activity) {
            $activity = $this->activityLogic->dealWithActivity($activity);
            $activity['is_join'] = $this->activityLogic->checkIsJoin($username,$activity['id']);
        }

        return view('pages.activity')
            ->with("activities", $activities)
            ->with(['page_name'=>$page_name, 'tab_index'=>1, 'sub_tab_index'=>$sub_tab_index]);
    }

    public function activity_detail_page(Request $request, $id) {
        $activity = $this->activityLogic->findSimpleActivity($id);
        $participators = $this->activityLogic->findParticipatorRank($activity);

        return view('pages.activity-detail')->with([
            "activity"=>$activity,
            "participators"=>$participators
        ])->with(['page_name'=>'活动详情', 'tab_index'=>1, 'sub_tab_index'=>-1]);
    }

    public function activity_edit_page($id=-1) {
        if($id!=-1) {
            $activity = Activity::find($id);
            $page_name = '编辑活动';
            $is_create = 0;
        } else {
            $page_name = '创建活动';
            $activity = new Activity();
            $is_create = 1;
        }
        return view('pages.activity-edit')
            ->with(['activity'=>$activity, 'is_create'=>$is_create])
            ->with(['page_name'=>$page_name, 'tab_index'=>1, 'sub_tab_index'=>-1]);
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

        $this->activityLogic->join($username, $activity['id']);

        return redirect('/activity/'.$activity['id']);
    }

    //Ajax
    public function delete(Request $request, $id){
        $username = session("user")["username"];
        $activity_id = $id;
        $activity = Activity::find($activity_id);
        if($activity && ($activity['creator_username'] == $username)){
            $activity->delete();
            return redirect('/activity');
        }else{
            return redirect('/activity');
        }
    }

    //Ajax
    public function update(Request $request, $id){
        $username = session("user")['username'];
        $activity = Activity::find($id);
        if($activity && ($activity['creator_username'] == $username)) {
            $activity->name = ($request->get('name') =='') ? $activity->name:$request->get('name');
            $activity->start = ($request->get('start') =='') ? $activity->start:$request->get('start');
            $activity->end = ($request->get('end') =='') ? $activity->end:$request->get('end');
            $activity->people_num = ($request->get('people_num') =='') ? $activity->people_num:$request->get('people_num');
            $activity->type = ($request->get('type') =='') ? $activity->type:$request->get('type');
            $activity->reward = ($request->get('reward') =='') ? $activity->reward:$request->get('reward');
            $activity->description = ($request->get('description') =='') ? $activity->description:$request->get('description');
            $activity->save();
            return redirect('/activity/'.$id);
        }else{
            return redirect('/activity/'.$id);
        }
    }

    public function join(Request $request, $id, $username) {
        $this->activityLogic->join($username,$id);
        return redirect('/activity');
    }
}
