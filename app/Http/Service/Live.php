<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/5
 * Time: 21:43
 */

namespace App\Http\Service;


class Live
{
    public function getLiveList($param = [])
    {
        $url = env('NICE_LIVE_LIST_URL');
        return (new Upload())->get($url,$param);
    }
}