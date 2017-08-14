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

    const LK_UID_REQUIRED = 1001;//uid必须
    const LK_UID_TYPE_ERR = 1002;//uid类型错误
    const LK_MODULE_REQUIRED = 1003;//模块必须
    const LK_MODULE_VALUE_ERR = 1004;//模块值错误
    const LK_CHILD_REQUIRED = 1005;//子模块必须
    const LK_CHILD_VALUE_ERR = 1006;//子模块值错误
    const LK_TARGET_REQUIRED = 1007;//目标必须
    const LK_TARGET_VALUE_ERR = 1008;//目标值错误
    const LK_USER_HAS_BEEN_LIKE = 1009;//该用户已经赞过



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