<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class HomeController extends Controller
{

    public function mine(Request $request)
    {
        $user = User::find($request->session()->get('username'));
        $date=new DateTime();
        $result = $date->format('Y-m-d');
        $steps = $user->steps()->where('date',$result)->first();
        $sleep = $user->sleep()->where('date',$result)->first();

        return view('pages.mine')->with([
            'steps'=>100,
            'sleep_hour'=>9,
            'rank'=>1,
            'user_ranks'=>[
                ['avatar_img'=>'/img/person-1.jpg',
                    'nick_name'=>'test',
                    'steps'=>8000],
                ['avatar_img'=>'/img/person-1.jpg',
                    'nick_name'=>'test',
                    'steps'=>8000],
                ['avatar_img'=>'/img/person-1.jpg',
                    'nick_name'=>'test',
                    'steps'=>8000]
            ]
        ]);
    }
}
