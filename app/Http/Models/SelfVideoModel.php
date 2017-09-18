<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/17
 * Time: 22:06
 */

namespace App\Http\Models;


use App\Http\Api\VideoChild;

class SelfVideoModel extends BaseModel
{
    protected $table = 'self_video';

    protected $appends = ['moduleCN'];

    public $moduleArr = [VideoChild::VIDEO_SS => '时尚', VideoChild::VIDEO_LX => '旅行',
        VideoChild::VIDEO_MZ => '美妆', VideoChild::VIDEO_NS => '美食'];

    public function getModuleCNAttribute()
    {
        return array_get($this->moduleArr, $this->module);
    }
}