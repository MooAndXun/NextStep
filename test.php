<?php
/**
 * Created by PhpStorm.
 * User: 小春
 * Date: 2016/11/20
 * Time: 21:39
 */
use App\User;
$user = User::find('ddd');

echo $user->password;