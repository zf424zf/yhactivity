<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/8/15
 * Time: 0:10
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $guarded = [];

    /**
     * 指定时间字符
     * @param  DateTime|int $value
     * @return string
     */
    public function fromDateTime($value)
    {
        return strtotime(parent::fromDateTime($value));
    }
}