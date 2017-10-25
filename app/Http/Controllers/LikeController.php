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


    public function like(LikeRequest $request){
        $h = apache_request_headers();
        if(isset($h['Referer']) && str_contains($h['Referer'],'https://servicewechat.com/wxe0e00ed5e74706e2'))
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
        return (
        new Like())
            ->pointLike(
                \Request::get('uid'),
                \Request::get('module'),
                \Request::get('child'),
                \Request::get('target')
            );
    }
}