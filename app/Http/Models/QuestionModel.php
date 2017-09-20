<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/18
 * Time: 17:50
 */

namespace App\Http\Models;


use App\Http\Api\VideoChild;

class QuestionModel extends BaseModel
{
    protected $table = 'question';

    public $appends = ['moduleCN'];
    public function getModuleCNAttribute(){
        switch ($this->module){
            case VideoChild::VIDEO_SS:
                return '时尚话题';
            case VideoChild::VIDEO_LX:
                return '旅行话题';
            case VideoChild::VIDEO_MZ:
                return '美妆话题';
            case VideoChild::VIDEO_NS:
                return '美食话题';
            default:
                return '时尚话题';
        }
    }

}