<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/14
 * Time: 20:28
 */

namespace App\Http\Service;


abstract class Service
{
    const SUCCESS = 0;//Success

    const UID_REQUIRED = 1001;//uid必须
    const UID_TYPE_ERR = 1002;//uid类型错误
    const LK_MODULE_REQUIRED = 1003;//模块必须
    const LK_MODULE_VALUE_ERR = 1004;//模块值错误
    const LK_CHILD_REQUIRED = 1005;//子模块必须
    const LK_CHILD_VALUE_ERR = 1006;//子模块值错误
    const LK_TARGET_REQUIRED = 1007;//目标必须
    const LK_TARGET_VALUE_ERR = 1008;//目标值错误
    const LK_USER_HAS_BEEN_LIKE = 1009;//该用户已经赞过

    const MSG_USER_NOT_FOUND = 2001;//用户不存在或者未登录，不能发表留言
    const MSG_SAVE_ERR = 2002;//留言失败
    const MSG_CONTENT_REQUIRED = 2003;//留言不能为空
    const MSG_CONTENT_SIZE_ERROR = 2004;//留言字数必须少于256个字
    const MSG_CHANNEL_REQUIRED = 2005;//直播频道必须指定


    const SYSTEM_ERROR = 9999;//系统错误
    /**
     * @param $code
     * @return string
     */
    public static function getMessage($code)
    {
        $lines = file(__FILE__);
        foreach ($lines as $line) {
            $line = trim($line);
            $line = str_replace('=', ' = ', $line);
            $line = preg_replace("/\s(?=\s)/", "\\1", $line);
            $line = str_replace(' ;', ';', $line);
            if (starts_with($line, 'const') && str_contains($line, '= ' . $code . ';')) {
                $line = explode('//', $line);
                if (isset($line[1])) {
                    return trim($line[1]);
                }
                return '';
            }
        }
    }

}