<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/16
 * Time: 16:35
 */

namespace App\Http\Controllers;


use App\Http\Request\ImageRequest;
use App\Http\Service\Image;

class ImageController extends Controller
{
    public function add(ImageRequest $request)
    {
        return (new Image())->addImage($request->get('uid'),
            $request->get('module'),
            $request->get('path'),
            $request->get('info'));
    }
}