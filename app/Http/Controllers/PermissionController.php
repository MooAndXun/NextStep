<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 10:33
 */

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class PermissionController
{
    public function permission_manage_page(Request $request) {
        $users = User::all();

        $results = [];

        foreach ($users as $user) {
            switch ($user['permission']) {
                case 0:
                    $type = '系统管理员';
                    break;
                case 1:
                    $type = '初级用户';
                    break;
                case 2:
                    $type = '高级用户';
                    break;
                default:
                    $type = '初级用户';
            }

            $result = [
                'username'=>$user['username'],
                'nickname'=>$user['nick_name'],
                'avatar'=>$user['avatar'],
                'type' =>$type
            ];
            array_push($results, $result);
        }

        return view('pages.permission')
            ->with('users', $results)
            ->with(['page_name'=>'权限管理', 'tab_index'=>3, 'sub_tab_index'=>0]);
    }

    public function update(Request $request, $id) {
        $permission = $request->get('permission');
        $user = User::find($id);
        $user->permission = $permission;
        $user->save();

        return redirect('/permission');
    }
}