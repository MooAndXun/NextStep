<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 9:25
 */

namespace App\Utils;


class TimeUtil
{
    public static function rand_date($start_time, $end_time)
    {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        return date('Y-m-d', mt_rand($start_time, $end_time));
    }
}