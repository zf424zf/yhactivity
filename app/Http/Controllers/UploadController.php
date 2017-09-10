<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:22
 */

namespace App\Http\Controllers;


use App\Http\Api\Module;
use App\Http\Service\Upload;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLogin');
    }

    public function upload()
    {
        //todo request文件验证
       return (new Upload())->upload(Input::get('type',Module::PHOTO_MODULE));
    }
}