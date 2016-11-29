<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;

use App\Models\User;
use App\DAOs\HealthDAO;

class HomeController extends Controller
{
    protected $healthDAO;

    public function __construct(HealthDAO $healthDAO)
    {
        $this->healthDAO = $healthDAO;
    }

    public function mine(Request $request)
    {
//        $user = User::find($request->session()->get('username'));
        $user = User::find('test');
        $date=new DateTime();
        $result = $date->format('Y-m-d');
        $steps = $user->steps()->where('date',$result)->first();
        $sleep = $user->sleep()->where('date',$result)->first();
        $sleep_hour = ($sleep->sleep_minutes)/60;
        $users_data = $this->healthDAO->today_step_rank($user->username,$date);
        $rank = $this->healthDAO->user_step_rank($user->username,$steps->steps,$date);
        foreach($users_data as $data){
            //TODO
        }
//        print_r ($users_data);
        return view('pages.mine')->with([
            'steps'=>$steps->steps,
            'sleep_hour'=>$sleep_hour,
            'rank'=>1,
            'user_ranks'=>$users_data
        ]);
    }
}
