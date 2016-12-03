<?php
/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 19:23
 */

namespace App\Http\Middleware;


use Closure;

class VerifyMiddleware
{
    public function handle($request, Closure $next)
    {
        $input = $request->get('input');

        $isValid = true;

        foreach ($input as $i) {
            if(preg_match('( \\s|\\s)*((%27)|(\')|(%3d)|(=)|(/)|(%2f)|(\)|((%22)|(-|%2d){2})|(%23)|(%3b)|(;))+(\\s|\\s)*', $i)) {
                $isValid = false;
                break;
            } else if(preg_grep('( \\s|\\s)*((%73)|s)(\\s)*((%63)|c)(\\s)*((%72)|r)(\\s)*((%69)|i)(\\s)*((%70)|p)(\\s)*((%74)|t)(\\s|\\s)*',$i)) {
                $isValid = false;
                break;
            } else if(preg_grep('( \\s|\\s)*((%73)|s)(\\s)*((%63)|c)(\\s)*((%72)|r)(\\s)*((%69)|i)(\\s)*((%70)|p)(\\s)*((%74)|t)(\\s|\\s)*',$i)) {
                $isValid = false;
                break;
            }
        }


        if($isValid){
            return $next($request);
        }else{
            return redirect("/login");
        }
    }
}