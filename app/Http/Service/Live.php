<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/5
 * Time: 21:43
 */

namespace App\Http\Service;


use GuzzleHttp\Client;

class Live
{
    public function getLiveList($param = [])
    {
        $url = env('NICE_LIVE_LIST_URL');
        return (new Upload())->get($url,$param);
    }

    public function liveList($id = 0)
    {
        $url = env('NICE_LIVE_LIST_URL');
        $get = [
            'query' => [
                'id' => $id
            ]
        ];
        $http = new Client();
        $result = $http->get($url, $id ? $get : []);
        $response = json_decode($result->getBody()->__toString(), true);
        return $response;
    }


}