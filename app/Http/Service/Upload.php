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

    private static $file;

    public function __construct()
    {
        self::$file = current(\Request::file());
    }

    /**
     * 阿里云视频图片上传接口
     * 验证用户
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload($uid)
    {
        $user = UserModel::where('uid',$uid)->first();
        if(!$user){
            api_exception(Service::UID_REQUIRED);
        }
        $content = file_get_contents(self::$file);
        $fileName = self::getFileName();
         \Storage::put(self::getFileDir() . $fileName, $content);
         $path =config('filesystems.disks.oss.domain') . self::getPathByFileName($fileName);
         return api_response(Service::SUCCESS,['path'=>$path]);
    }

    /**
     * 获取文件名称
     * @return string
     */
    private static function getFileName()
    {
        return date('YmdHis') . rand(100000, 999999) . '.' . current(\Request::file())->getClientOriginalExtension();
    }

    /**
     * 获取文件存储路径
     * @return string
     */
    private Static function getFileDir()
    {
        $path = trim(config('filesystems.disks.oss.path'), '/');
        $dir = date('/Y/m/d/');
        return $path  . $dir;
    }

    /**
     * @param $fileName
     * @return string
     * 根据附件名称获取附件的存储路径
     */
    public static function getPathByFileName($fileName)
    {
        $path = trim(config('filesystems.disks.oss.path'), '/');
        $year = substr($fileName, 0, 4);
        $month = substr($fileName, 4, 2);
        $day = substr($fileName, 6, 2);
        $path = $path . '/' . $year . '/' . $month . '/' . $day . '/' . $fileName;
        return $path;
    }
}