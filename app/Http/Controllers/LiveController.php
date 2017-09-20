<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/5
 * Time: 21:33
 */

namespace App\Http\Controllers;


use App\Http\Service\Live;
use App\Http\Service\Message;
use App\Http\Service\Service;

class LiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin',['except'=>['getViewCount','getLivingUser','listLive']]);

    }

    public function liveListView()
    {
        $list = (new Live())->getLiveList();
        return view('live.index', ['list' => json_decode($list, true)]);
    }

    public function listLive($id)
    {
        return $list = (new Live())->liveList($id);
    }

    public function detail($id)
    {
        $user = session('user');
        $uid = array_get($user,'id');
        $detailStr = (new Live())->getLiveList(['id' => $id]);
        $detail = json_decode($detailStr, true);
        $data = current(array_get($detail, 'data', []));
        $message = (new Message())->getMessage(array_get($data, 'id'));
        return view('live.detail', ['data' => $data,'uid'=>$uid,'message' => $message]);
    }

    public function getLivingUser(){
        $data = (new Live())->getLiving();
        return api_response(Service::SUCCESS,['living'=>$data]);
    }

    public function getViewCount(){
        $kolId = \Request::get('kol_id');
         $data = (new Live())->getViewCount($kolId);
        return api_response(Service::SUCCESS,$data);
    }
}