<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 21:58
 */

namespace App\Http\Service;

use App\Http\Api\Module;
use App\Http\Models\ImageModel;

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
        return $data;
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
        $where = ' where 1=1';
        $q = '';
        $left = '';
        if (!empty($child)) {
            $likeWhere .= ' and child = ' . $child;
            $where .= ' and t1.module = ' . $child;
        }
        if($module == Module::PHOTO_MODULE){
            $where .= ' and t1.type = 1';
        }
        if($module == Module::VIDEO_MODULE){
            $q = ' ,t4.question as qname';
            $left = ' left join yh_question t4 on t4.id = t1.qid';
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.profile ".$q."
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
                left join yh_users t3 on t3.id = t1.uid".$left . $where . "
                ORDER BY
                    t1.id $order";
        $data = \DB::select($sql);
        if($module == Module::PHOTO_MODULE){
            return $this->formatOriginForImageList($data);
        }
        return $data;
    }

    public function formatOriginForImageList($data){
        $ids = array_column($data,'origin');
        $origins = ImageModel::whereIn('id',$ids)->get()->keyBy('id')->toArray();
        foreach ($data as $item){
            if(array_key_exists($item->origin,$origins)){
                $item->originInfo = $origins[$item->origin];
            }else{
                $item->originInfo = [];
            }
        }
        return $data;
    }


    public function getListSortByLike($module, $child = 1, $order = 'desc')
    {
        $table = $module == Module::VIDEO_MODULE ? 'yh_video' : 'yh_image';
        $where = ' where 1=1';
        $q = '';
        $left = '';
        $likeWhere = '';
        if (!empty($child)) {
            $likeWhere .= ' and child = ' . $child;
            $where .= ' and t1.module = ' . $child;
        }
        if($module == Module::PHOTO_MODULE){
            $where .= ' and t1.type = 1';
        }

        if($module == Module::VIDEO_MODULE){
            $q = ' ,t4.question as qname';
            $left = ' left join yh_question t4 on t4.id = t1.qid';
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.profile ".$q."
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
                left join yh_users t3 on t3.id = t1.uid" . $left.$where . "
                ORDER BY
                    t2.cnt $order";
        $data = \DB::select($sql);
        if($module == Module::PHOTO_MODULE){
            return $this->formatOriginForImageList($data);
        }
        return $data;
    }
}