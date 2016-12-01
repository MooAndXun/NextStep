<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 10:33
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PermissionController
{
    public function permission_manage_page(Request $request) {
        return view('pages.permission')
            ->with(['page_name'=>'权限管理', 'tab_index'=>3, 'sub_tab_index'=>0]);
    }
}