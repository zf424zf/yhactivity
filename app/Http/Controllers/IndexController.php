<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/26
 * Time: 22:06
 */

namespace App\Http\Controllers;


class IndexController
{
    public function index(){
        return view('index');
    }
}