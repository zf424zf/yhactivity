<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:35
 */

namespace App\Http\Controllers;


use App\Http\Api\Module;
use App\Http\Api\PhotoChild;
use App\Http\Request\ChallengeDetailRequest;
use App\Http\Request\ChallengeRequest;
use App\Http\Request\ImageInfoRequest;
use App\Http\Request\ImageRequest;
use App\Http\Request\ShareImageRequest;
use App\Http\Service\FileList;
use App\Http\Service\Image;
use App\Http\Service\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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

    public function challengeDetail(ChallengeDetailRequest $request)
    {
        $data = (new Image())->challengeDetail($request->get('id'));
        return api_response(Service::SUCCESS, $data);
    }

    public function shareImage(ShareImageRequest $request)
    {
        $data = (new Image())->shareImage(
            $request->get('uid'),
            $request->get('path'),
            $request->get('info', '')
        );
        return api_response(Service::SUCCESS, $data);
    }

    public function indexView()
    {
        $data = (new FileList())->videoList(1, '');
        return view('photo.index', ['data' => $data]);
    }

    public function newView()
    {
        $uid = 1;
        $module = Input::get('module', Module::PHOTO_MODULE);
        $child = Input::get('child', PhotoChild::PHOTO_BS);
        $sort = 'new';
        $data = (new FileList())->videoList($module, $sort, $child, 'desc', $uid);
        return view('photo.rank_new', ['data' => $data]);
    }

    public function rankView()
    {
        var_dump(session('user'));
        return;
        $uid = 1;
        $module = Input::get('module', Module::PHOTO_MODULE);
        $child = Input::get('child', PhotoChild::PHOTO_BS);
        $sort = 'like';
        $data = (new FileList())->videoList($module, $sort, $child, 'desc', $uid);
        return view('photo.rank', ['data' => $data]);
    }

    public function detailView($id)
    {
        $uid = 1;
        try {
            $data = (new Image())->imageInfo($id, $uid);
        } catch (\Exception $e) {
            abort(404);
        }
        return view('photo.detail', ['data' => $data]);
    }

    public function challengeView($module)
    {
        if (!in_array($module, [1, 2, 3, 4])) {
            abort(404);
        }
        $data = (new Image())->challengeList($module, \Request::get('page', 1), \Request::get('pagesize', 12));
        return view('photo.challenge', ['data' => $data, 'module' => $module]);
    }
}