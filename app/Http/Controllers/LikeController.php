<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 20:17
 */

namespace App\Http\Controllers;


use App\Http\Request\LikeRequest;
use App\Http\Service\Like;

class LikeController extends Controller
{
    public function like(LikeRequest $request){
        return (
            new Like())
            ->pointLike(
                $request->get('uid'),
                $request->get('module'),
                $request->get('child'),
                $request->get('target')
                );
    }
}