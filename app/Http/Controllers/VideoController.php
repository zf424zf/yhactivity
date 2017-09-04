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
use App\Http\Service\Service;
use App\Http\Service\Video;

class VideoController extends Controller
{
    public function addVideo(VideoRequest $request)
    {
        $result = (new Video())->add(
            $request->get('uid'),
            $request->get('module'),
            $request->get('path'),
            $request->get('info'),
            $request->get('qid'),
            $request->get('cover')
        );
        return api_response(Service::SUCCESS, $result);
    }

    public function info(VideoInfoRequest $request)
    {
        return (new Video())->info(
            $request->get('id'),
            $request->get('uid')
        );
    }

    public function getQuestionList()
    {
        $data = (new Video())->question();
        return api_response(Service::SUCCESS, $data);
    }

    public function questionDetail()
    {
        $data = (new Video())->questionDetail(request('id'));
        return api_response(Service::SUCCESS, $data);
    }

    public function questionListView()
    {
        $data = (new Video())->question();
        return view('video.question', ['question' => $data]);
    }
}