<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 11:22
 */

namespace App\Http\Service;


use App\Http\Api\Module;
use App\Http\Models\VideoModel;

class Video
{

    public function add($uid, $module, $path, $info)
    {
        $info = is_array($info) ? implode(',', $info) : $info;
        $model = new VideoModel();
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->videoinfo = $info;
        $model->save();
        return $model->with('users')->first();
    }

    public function videoList($module,$sort = 'like', $oreder = 'desc', $uid = '', $child = '')
    {
        //todo 统一到listController
        switch ($sort) {
            case 'like':
                $data = $this->getListSortByLike($module, $child,$oreder);
                break;
            case 'new':
                $data = $this->getListSortByNew($module, $child,$oreder);
                break;
            default:
                $data = $this->getListSortByLike($module, $child,$oreder);
                break;
        }
        return $data;
    }

    public function getListSortByNew($module, $child,$oreder){
        $table = $module == Module::VIDEO_MODULE ? 'yh_video' : 'yh_image';
        //todo
    }

    public function getListSortByLike($module,$child = 1,$order='desc')
    {
        $table = $module == Module::VIDEO_MODULE ? 'yh_video' : 'yh_image';
        $where = '';
        if (!empty($child)) {
            $where .= ' and child = ' . $child;
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
                        module = $module" . $where . "
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id
                ORDER BY
                    t2.cnt $order";
        return \DB::select($sql);
    }
}