<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 20:22
 */

namespace App\Http\Controllers;


use App\Http\Api\Module;
use App\Http\Request\RemoveRequest;
use App\Http\Service\Service;
use App\Http\Service\Upload;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller
{


    public function upload()
    {
        //todo request文件验证
       return (new Upload())->upload(Input::get('upload_type',Module::PHOTO_MODULE));
    }

    public function removeFile(RemoveRequest $request){
        $data =  (new Upload())->remove($request->get('uid'),$request->get('module'),$request->get('target'));
        if(empty($data)){
            return api_response(Service::REMOVE_DELETE);
        }
        return api_response(Service::SUCCESS);
    }
}