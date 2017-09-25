<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 23:11
 */

namespace App\Http\Service;


use App\Http\Api\Module;
use App\Http\Models\ImageModel;
use App\Http\Models\LikeModel;
use App\Http\Models\UserModel;
use App\Http\Models\VideoModel;
use Carbon\Carbon;

class Upload
{

    const LITTLE_PROGRAM_CHANNEL = 1;//小程序渠道
    const H5_CHANNEL = 2;//H5渠道

    private static $file;

    public function __construct()
    {
        self::$file = current(\Request::file());
    }

    public function remove($uid, $module, $target)
    {
        if ($module == Module::PHOTO_MODULE) {
            $model = ImageModel::where('uid',$uid)->where('id',$target)->first();
        } else if ($module == Module::VIDEO_MODULE) {
            $model = VideoModel::where('uid',$uid)->where('id',$target)->first();
        } else {
            api_exception(Service::MODULE_ERROR);
        }
        if(empty($model)){
            return false;
        }
        LikeModel::where('module',$module)->where('target_id',$target)->delete();
        return $model->delete();
    }


    /**
     * 图片上传接口
     * 验证用户
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload($type = Module::PHOTO_MODULE)
    {
        if ($type == Module::PHOTO_MODULE || $type == Module::SHARE_MODULE) {
            return $this->uploadImage();
        } else {
            return $this->uploadVideo();
        }
    }

    public function uploadImage()
    {
        $content = file_get_contents(self::$file);
        $formatFile = base64_encode($content);
        $url = "http://m.oneniceapp.com/open/uploadpic";
        $parma = ['content' => $formatFile, 'encode' => 'base64', 'token' => '36d9a31df1d6721cc52715946103434a'];
//        $parma = "content=$formatFile&encode=base64&token=36d9a31df1d6721cc52715946103434a";
        $result = $this->post($url, $parma);
        $resultArr = json_decode($result, true);
        if ($resultArr['code'] != 0) {
            api_exception(Service::UPLOAD_FAIL);
        }
        \Log::error($result);
        return $result;
    }

    public function uploadVideo()
    {
        $contents = file_get_contents(self::$file);
        $filename = storage_path('/' . uniqid());
        file_put_contents($filename, $contents);
        $cfile = curl_file_create($filename, 'image/jpeg', 'test_name');
        $params = ['file' => $cfile, 'token' => '36d9a31df1d6721cc52715946103434a'];
        $defaults = [
            CURLOPT_URL => 'http://coolly-salmon.api.oneniceapp.com/Upload/uploadvideo',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
        ];
        $ch = curl_init();
        curl_setopt_array($ch, $defaults);
        curl_exec($ch);
    }


    public function post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Expect:']);
        curl_exec($ch);
        $result = curl_multi_getcontent($ch);
        curl_close($ch);
        return $result;
    }

    public function get($url, array $data = [])
    {
        $str = '?';
        foreach ($data as $key => $item) {
            $str .= $key . '=' . $item . '&';
        }
        if (!empty($data)) {
            $url .= $str;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

//    /**
//     * 获取文件名称
//     * @return string
//     */
//    private static function getFileName()
//    {
//        return date('YmdHis') . rand(100000, 999999) . '.' . current(\Request::file())->getClientOriginalExtension();
//    }
//
//    /**
//     * 获取文件存储路径
//     * @return string
//     */
//    private Static function getFileDir()
//    {
//        $path = trim(config('filesystems.disks.oss.path'), '/');
//        $dir = date('/Y/m/d/');
//        return $path . $dir;
//    }
//
//    /**
//     * @param $fileName
//     * @return string
//     * 根据附件名称获取附件的存储路径
//     */
//    public static function getPathByFileName($fileName)
//    {
//        $path = trim(config('filesystems.disks.oss.path'), '/');
//        $year = substr($fileName, 0, 4);
//        $month = substr($fileName, 4, 2);
//        $day = substr($fileName, 6, 2);
//        $path = $path . '/' . $year . '/' . $month . '/' . $day . '/' . $fileName;
//        return $path;
//    }
}