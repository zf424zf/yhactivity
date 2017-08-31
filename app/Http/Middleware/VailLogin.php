<?php

namespace App\Http\Middleware;

use App\Http\Service\Service;
use App\Http\Service\User;
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
        //获取用户信息
        $userInfo = session('user');
        $visitUrl = $request->fullUrl();
        session(['visit'=>$visitUrl]);
        //若为空 获取uid
        if (empty($userInfo)) {
            $uid = $request->get('uid');

            if (!empty($uid)) {
                (new User())->niceUser($uid,
                    $request->get('name', ''),
                    $request->get('avatar', ''));
                    return $next($request);
            }
            //若uid不存在 请求nice接口
            $url = urls('/mn?redirect_uri=' . urls('/getNiceUser'));
            \Redirect::to($url)->send();
        }
        return $next($request);
    }
}
