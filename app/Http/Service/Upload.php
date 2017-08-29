<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 23:11
 */

namespace App\Http\Service;


use App\Http\Models\UserModel;

class Upload
{

    const LITTLE_PROGRAM_CHANNEL = 1;//小程序渠道
    const H5_CHANNEL = 2;//H5渠道

    private static $file;

    public function __construct()
    {
        self::$file = current(\Request::file());
    }

    /**
     * 图片上传接口
     * 验证用户
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload()
    {

        $content = file_get_contents(self::$file);
        $formatFile = base64_encode($content);
        $url = "http://m.oneniceapp.com/open/uploadpic";
        $parma = ['content'=>$formatFile,'encode'=>'base64','token'=>'36d9a31df1d6721cc52715946103434a'];
//        $parma = "content=$formatFile&encode=base64&token=36d9a31df1d6721cc52715946103434a";
        $result = $this->post($url, $parma);
        $resultArr = json_decode($result, true);
        if ($resultArr['code'] != 0) {
            api_exception(Service::UPLOAD_FAIL);
        }
        return $result;
//        $fileName = self::getFileName();
//        \Storage::put(self::getFileDir() . $fileName, $content);
//        $path = config('filesystems.disks.oss.domain') . self::getPathByFileName($fileName);
//        return api_response(Service::SUCCESS, ['path' => $path]);
    }


    public function post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_exec($ch);
        $result = curl_multi_getcontent($ch);
        curl_close($ch);
        return $result;
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