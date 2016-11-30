<?php

namespace App\Http\Controllers;

use App\Utils\ObjectUtil;
use Illuminate\Http\Request;

use DateTime;

use App\Models\User;
use App\Logic\HealthLogic;

class HomeController extends Controller
{
    protected $healthLogic;

    public function __construct(HealthLogic $healthLogic)
    {
        $this->healthLogic = $healthLogic;
    }

    // Page
    public function today_page(Request $request)
    {
        $user = session('user');
        $date=new DateTime();
        $result = $date->format('Y-m-d');
        $steps = $user->steps()->where('date',$result)->first();
        $sleep = $user->sleep()->where('date',$result)->first();
        $sleep_hour = (int)(($sleep->sleep_minutes) / 60);
        $users_data = $this->healthLogic->friends_data($user->username,$result,10);
        $rank = $this->healthLogic->user_step_rank($user->username,$steps->steps,$result);
        return view('pages.today')
            ->with([
                'steps'=>$steps->steps,
                'sleep_hour'=>$sleep_hour,
                'rank'=>1,
                'user_ranks'=>$users_data
            ])
            ->with(['page_name'=>'今日', 'tab_index'=>0, 'sub_tab_index'=>0]);
    }

    public function stat_page(Request $request) {

        return view('pages.stat')
            ->with(['page_name'=>'运动统计', 'tab_index'=>0, 'sub_tab_index'=>1]);
    }

    // Ajax
}
