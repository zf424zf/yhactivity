<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 21:57
 */

namespace App\Http\Controllers;


use App\Http\Request\ListRequest;
use App\Http\Service\FileList;

class ListController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = session('user');
    }

    public function getList(ListRequest $request)
    {
        return $data = (new FileList())->videoList(
            $request->get('module'),
            $request->get('sort'),
            $request->get('child',''),
            $request->get('order','desc'),
            $request->get('uid'),
            $request->get('page'),
            $request->get('pagesize'));
    }
}