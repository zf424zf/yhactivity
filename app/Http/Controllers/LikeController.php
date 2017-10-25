<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 20:17
 */

namespace App\Http\Controllers;


use App\Http\Request\LikeRequest;
use App\Http\Request\ListRequest;
use App\Http\Service\Like;
use App\Http\Service\Service;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin',
            ['except' => ['like', 'likeView']]);
    }

    public function like(LikeRequest $request){
        $h = $request->header('Referer');
        \Log::error($h);
        \Log::error('target====>'.$request->get('target'));
        \Log::error('uid====>'.$request->get('uid'));
        if(isset($h) && str_contains($h,'https://servicewechat.com/wxe0e00ed5e74706e2'))
        {
            return (
            new Like())
                ->pointLike(
                    $request->get('uid'),
                    $request->get('module'),
                    $request->get('child'),
                    $request->get('target')
                );
        }
        return api_response(Service::DO_NOT_CHEAT);
    }

    public function likeView(){
        $uid = session('user')['id'];
        return (
        new Like())
            ->pointLike(
                $uid,
                \Request::get('module'),
                \Request::get('child'),
                \Request::get('target')
            );
    }
}