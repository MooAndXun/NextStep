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

    // Page
    public function today_page(Request $request)
    {
        $user = User::find('test');
        $date=new DateTime();
        $result = $date->format('Y-m-d');
        $steps = $user->steps()->where('date',$result)->first();
        $sleep = $user->sleep()->where('date',$result)->first();
        $sleep_hour = ($sleep->sleep_minutes)/60;
        $users_data = $this->healthDAO->friends_data($user->username,$result,10);
        $rank = $this->healthDAO->user_step_rank($user->username,$steps->steps,$result);
        foreach($users_data as $data){
            //TODO
        }
        return view('pages.today')->with([
            'steps'=>$steps->steps,
            'sleep_hour'=>$sleep_hour,
            'rank'=>1,
            'user_ranks'=>$users_data
        ]);
    }

    // Ajax
}
