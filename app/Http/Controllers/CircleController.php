<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 20:09
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;

class CircleController extends Controller
{
    // Page
    public function circle_page() {
        $circles = Circle::all()->sortByDesc('created_at')->take(10);

        return view('pages.circle')
            ->with(['circles'=>$circles])
            ->with(['page_name'=>'所有圈子', 'tab_index'=>2, 'sub_tab_index'=>0]);
    }

    public function circle_detail_page() {
        $circles = Circle::all()->sortByDesc('created_at')->take(10);

        return view('pages.circle-detail')
            ->with(['page_name'=>'圈子详情', 'tab_index'=>2, 'sub_tab_index'=>-1]);
    }

    // Ajax
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'people_num' => 'required|numeric',
            'description' => 'required'
        ]);
        $username = session("user")['username'];
//        $username = "Mike";
        $response = null;
        $circle = new Circle();
        $today = date("Y-m-d");
        $circle->name = $request->get('name');
        $circle->people_num = $request->get('people_num');
        $circle->description = $request->get('description');
        $circle->creator_username = $username;
        $circle->created_at = $today;
        $circle->save();
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
        $circle_id = $request->get("id");
        $response = [];
        $circle = Circle::find($circle_id);
        if($circle && ($circle['creator_username'] == $username)){
            $circle->delete();
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
        $circle_id = $request->get("id");
        $response = [];
        $circle = Circle::find($circle_id);
        if($circle && ($circle['creator_username'] == $username)) {
            $circle->name = ($request->get('name') =='') ? $circle->name:$request->get('name');
            $circle->people_num = ($request->get('people_num') =='') ? $circle->people_num:$request->get('people_num');
            $circle->description = ($request->get('description') =='') ? $circle->description:$request->get('description');
            $circle->save();
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
//        $username = $request->get("username");
        $username = "Amy";
        $circle_id = $request->get("circle_id");

        $circle = Circle::find($circle_id);
        $circle->members()->attach($username, ['created_at'=>date('Y-m-d',time())]);
    }
}