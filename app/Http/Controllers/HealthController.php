<?php

namespace App\Http\Controllers;

use App\Models\Sleep;
use App\Models\Step;
use App\Models\User;
use App\Utils\ObjectUtil;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{

    public function getTodayHealthData($username) {
        $dateStr = date('Y-m-d');
        $user = User::find($username);

        $step = Step::where([
            'username'=>$user['username'],
            'date'=>$dateStr,
        ])->first();

        $sleep = Sleep::where([
            'username'=>$user['username'],
            'date'=>$dateStr
        ])->first();

        $step['goal'] = $user['step_goal'];
        $sleep['goal'] = 9;
        $sleep['sleep_hour'] = (int)($sleep['sleep_minutes']/60);

        $result = [
            'step'=>$step,
            'sleep'=>$sleep
        ];

        return response()->json($result);
    }

    function getWeekStepStat($username) {
        $stat = DB::select("
                    SELECT SUM(steps) AS step_sum, STRFTIME('%W', date) AS week FROM step 
                    WHERE username=:username AND STRFTIME('%Y', date)='2016' 
                    GROUP BY STRFTIME('%W', date) 
                    ORDER BY STRFTIME('%W', date) DESC 
                    LIMIT 7", [':username'=>$username]);
        $stat = ObjectUtil::object_to_array($stat);
        return response()->json($stat);
    }

    function getDayStepStat($username) {
        $stat = DB::select("
                    SELECT steps, STRFTIME('%w', date) AS weekday FROM step
                    WHERE username=:username AND `date` <= date('now')
                    ORDER BY date DESC
                    LIMIT 7;", [':username'=>$username]);
        $stat = ObjectUtil::object_to_array($stat);
        return response()->json($stat);
    }

    function getMonthStepStat($username) {
        $stat = DB::select("
                    SELECT SUM(steps) AS step_sum, STRFTIME('%m', date) AS month FROM step
                    WHERE username=:username AND STRFTIME('%Y', date)='2016'
                    GROUP BY STRFTIME('%m', date)
                    ORDER BY STRFTIME('%m', date);", [':username'=>$username]);
        $stat = ObjectUtil::object_to_array($stat);
        return response()->json($stat);
    }
}
