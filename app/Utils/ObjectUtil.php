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
    private static $obj = null;           //声明一个私有的，静态的成员属性$obj

    private function __construct(){}

    public static function getInstance()
    {  // 通过此静态方法才能获取本类的对象
        if (is_null(self::$obj))  //如果本类中的$obj为空,说明还没有被实例化过
            self::$obj = new self();  //实例化本类对象
        return self::$obj;  //返回本类的对象
    }

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