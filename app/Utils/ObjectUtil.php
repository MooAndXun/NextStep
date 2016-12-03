<?php
namespace App\Utils;
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/11/30
 * Time: 23:46
 */
class ObjectUtil
{

    public static function object_to_array($obj)
    {
        $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
        $arr = [];
        foreach ($_arr as $key => $val) {
            $val = (is_array($val)) || is_object($val) ? ObjectUtil::object_to_array($val) : $val;
            $arr[$key] = $val;
        }
        return $arr;
    }
}