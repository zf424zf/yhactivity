<?php
/**
 * Created by PhpStorm.
 * User: skiden
 * Date: 2017/6/9
 * Time: 上午9:11
 */

use App\Exceptions\ApiException;
use App\Http\Service\Service;

if (!function_exists('setting')) {
    /**
     * Get / set the specified setting value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string $key
     * @param  mixed $default
     * @return mixed
     */
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('setting')->get();
        }

        if (is_array($key)) {
            return app('setting')->set($key);
        }

        return app('setting')->get($key, $default);
    }
}


if (!function_exists('api_exception')) {
    /**
     * @param  int $code 状态码
     * @param null $message 指定异常消息 或者 指定模板变量
     * @throws ApiException
     * 接口异常
     */
    function api_exception($code, $message = null)
    {
        if (!is_int($code)) {
            $code = Service::SYSTEM_ERROR;
        }
        if (is_null($message)) {
            $message = Service::getMessage($code);
        } elseif (is_array($message)) {
            $template = Service::getMessage($code);
            foreach ($message as $key => $item) {
                $template = str_replace('#' . $key . '#', $item, $template);
            }
            $message = $template;
        }
        throw new ApiException($message, $code);
    }
}

if (!function_exists('api_response')) {

    function api_response($status = 0, $data = null, array $replace = [])
    {
        $message = Service::getMessage($status);
        if ($replace) {
            foreach ($replace as $key => $item) {
                $message = str_replace('#' . $key . '#', $item, $message);
            }
        }
        $result = [
            'code'    => $status,
            'message' => $message,
        ];
        if (!is_null($data)) {
            $result['data'] = $data;
        }
        return response()->json($result);
    }
}


if (!function_exists('cache_key')) {

    function cache_key($key, $arr1 = '', $arr2 = '', $arr3 = '', $arr4 = '')
    {
        $str = config('cachekey.' . $key);
        return sprintf($str, $arr1, $arr2, $arr3, $arr4);
    }
}

if (!function_exists('img_url')) {

    function img_url($urls, $width = null, $height = null)
    {
        is_array($urls) || $urls = [$urls];
        $append = [];
        if ($width || $height) {
            $append[] = 'x-oss-process=image/resize';
            $append[] = 'm_fill';
            $append[] = 'Q_100';
        }
        if ($width) $append[] = 'w_' . $width;
        if ($height) $append[] = 'h_' . $height;
        $thumb = [];
        $seg = count($append) ? '?' : '';
        foreach ($urls as $url) {
            $thumb[] = config('admin.upload.host') . $url . $seg . implode(',', $append);
        }
        return count($thumb) == 1 ? current($thumb) : $thumb;
    }

}

