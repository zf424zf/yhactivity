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
        return (new Upload())->get($url, $param);
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

    public function getLiving()
    {
        $data = $this->liveList();
        $living = null;
        if ($data['code'] == 0) {
            foreach ($data['data'] as $item) {
                if ($item['status'] == 'living') {
                    $living = $item;
                    break;
                }
            }
        }
        return $living;
    }

    public function getViewCount($kolId)
    {
        $count = setting('living_view_count_' . $kolId);
        if (empty($count)) {
            $count = 0;
        }
        return $count;
    }
}