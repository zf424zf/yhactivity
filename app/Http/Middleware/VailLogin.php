<?php

namespace App\Http\Middleware;

use App\Http\Service\Service;
use Closure;

class VailLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userInfo =session('user');
        if(empty($userInfo)){
            $url = urls('/mn?redirect_uri='.urls('/getNiceUser'));
             if(redirect($url)){
                 \Log::error(12345);
                 return $next($request);
             }
        }
        return $next($request);
    }
}
