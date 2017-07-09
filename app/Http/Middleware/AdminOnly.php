<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class AdminOnly
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
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if($user->u_status!=3){
            return response()->json('你不是管理者，沒有此權限',400);
        }else{
            $response=$next($request);
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
            $response->headers->set('charset', 'utf-8');
            return  $response;
        }
    }
}
