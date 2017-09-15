<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 10:28
 */

namespace App\Http\Controllers;


use App\Http\Api\Module;
use App\Http\Api\VideoChild;
use App\Http\Request\VideoInfoRequest;
use App\Http\Request\VideoRequest;
use App\Http\Service\FileList;
use App\Http\Service\Service;
use App\Http\Service\Video;
use Illuminate\Support\Facades\Input;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin',
            ['except'=>['addVideo','info','getQuestionList','questionDetail']]);
    }

    public function addVideo(VideoRequest $request)
    {
        $result = (new Video())->add(
            $request->get('uid'),
            $request->get('nice_uid'),
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
        return api_response(Service::SUCCESS, $data ? $data->toArray() : []);
    }

    public function questionListView()
    {
        $data = (new Video())->question();
        return view('video.question', ['question' => $data]);
    }

    public function videoIndexView()
    {
        return view('video.index');
    }

    public function detailView($id)
    {
        $uid = session('user')['id'];
         $video = (new Video())->info($id, $uid);
        if (empty($video)) {
            abort(404);
        }
        return view('video.detail', ['data' => $video]);
    }

    public function listView(){
        $uid = session('user')['id'];
        $child = Input::get('child',VideoChild::VIDEO_SS);
        $data =  (new FileList())->videoList(Module::VIDEO_MODULE,'like',$child,'desc',$uid);
        return view('video.rank',['data'=>$data]);
    }

    public function listNewView(){
        $uid = session('user')['id'];
        $child = Input::get('child',VideoChild::VIDEO_SS);
        $data =  (new FileList())->videoList(Module::VIDEO_MODULE,'new',$child,'desc',$uid);
        return view('video.new',['data'=>$data]);
    }
}