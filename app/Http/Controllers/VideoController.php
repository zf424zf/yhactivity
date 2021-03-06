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
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin',
            ['except' => ['addVideo', 'info', 'getQuestionList', 'questionDetail', 'indexList']]);
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

    public function indexList()
    {
        $data = (new Video)->indexList(\Request::get('id'));
        return api_response(Service::SUCCESS, $data);
    }

    public function getQuestionList()
    {
        $module = \Request::get('module');
        $data = (new Video())->question($module);
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

    public function videoIndexView($id)
    {
        $datas = (new Video())->indexList();
        $data = current($datas);
        foreach ($datas as $key => $item) {
            if ($key + 1 == $id) {
                $data = $item;
                break;
            }
            if ($id < 0 || $id > count($datas)) {
                $data = current($datas);
                break;
            }
        }
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        if ($day >= 25 || ($day <= 2 && $hour < 12)) {
            if ($hour < 12) {
                $jtId = 45;
            } else {
                $jtId = 46;
            }
        } elseif (($day >= 2 && $hour >= 12) && ($day <= 9 && $hour < 12)) {
            $jtId = 46;
        } elseif (($day >= 9 && $hour >= 12) && ($day <= 16 && $hour < 12)) {
            $jtId = 47;
        } elseif (($day >= 16 && $hour >= 12) && ($day <= 23 && $hour < 12)) {
            $jtId = 49;
        } else {
            $jtId = 49;
        }
        return view('video.index', ['id' => $id,'jtId'=>$jtId, 'data' => $data, 'count' => count($datas)]);
    }

    public function detailView($id)
    {
        $uid = session('user')['id'];
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        if ($day >= 25 || ($day <= 2 && $hour < 12)) {
            if ($hour < 12) {
                $jtId = 45;
            } else {
                $jtId = 46;
            }
        } elseif (($day >= 2 && $hour >= 12) && ($day <= 9 && $hour < 12)) {
            $jtId = 46;
        } elseif (($day >= 9 && $hour >= 12) && ($day <= 16 && $hour < 12)) {
            $jtId = 47;
        } elseif (($day >= 16 && $hour >= 12) && ($day <= 23 && $hour < 12)) {
            $jtId = 49;
        } else {
            $jtId = 49;
        }
        $uid = session('user')['id'];
        $video = (new Video())->info($id, $uid);
        if (empty($video)) {
            abort(404);
        }
        return view('video.detail', ['data' => $video,'jtId'=>$jtId,'uid'=>$uid]);
    }

    public function listView()
    {
        $uid = session('user')['id'];
        $child = Input::get('child', VideoChild::VIDEO_SS);
        $page = Input::get('page', 1);
        $pagesize = Input::get('pagesize', 6);
        $data = (new FileList())->videoList(Module::VIDEO_MODULE, 'like', $child, 'desc', $uid, $page, $pagesize);
        return view('video.rank', ['data' => $data]);
    }

    public function listNewView()
    {
        $uid = session('user')['id'];
        $child = Input::get('child', VideoChild::VIDEO_SS);
        $page = Input::get('page', 1);
        $pagesize = Input::get('pagesize', 6);
        $data = (new FileList())->videoList(Module::VIDEO_MODULE, 'new', $child, 'desc', $uid, $page, $pagesize);
        return view('video.new', ['data' => $data]);
    }
}