<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 20:09
 */

namespace App\Http\Controllers;


use App\Models\Circle;

class CircleController
{
    // Page
    public function circle_page() {
        $circles = Circle::all()->sortByDesc('created_at')->take(10);

        return view('pages.circle')->with([
            'circles'=>$circles
        ]);
    }
}