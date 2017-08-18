<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 10:28
 */

namespace App\Http\Controllers;


use App\Http\Request\VideoInfoRequest;
use App\Http\Request\VideoRequest;
use App\Http\Service\Video;

class VideoController extends Controller
{
    public function addVideo(VideoRequest $request)
    {
        return (new Video())->add(
            $request->get('uid'),
            $request->get('module'),
            $request->get('path'),
            $request->get('info')
        );
    }

    public function info(VideoInfoRequest $request){
        return (new Video())->info(
            $request->get('id'),
            $request->get('uid')
        );
    }
}