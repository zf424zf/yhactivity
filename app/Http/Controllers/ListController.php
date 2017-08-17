<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 21:57
 */

namespace App\Http\Controllers;


use App\Http\Service\FileList;

class ListController extends Controller
{
    public function getList(ListRequest $request)
    {
        return $data = (new FileList())->videoList(
            \Request::get('module'),
            \Request::get('child',''),
            \Request::get('sort','like'),
            \Request::get('order','desc'),
            \Request::get('uid'));
    }
}