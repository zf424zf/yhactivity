<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/22
 * Time: 17:47
 */

namespace App\Http\Service;


use Illuminate\Support\Facades\Redis;

class RCache
{
    private $cache;

    public function __construct()
    {
        $this->cache = Redis::connection();
    }

    public function get($key)
    {
        return $this->cache->get($key);
    }

    public function set($key, $value, $expire)
    {
        if (($this->cache->get($key))) {
            $this->cache->del($key);
        }
        $this->cache->setex($key, $value, $expire);
    }


}