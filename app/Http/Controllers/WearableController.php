<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\TimeUtil;

class WearableController extends Controller
{
    //模拟可穿戴设备
    public function healthData(Request $request){

        $date = $request->get('start_date');
        $date_num = $request->get('date_num');
        $result = array();
        for ($i = 0;$i<$date_num;$i++){
            $temp = array();
            $temp_date = TimeUtil::date_add_day($date,$i);
            $sleep_minutes = random_int(180,600);
            $deep_minutes = random_int(60,$sleep_minutes);
            $sleep_start = TimeUtil::rand_time($temp_date.'00.00.00',$temp_date.'04:00:00');
            $temp = [
                'date'=>$temp_date,
                'step'=>[
                    'steps'=>random_int(100,25000),
                    'minutes'=>random_int(10,360)
                ],
                'sleep'=>[
                    'sleep_minutes'=>$sleep_minutes,
                    'deep_minutes'=>$deep_minutes,
                    'start_time'=>$sleep_start,
                    'end_time'=>TimeUtil::time_add_minute($sleep_start,$sleep_minutes),
                ]
            ];
            $result[$i] = $temp;
        }
        return response()->json($result);
    }
}
