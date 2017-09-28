<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/26
 * Time: 20:57
 */

namespace App\Http\Controllers;


use App\Http\Service\Service;
use Carbon\Carbon;

class CountController extends Controller
{
    public function count()
    {
        date_default_timezone_set('PRC');
        $activityStart = Carbon::createFromDate(2017, 9, 25)->startOfDay()->timestamp;
        $activityEnd = Carbon::createFromDate(2017, 10, 23)->endOfDay()->timestamp;
        $yesterdayStart = Carbon::yesterday()->startOfDay()->timestamp;
        $start = \Request::get('start');
        $end = \Request::get('end');
        if (!empty($start)) {
            $s = Carbon::createFromFormat('Ymd', $start)->startOfDay()->timestamp;
            if ($s < $activityStart || $s > $activityEnd) {
                $s = $activityStart;
            }
        } else {
            $s = $yesterdayStart;
        }

        if (!empty($end)) {
            $e = Carbon::createFromFormat('Ymd', $end)->endOfDay()->timestamp;
            if ($e < $activityStart || $e > $activityEnd) {
                $e = $activityEnd;
            }
        } else {
            $e = $s + 86399;
        }
        $imageSql = "select count(*) as cnt from yh_image where type =1 and created_at >= $s and created_at <= $e ";
        $videoSql = "select count(*) as cnt from yh_video where created_at >= $s and created_at <= $e";
        $imageUser = "select count(t1.cnt) as cnt from (select count(uid) as cnt from yh_image where type = 1 and created_at >= $s and created_at <= $e group by uid ) t1";
        $videoUser = "select count(t1.cnt) as cnt from (select count(uid) as cnt from yh_video where created_at >= $s and created_at <= $e group by uid ) t1";
        $imageCount = \DB::select($imageSql);
        $videoCount = \DB::select($videoSql);
        $imageUserCount = \DB::select($imageUser);
        $videoUserCount = \DB::select($videoUser);
        return api_response(Service::SUCCESS, [
            'pintu_count' => current($imageCount)->cnt, 'pintu_user_count' => current($imageUserCount)->cnt,
            'shipin_count' => current($videoCount)->cnt, 'video_user_count' => current($videoUserCount)->cnt
        ]);


    }
}