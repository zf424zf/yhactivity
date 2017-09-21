<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 21:58
 */

namespace App\Http\Service;

use App\Http\Api\Module;
use App\Http\Api\PhotoChild;
use App\Http\Models\ImageModel;
use App\Http\Models\PhotoIndexModel;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Object_;

class FileList
{
    public $startTimestamp;
    public $endTimestamp;

    public function __construct()
    {
        date_default_timezone_set('PRC');
        $this->startTimestamp = Carbon::now()->startOfDay()->timestamp;
        $this->endTimestamp = Carbon::now()->endOfDay()->timestamp;
    }

    public function videoList($module, $sort, $child = '', $order = 'desc', $uid = '', $page = 1, $pagesize = 6)
    {
        $count = ($page - 1) * $pagesize;
        //todo 统一到listController
        switch ($sort) {
            case 'like':
                $data = $this->getListSortByLike($module, $child, $order, $count, $pagesize);
                break;
            case 'new':
                $data = $this->getListSortByNew($module, $child, $order, $count, $pagesize);
                break;
            default:
                return $data = $this->getIndexLists($order);
                break;
        }
        return $this->formatCanLike($module, $data, $uid);
    }

    public function getIndexLists($order)
    {
        $trues = $this->getImageListSortByModule($order);

        $trueBs = current(array_get($trues, PhotoChild::PHOTO_BS, []));
        $bsName = empty($trueBs) ? '':$trueBs->nickname;
        $bsCnt = empty($trueBs) ? '' : $trueBs->cnt;

        $trueMx = current(array_get($trues, PhotoChild::PHOTO_MX, []));
        $mxName = empty($trueMx) ? '':$trueMx->nickname;
        $mxCnt = empty($trueMx) ? '' : $trueMx->cnt;

        $trueZc = current(array_get($trues, PhotoChild::PHOTO_ZC, []));
        $zcName = empty($trueZc) ? '':$trueZc->nickname;
        $zcCnt = empty($trueZc) ? '' : $trueZc->cnt;

        $trueCh = current(array_get($trues, PhotoChild::PHOTO_CH, []));
        $chName = empty($trueCh) ? '':$trueCh->nickname;
        $chCnt = empty($trueCh) ? '' : $trueCh->cnt;


        $zcArr = [];
        $zc2 = new PhotoIndexModel();
        $zc2->id = 99999;
        $zc2->uid = 99999;
        $zc2->module = PhotoChild::PHOTO_ZC;
        $zc2->type = 1;
        $zc2->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/753995a13dd124cfa73bd7551eaaadcf.jpg-t1080';
        $zc2->picInfo = '';
        $zc2->created_at = '';
        $zc2->updated_at = '';
        $zc2->label = '美不美，看大腿';
        $zc2->origin = 99999;
        $zc2->cnt = 99999;
        $zc2->nickname = '徐峰立';
        $zc2->headicon = 'http://img08.oneniceapp.com/upload/avatar/2015/02/05/cc6b8f241fd5c5263443492f6017a6b6.jpg';
        $zc2->profile = '';
        $zc1 = new PhotoIndexModel();
        $zc1->id = 99999;
        $zc1->uid = 99999;
        $zc1->module = PhotoChild::PHOTO_ZC;
        $zc1->type = 1;
        $zc1->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/133250a10b80836c173987de3f5613cf.jpg-t1080';
        $zc1->picInfo = '';
        $zc1->created_at = '';
        $zc1->updated_at = '';
        $zc1->label = '你的腿毛露出来了';
        $zc1->origin = 99999;
        $zc1->cnt = 99999;
        $zc1->nickname = '6孙六六6';
        $zc1->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/03/19/d3515486d4a4155a591568eaec91e9dc.jpg';
        $zc1->profile = '';
        $zc1->originInfo = $zc2;
        $zc1->trueName = $zcName;
        $zc1->trueCnt = $zcCnt;
        array_push($zcArr, $zc1);

        $zc3 = new PhotoIndexModel();
        $zc3->id = 99999;
        $zc3->uid = 99999;
        $zc3->module = PhotoChild::PHOTO_ZC;
        $zc3->type = 1;
        $zc3->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/329c484f4614144019ccaf27d7224b8c.jpg-t1080';
        $zc3->picInfo = '';
        $zc3->created_at = '';
        $zc3->updated_at = '';
        $zc3->label = '美不美，看大腿';
        $zc3->origin = 99999;
        $zc3->cnt = 99999;
        $zc3->nickname = '江南BoyNam';
        $zc3->headicon = 'http://img08.oneniceapp.com/upload/avatar/2016/03/26/5c1e88462c8367785a9957eb4da0ef2c.jpg';
        $zc3->profile = '';
        $zc4 = new PhotoIndexModel();
        $zc4->id = 99999;
        $zc4->uid = 99999;
        $zc4->module = PhotoChild::PHOTO_ZC;
        $zc4->type = 1;
        $zc4->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/465f7bfda2d617748c74313dc61c51b8.jpg-t1080';
        $zc4->picInfo = '';
        $zc4->created_at = '';
        $zc4->updated_at = '';
        $zc4->label = '你的腿毛露出来了';
        $zc4->origin = 99999;
        $zc4->cnt = 99999;
        $zc4->nickname = '6孙六六6';
        $zc4->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/03/19/d3515486d4a4155a591568eaec91e9dc.jpg';
        $zc4->profile = '';
        $zc4->originInfo = $zc3;
        array_push($zcArr, $zc4);

        $mxArr = [];
        $mx2 = new PhotoIndexModel();
        $mx2->id = 99999;
        $mx2->uid = 99999;
        $mx2->module = PhotoChild::PHOTO_MX;
        $mx2->type = 1;
        $mx2->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/1806ea1d1509c143980db86e4a294095.jpg-t1080';
        $mx2->picInfo = '';
        $mx2->created_at = '';
        $mx2->updated_at = '';
        $mx2->label = '这是我爱的形状';
        $mx2->origin = 99999;
        $mx2->cnt = 99999;
        $mx2->nickname = 'Changledick长乐的';
        $mx2->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/05/27/969ddaa082303824fb4809c75818377f.jpg';
        $mx2->profile = '';
        $mx1 = new PhotoIndexModel();
        $mx1->id = 99999;
        $mx1->uid = 99999;
        $mx1->module = PhotoChild::PHOTO_MX;
        $mx1->type = 1;
        $mx1->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/a103d57b21d1c98e4291a09c4bb8f008.jpg-t1080';
        $mx1->picInfo = '';
        $mx1->created_at = '';
        $mx1->updated_at = '';
        $mx1->label = '这是我要弹你脑门的形状';
        $mx1->origin = 99999;
        $mx1->cnt = 99999;
        $mx1->nickname = '王露茜LucyW';
        $mx1->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/07/20/c5a152a3465a93cea384f15367b27991.jpg';
        $mx1->profile = '';
        $mx1->originInfo = $mx2;
        $mx1->trueName = $mxName;
        $mx1->trueCnt = $mxCnt;
        array_push($mxArr, $mx1);

        $mx3 = new PhotoIndexModel();
        $mx3->id = 99999;
        $mx3->uid = 99999;
        $mx3->module = PhotoChild::PHOTO_MX;
        $mx3->type = 1;
        $mx3->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/b7c85c27c547db740a16b14ff3bb3739.jpg-t1080';
        $mx3->picInfo = '';
        $mx3->created_at = '';
        $mx3->updated_at = '';
        $mx3->label = '这是我爱的形状';
        $mx3->origin = 99999;
        $mx3->cnt = 99999;
        $mx3->nickname = 'Changledick长乐的';
        $mx3->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/05/27/969ddaa082303824fb4809c75818377f.jpg';
        $mx3->profile = '';

        $mx4 = new PhotoIndexModel();
        $mx4->id = 99999;
        $mx4->uid = 99999;
        $mx4->module = PhotoChild::PHOTO_MX;
        $mx4->type = 1;
        $mx4->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/765cae758214c4b0b802c116c66a48cc.jpg-t1080';
        $mx4->picInfo = '';
        $mx4->created_at = '';
        $mx4->updated_at = '';
        $mx4->label = '这是我要弹你脑门的形状';
        $mx4->origin = 99999;
        $mx4->cnt = 99999;
        $mx4->nickname = '丁丁丁timo';
        $mx4->headicon = 'http://img08.oneniceapp.com/upload/avatar/2016/01/16/9867580490307229034752275fd808f7.jpg';
        $mx4->profile = '';
        $mx4->originInfo = $mx3;
        array_push($mxArr, $mx4);



        $chArr = [];
        $ch2 = new PhotoIndexModel();
        $ch2->id = 99999;
        $ch2->uid = 99999;
        $ch2->module = PhotoChild::PHOTO_CH;
        $ch2->type = 1;
        $ch2->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/aec1b262a46eb94929c407edc1b5eca6.jpg-t1080';
        $ch2->picInfo = '';
        $ch2->created_at = '';
        $ch2->updated_at = '';
        $ch2->label = '爱我的请举手';
        $ch2->origin = 99999;
        $ch2->cnt = 99999;
        $ch2->nickname = 'JungSukin';
        $ch2->headicon = 'http://img08.oneniceapp.com/upload/avatar/2016/12/31/0aa35471eb2f26aa569160212e37fd95.jpg';
        $ch2->profile = '';
        $ch1 = new PhotoIndexModel();
        $ch1->id = 99999;
        $ch1->uid = 99999;
        $ch1->module = PhotoChild::PHOTO_CH;
        $ch1->type = 1;
        $ch1->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/13088ef13d315c85c1863f611ac1e724.jpg-t1080';
        $ch1->picInfo = '';
        $ch1->created_at = '';
        $ch1->updated_at = '';
        $ch1->label = '服务员，买单~';
        $ch1->origin = 99999;
        $ch1->cnt = 99999;
        $ch1->nickname = 'lucizi';
        $ch1->headicon = 'http://img08.oneniceapp.com/upload/avatar/2015/03/14/abe2fdab96aad4b51384937e0839cb6c.jpg';
        $ch1->profile = '';
        $ch1->originInfo = $ch2;
        $ch1->trueName = $chName;
        $ch1->trueCnt = $chCnt;
        array_push($chArr, $ch1);

        $ch3 = new PhotoIndexModel();
        $ch3->id = 99999;
        $ch3->uid = 99999;
        $ch3->module = PhotoChild::PHOTO_CH;
        $ch3->type = 1;
        $ch3->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/1ae44131c490428a3dd33fddf97013c4.jpg-t1080';
        $ch3->picInfo = '';
        $ch3->created_at = '';
        $ch3->updated_at = '';
        $ch3->label = '爱我的请举手';
        $ch3->origin = 99999;
        $ch3->cnt = 99999;
        $ch3->nickname = 'JungSukin';
        $ch3->headicon = 'http://img08.oneniceapp.com/upload/avatar/2016/12/31/0aa35471eb2f26aa569160212e37fd95.jpg';
        $ch3->profile = '';

        $ch4 = new PhotoIndexModel();
        $ch4->id = 99999;
        $ch4->uid = 99999;
        $ch4->module = PhotoChild::PHOTO_CH;
        $ch4->type = 1;
        $ch4->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/aeac7c949d24a4a7e101349e254dd441.jpg-t1080';
        $ch4->picInfo = '';
        $ch4->created_at = '';
        $ch4->updated_at = '';
        $ch4->label = '服务员，买单~';
        $ch4->origin = 99999;
        $ch4->cnt = 99999;
        $ch4->nickname = '施沛岑carol';
        $ch4->headicon = 'http://img08.oneniceapp.com/upload/avatar/sina/2014/02/14/350781_1402812361.jpg';
        $ch4->profile = '';
        $ch4->originInfo = $ch3;
        array_push($chArr, $ch4);

        $bsArr = [];
        $bs2 = new PhotoIndexModel();
        $bs2->id = 99999;
        $bs2->uid = 99999;
        $bs2->module = PhotoChild::PHOTO_BS;
        $bs2->type = 1;
        $bs2->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/b719066e6f070827742007d8de1aa1a8.jpg-t1080';
        $bs2->picInfo = '';
        $bs2->created_at = '';
        $bs2->updated_at = '';
        $bs2->label = '高难度花式秀恩爱';
        $bs2->origin = 99999;
        $bs2->cnt = 99999;
        $bs2->nickname = '叶河林';
        $bs2->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/08/30/46eb6a64c95b674e499adea1ae3601f0.jpg';
        $bs2->profile = '';
        $bs1 = new PhotoIndexModel();
        $bs1->id = 99999;
        $bs1->uid = 99999;
        $bs1->module = PhotoChild::PHOTO_BS;
        $bs1->type = 1;
        $bs1->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/0e9ff0f93ec6273ce8c2c0ac9ffabc5c.jpg-t1080';
        $bs1->picInfo = '';
        $bs1->created_at = '';
        $bs1->updated_at = '';
        $bs1->label = '秀恩爱得看你的腰力噢';
        $bs1->origin = 99999;
        $bs1->cnt = 99999;
        $bs1->nickname = '李舒雯WENDY';
        $bs1->headicon = 'http://img08.oneniceapp.com/upload/avatar/2015/08/08/2bc83f4f32932eab5fd92707e58b082b.jpg';
        $bs1->profile = '';
        $bs1->originInfo = $bs2;

        $bs1->trueName = $bsName;
        $bs1->trueCnt = $bsCnt;
        array_push($bsArr, $bs1);

        $bs3 = new PhotoIndexModel();
        $bs3->id = 99999;
        $bs3->uid = 99999;
        $bs3->module = PhotoChild::PHOTO_BS;
        $bs3->type = 1;
        $bs3->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/2f7b6943dad87d605affc58fc5722e5b.jpg-t1080';
        $bs3->picInfo = '';
        $bs3->created_at = '';
        $bs3->updated_at = '';
        $bs3->label = '高难度花式秀恩爱';
        $bs3->origin = 99999;
        $bs3->cnt = 99999;
        $bs3->nickname = '叶河林';
        $bs3->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/08/30/46eb6a64c95b674e499adea1ae3601f0.jpg';
        $bs3->profile = '';

        $bs4 = new PhotoIndexModel();
        $bs4->id = 99999;
        $bs4->uid = 99999;
        $bs4->module = PhotoChild::PHOTO_BS;
        $bs4->type = 1;
        $bs4->path = 'http://img08.oneniceapp.com/upload/show/2017/09/21/b92c958f558a3709a238217c441bf204.jpg-t1080';
        $bs4->picInfo = '';
        $bs4->created_at = '';
        $bs4->updated_at = '';
        $bs4->label = '秀恩爱得看你的腰力噢';
        $bs4->origin = 99999;
        $bs4->cnt = 99999;
        $bs4->nickname = '申珊申珊';
        $bs4->headicon = 'http://img08.oneniceapp.com/upload/avatar/2017/09/02/71dca730b1e1205e69c557bec62de1fd.jpg';
        $bs4->profile = '';
        $bs4->originInfo = $bs3;
        array_push($bsArr, $bs4);
        return [PhotoChild::PHOTO_ZC => $zcArr, PhotoChild::PHOTO_MX => $mxArr, PhotoChild::PHOTO_BS => $bsArr, PhotoChild::PHOTO_CH => $chArr];
    }

    public function getListSortByNew($module, $child, $order, $count, $pagesize)
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
        if ($module == Module::PHOTO_MODULE) {
            $where .= ' and t1.type = 1';
        }
        if ($module == Module::VIDEO_MODULE) {
            $q = ' ,t4.question as qname';
            $left = ' left join yh_question t4 on t4.id = t1.qid';
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.headicon,t3.profile " . $q . "
                FROM
                    $table t1
                LEFT JOIN (
                    SELECT
                        `module`,
                        `child`,
                        target_id,
                        count(*) AS cnt
                    FROM
                        yh_like
                    WHERE
                        `module` = $module" . $likeWhere . "
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id 
                left join yh_users t3 on t3.id = t1.uid" . $left . $where . "
                ORDER BY
                    t1.id $order limit $pagesize offset $count";
        $data = \DB::select($sql);
        if ($module == Module::PHOTO_MODULE) {
            return $this->formatOriginForImageList($data);
        }
        return $data;
    }

    public function getListSortByLike($module, $child = 1, $order = 'desc', $count, $pagesize)
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
        if ($module == Module::PHOTO_MODULE) {
            $where .= ' and t1.type = 1';
        }

        if ($module == Module::VIDEO_MODULE) {
            $q = ' ,t4.question as qname';
            $left = ' left join yh_question t4 on t4.id = t1.qid';
        }
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.headicon,t3.profile " . $q . "
                FROM
                    $table t1
                LEFT JOIN (
                    SELECT
                        `module`,
                        `child`,
                        target_id,
                        count(*) AS cnt
                    FROM
                        yh_like
                    WHERE
                        `module` = $module" . $likeWhere . "
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id 
                left join yh_users t3 on t3.id = t1.uid" . $left . $where . "
                ORDER BY
                    t2.cnt $order limit $pagesize offset $count";
        $data = \DB::select($sql);
        if ($module == Module::PHOTO_MODULE) {
            return $this->formatOriginForImageList($data);
        }
        return $data;
    }

    public function getImageListSortByModule($order = 'desc')
    {
        $table = 'yh_image';
        $module = Module::PHOTO_MODULE;
        $sql = "SELECT
                    t1.*, IFNULL(t2.cnt, 0) AS cnt,t3.nickname,t3.headicon,t3.profile
                FROM
                    $table t1
                LEFT JOIN (
                    SELECT
                        `module`,
                        `child`,
                        target_id,
                        count(*) AS cnt
                    FROM
                        yh_like
                    WHERE
                        `module` = $module
                    GROUP BY
                        target_id
                ) t2 ON t1.id = t2.target_id 
                left join yh_users t3 on t3.id = t1.uid
                where t1.type = 1
                ORDER BY
                    t2.cnt $order";
        $data = \DB::select($sql);
        $data = $this->formatOriginForImageList($data);
        $newArr = [];
        foreach ($data as $item) {
            if (array_key_exists($item->module, $newArr)) {
                if (count($newArr[$item->module]) < 2) {
                    array_push($newArr[$item->module], $item);
                }
                continue;
            } else {
                $newArr[$item->module] = [$item];
            }
        }
        return $newArr;
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
            $where .= " and created_at >= $this->startTimestamp and created_at <= $this->endTimestamp";
            $sql = "SELECT
                            COUNT(*) AS cnt,
                            target_id
                        FROM
                            yh_like" . $where . "
                        GROUP BY
                            target_id
                        having cnt >= 5";
            $likes = \DB::select($sql);
            $canLike = collect($likes)->keyBy('target_id')->all();
        }
        foreach ($data as $item) {
            $key = $item->id;
            if (array_key_exists($key, $canLike)) {
                $item->canLike = 0;
            } else {
                $item->canLike = 1;
            }
        }
        return $data;
    }

    public function formatOriginForImageList($data)
    {
        $ids = array_column($data, 'origin');
        $origins = ImageModel::whereIn('id', $ids)->get()->keyBy('id')->toArray();
        foreach ($data as $item) {
            if (array_key_exists($item->origin, $origins)) {
                $item->originInfo = $origins[$item->origin];
            } else {
                $item->originInfo = [];
            }
        }
        return $data;
    }
}