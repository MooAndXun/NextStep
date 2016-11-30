<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = $request->session()->get('user')['username'];
        if($username){
            return $next($request);
        }else{
            return redirect("/login");
        }
    }
}
