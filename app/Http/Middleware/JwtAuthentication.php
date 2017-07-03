<?php

namespace App\Http\Middleware;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Closure;

class JwtAuthentication
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
        try{
            JWTAuth::parseToken()->authenticate();
        }
        catch(JWTException $exception){
            return response()->json([
                'error' => '未登入',
                ],401);
        }
        $response=$next($request);
        $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        $response->headers->set('charset', 'utf-8');
        return  $response;
    }

}
