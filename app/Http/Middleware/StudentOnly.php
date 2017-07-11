<?php

namespace App\Http\Middleware;
use JWTAuth;
use Closure;

class StudentOnly
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

        if($user->u_status!=0){
            return response()->json('你不是學生，沒有此權限',400);
        }else{
            $response=$next($request);
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
            $response->headers->set('charset', 'utf-8');
            return  $response;
        }

    }
}