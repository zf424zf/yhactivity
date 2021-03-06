<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/17
 * Time: 11:22
 */

namespace App\Http\Service;


use App\Http\Api\Module;
use App\Http\Models\LikeModel;
use App\Http\Models\QuestionModel;
use App\Http\Models\SelfVideoModel;
use App\Http\Models\UserModel;
use App\Http\Models\VideoModel;
use Carbon\Carbon;

class Video
{

    public function add($uid, $niceUid, $module, $path, $info, $qid, $cover)
    {
        if (!empty($niceUid)) {
            $user = UserModel::where('uid', $niceUid)->first();
            if ($user) {
                $uid = $user->id;
            }else{
                $name = \Request::get('name');
                $avatar = \Request::get('avatar');
                $user = new UserModel();
                $user->uid = $niceUid;
                $user->nickname=$name;
                $user->headicon = $avatar;
                $user->save();
                $uid = $user->id;
            }
        }
        $info = is_array($info) ? implode(',', $info) : $info;
        $model = new VideoModel();
        $model->uid = $uid;
        $model->module = $module;
        $model->path = $path;
        $model->videoinfo = $info;
        $model->qid = $qid;
        $model->cover = $cover;
        $model->save();
        return $model->toArray();
    }

    public function info($id, $uid)
    {
        $canLike = 0;
        $data = VideoModel::where('id', $id)->with(['users', 'question'])->first();
        if (!$data) {
            api_exception(Service::VIDEO_NOT_FOUND);
        }
        if (!empty($uid)) {
            $like = new Like();
            $likeCount = $like->userLikeCount($uid, Module::VIDEO_MODULE, $id);
            if ($likeCount < 5) {
                $canLike = 1;
            }
        }
        $data->canLike = $canLike;
        return $data;
    }

    public function question($module = '')
    {
        $model =  QuestionModel::orderBy('id');
        if(!empty($module)){
            return $model->where('module',$module)->get();
        }
        return $model->get();
    }

    public function questionDetail($id)
    {

        return QuestionModel::where('id', $id)->first();
    }

    public function indexList($id = ''){
        $model = SelfVideoModel::orderBy('order','asc');
        if(!empty($id)){
            $model->where('order',$id);
        }
        return $model->get()->toArray();
    }
}