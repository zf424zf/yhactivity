<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:35
 */

namespace App\Http\Controllers;


use App\Http\Request\ChallengeRequest;
use App\Http\Request\ImageInfoRequest;
use App\Http\Request\ImageRequest;
use App\Http\Service\Image;
use App\Http\Service\Service;

class ImageController extends Controller
{
    public function add(ImageRequest $request)
    {
        $data = (new Image())->addImage(
            $request->get('uid'),
            $request->get('module'),
            $request->get('path'),
            $request->get('type'),
            $request->get('info'),
            $request->get('origin'),
            $request->get('label'),
            $request->get('originLabel')
        );
        return api_response(Service::SUCCESS, $data);
    }

    public function info(ImageInfoRequest $request)
    {
        $data = (new Image())->imageInfo(
            $request->get('id'), $request->get('uid')
        );
        return api_response(Service::SUCCESS, $data);
    }

    public function challengeList(ChallengeRequest $request)
    {
        $data = (new Image())->challengeList($request->get('module'),
            $request->get('page', 1),
            $request->get('pagesize', 12));
        return api_response(Service::SUCCESS, $data);
    }
}