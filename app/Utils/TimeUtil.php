<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 9:25
 */

namespace App\Utils;

use DateInterval;
use DateTime;


class TimeUtil
{
    public static function rand_date($start_time, $end_time)
    {
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        return date('Y-m-d', mt_rand($start_time, $end_time));
    }

    public static function date_add_day($start_time,$day_num){
        $dateTimeFormat = "Y-m-d";
        $date = DateTime::createFromFormat($dateTimeFormat, $start_time);
        $str = 'P'.$day_num.'D';
        $date->add(new DateInterval($str));
        return $date->format('Y-m-d');
    }
    /**
     * 随机生成时刻
     * @param $start_time
     * @param $end_time
     * @return date
     */
    public static function rand_time($start_time,$end_time){
        $start_time = strtotime($start_time);
        $end_time = strtotime($end_time);
        return date('Y-m-d H:i:s',mt_rand($start_time,$end_time));
    }

    /**
     * 生成当前时刻给定分钟后的时刻
     * @param $start_time
     * @param $minute
     * @return time
     */
    public static function time_add_minute($start_time,$minute){
        $dateTimeFormat = "Y-m-d H:i:s";
        $date = DateTime::createFromFormat($dateTimeFormat, $start_time);
        $str = 'PT'.$minute.'M';
        $date->add(new DateInterval($str));
        return $date->format('Y-m-d H:i:s');
    }
    public static function time_add_day($start_time,$day_num){
        $dateTimeFormat = "Y-m-d H:i:s";
        $date = DateTime::createFromFormat($dateTimeFormat, $start_time);
        $str = 'P'.$day_num.'D';
        $date->add(new DateInterval($str));
        return $date->format('Y-m-d H:i:s');
    }
}