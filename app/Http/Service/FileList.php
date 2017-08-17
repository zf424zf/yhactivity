<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 21:58
 */

namespace App\Http\Service;

use App\Http\Api\Module;
class FileList
{
    public function videoList($module, $child = '', $sort = 'like', $order = 'desc', $uid = '')
    {

        //todo 统一到listController
        switch ($sort) {
            case 'like':
                $data = $this->getListSortByLike($module, $child, $order);
                break;
            case 'new':
                $data = $this->getListSortByNew($module, $child, $order);
                break;
            default:
                $data = $this->getListSortByLike($module, $child, $order);
                break;
        }
        return $this->formatCanLike($module, $data, $uid);
    }

    public function formatCanLike($module, $data, $uid)
    {
        $ids = array_column($data, 'id');
        $canLike = [];
        if (!empty($uid)) {
            if (empty($ids)) {
                $where = " where uid = $uid and module = $module";
            } else {
                $where = " where target_id IN (" . implode(',', $ids) . ") AND uid = $uid and module = $module";
            }
            $sql = "SELECT
                            COUNT(*) AS cnt,
                            target_id
                        FROM
                            yh_like" . $where . "
                        GROUP BY
                            target_id
                        having cnt < 5";
            $likes = \DB::select($sql);
            $canLike = collect($likes)->keyBy('target_id')->all();
        }
        foreach ($data as $item) {
            $key = $item->id;
            if (array_key_exists($key, $canLike)) {
                $item->canLike = 1;
            } else {
                $item->canLike = 0;
            }
        }
        return $data;
    }

    public function getListSortByNew($module, $child, $order)
    {
        $table = $module == Module::VIDEO_MODULE ? 'yh_video' : 'yh_image';
        $likeWhere = '';
        $where = '';
        if (!empty($child)) {
            $likeWhere .= ' and child = ' . $child;
            $where .= ' where t1.module = ' . $child;
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt
                FROM
                    $table t1
                LEFT JOIN (
                    SELECT
                        module,
                        child,
                        target_id,
                        count(*) AS cnt
                    FROM
                        yh_like
                    WHERE
                        module = $module" . $likeWhere . "
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id 
                left join yh_users t3 on t3.id = t1.uid" . $where . "
                ORDER BY
                    t1.id $order";
        return \DB::select($sql);
    }

    public function getListSortByLike($module, $child = 1, $order = 'desc')
    {
        $table = $module == Module::VIDEO_MODULE ? 'yh_video' : 'yh_image';
        $where = '';
        $likeWhere = '';
        if (!empty($child)) {
            $likeWhere .= ' and child = ' . $child;
            $where = ' where t1.module = ' . $child;
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.profile
                FROM
                    $table t1
                LEFT JOIN (
                    SELECT
                        module,
                        child,
                        target_id,
                        count(*) AS cnt
                    FROM
                        yh_like
                    WHERE
                        module = $module" . $likeWhere . "
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id 
                left join yh_users t3 on t3.id = t1.uid" . $where . "
                ORDER BY
                    t2.cnt $order";
        return \DB::select($sql);
    }
}