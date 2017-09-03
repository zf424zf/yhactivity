<?php
/**
 * Created by PhpStorm.
 * User: 70427
 * Date: 2017/9/3
 * Time: 9:44
 */

namespace App\Http\Models;



class LuckyModel extends BaseModel
{
    public $table = 'lucky';

    public $appends = ['sectionName','nameArr'];
    public $sections ;

    public function __construct(array $attributes = [])
    {
        $this->sections = SectionModel::pluck('name','id');
        parent::__construct($attributes);
    }

    public function getSectionNameAttribute(){
        return array_get($this->sections,$this->section);
    }

    public function getNameArrAttribute(){
        return explode(';',$this->names);
    }
}