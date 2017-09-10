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

class LiveController extends Controller
{
    public function liveListView()
    {
         $list = (new Live())->getLiveList();
        return view('live.index', ['list' => json_decode($list, true)]);
    }

    public function detail($id)
    {
        $detailStr = (new Live())->getLiveList(['id' => $id]);
        $detail = json_decode($detailStr, true);
        $data = current(array_get($detail, 'data', []));
        $message = (new Message())->getMessage(array_get($data, 'id'));
        return view('live.detail', ['data' => $data, 'message' => $message]);
    }
}