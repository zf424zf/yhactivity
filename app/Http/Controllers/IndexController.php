<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/26
 * Time: 22:06
 */

namespace App\Http\Controllers;


use App\Http\Service\Live;

class IndexController
{
    public function index(){
         $living = (new Live())->getLiving();
        return view('index',['data'=>$living]);
    }
}