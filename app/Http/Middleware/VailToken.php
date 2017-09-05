<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Service\User;
class VailToken

{
    const SUCCESS           = 2000;
    const REGSOURCEERROR	= 1001;
    const TOKENNOTEXISITS	= 2008;

    public function handle($request, Closure $next)
    {
//        $headers = $request->header();
//        $token = isset($headers['token']) ? $headers['token'][0] : '';;
//        if(empty($token)){
//            return state(self::TOKENNOTEXISITS);
//        }
////        $source = isset($headers['source']) ? $headers['source'][0] : 1;
//        $check = (new User())->isValidToken($token);
//        if($check['status'] !== self::SUCCESS){
//            return $check;
//        }
        return $next($request);
    }

}
