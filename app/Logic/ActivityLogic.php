<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/11/30
 * Time: 12:42
 */

namespace App\Logic;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivityLogic
{
    public function findSimpleActivity($id) {
        $activity = Activity::find($id);
        $activity = $this->dealWithActivity($activity);

        return $activity;
    }

    public function findParticipatorRank($activity) {
        switch ($activity['type']) {
            CASE '多人竞赛':
                $rank = DB::select("SELECT user.username, avatar, (CASE WHEN(steps ISNULL) THEN 0 ELSE steps END) AS steps FROM activity__participator
                              JOIN user ON activity__participator.participator_username = user.username
                              JOIN (SELECT username, sum(steps) AS steps FROM step WHERE date BETWEEN strftime('%s', :start) AND strftime('%s', :end) GROUP BY username) step ON step.username = user.username
                            WHERE activity_id = :id
                            ORDER BY steps", [':id'=>$activity['id'], ":start"=>$activity['start'], ":end"=>$activity['end']]);
                break;
            Default:
                $rank = [];
        }

        return $rank;
    }

    public function dealWithActivity($activity) {
        $activity['people_now'] = Activity::find($activity['id'])->participators()->count();
        $start = strtotime($activity['start']);
        $end = strtotime($activity['end']);
        $activity['left-time'] = ($end-$start)/3600;

        switch ($activity['type']) {
            case 1:
                $activity['type'] = '多人竞赛';
                break;
            case 2:
                $activity['type'] = '目标竞赛';
                break;
        }
        return $activity;
    }
}