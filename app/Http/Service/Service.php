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
    const TOKENERROR = 100;//token错误，请重新登录
    const UPLOAD_FAIL = 300;//上传失败

    const UID_REQUIRED = 1001;//uid必须
    const UID_TYPE_ERR = 1002;//uid类型错误
    const LK_MODULE_REQUIRED = 1003;//模块必须
    const LK_MODULE_VALUE_ERR = 1004;//模块值错误
    const LK_CHILD_REQUIRED = 1005;//子模块必须
    const LK_CHILD_VALUE_ERR = 1006;//子模块值错误
    const LK_TARGET_REQUIRED = 1007;//目标必须
    const LK_TARGET_VALUE_ERR = 1008;//目标值错误
    const LK_USER_HAS_BEEN_LIKE = 1009;//该用户已经赞过
    const LK_FILE_NOT_FOUND = 1010;//点赞的文件不存在

    const MSG_USER_NOT_FOUND = 2001;//用户不存在或者未登录，不能发表留言
    const MSG_SAVE_ERR = 2002;//留言失败
    const MSG_CONTENT_REQUIRED = 2003;//留言不能为空
    const MSG_CONTENT_SIZE_ERROR = 2004;//留言字数必须少于256个字
    const MSG_CHANNEL_REQUIRED = 2005;//直播频道必须指定

    const IMAGE_MODULE_REQUIRED = 3001;//图片module必须存在
    const IMAGE_MODULE_VALUE_ERR = 3002;//图片module值错误
    const IMAGE_PATH_REQUIRED = 3003;//图片路径必须存在
    const IMAGE_INFO_MUST_JSON = 3004;//图片信息必须为json格式
    const IMAGE_LEFT_PIC_NOT_FOUND = 3005;//找不到挑战图片
    const IMAGE_TYPE_REQUIRED = 3006;//图片类型必须上传
    const IMAGE_TYPE_VALUE_ERR = 3007;//图片类型只能是0或者1
    const IMAGE_ORIGIN_REQUIRED = 3008;//上传右边图片时关联id必须存在
    const IMAGE_LABEL_SIZE_ERR = 3009;//LABEL长度不能超过10个字
    const IMAGE_ORIGIN_LABEL_SIZE_ERR = 3010;//originLABEL长度不能超过10个字
    const IMAGE_NOT_FOUND = 3011;//图片不存在
    const IMAGE_ID_REQUIRED = 3012;//图片id必须
    const IMAGE_ID_NOT_FOUND = 3013;//图片id不存在
    const IMAGE_ID_VALUE_ERR = 3014;//图片id值错误
    const IMAGE_UID_NOT_FOUND = 3015;//用户不存在
    const IMAGE_UID_VALUE_ERR = 3016;//用户值错误


    const VIDEO_MODULE_REQUIRED = 3101;//视频module必须存在
    const VIDEO_MODULE_VALUE_ERR = 3102;//视频module值错误
    const VIDEO_PATH_REQUIRED = 3103;//视频路径必须存在
    const VIDEO_INFO_MUST_JSON = 3104;//视频信息必须为json格式
    const VIDEO_NOT_FOUND = 3105;//视频不存在
    const VIDEO_ID_REQUIRED = 3106;//视频id必须
    const VIDEO_ID_VALUE_ERR = 3107;//视频id类型错误
    const VIDEO_ID_NOT_FOUND = 3108;//视频id不存在
    const VIDEO_UID_NOT_FOUND = 3109;//用户不存在
    const VIDEO_UID_VALUE_ERR = 3110;//用户值错误


    const LIST_MODULE_REQUIRED = 3201;//module必须存在
    const LIST_MODULE_VALUE_ERR = 3202;//module值错误
    const LIST_CHILD_VALUE_ERR = 3203;//child值错误
    const LIST_SORT_VALUE_ERR = 3204;//排序字段值错误
    const LIST_ORDER_VALUE_ERR = 3205;//order值错误

    const LIKE_TODAY_CHANCE_NONE = 3301;//用户今天抽奖机会已经用完
    
    const WX_CODE_NOT_EXISTS = 4001;//code必须存在
    const WX_TICKET_NOT_EXISTS = 4002;//ticket不存在
    const WX_DECRYPT_FAIL = 4003;//用户信息解密失败
    const WX_ENCRYPT_DATA_NOT_EXISTS = 4004;//微信加密消息不存在
    const WX_IV_NOT_EXISTS = 4005;//解密IV不存在

    const PAGE_VALUE_ERR = 9001;//分页参数错误
    const PAGE_SIZE_VALUE_ERR = 9002;//每页显示条数参数错误
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