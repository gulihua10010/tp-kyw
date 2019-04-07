<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/19
 * Time: 21:57
 */

namespace app\common\model;

use think\Model;

class CourseAsk extends Model
{

    function add($data){
        $result = $this->isUpdate(false)->allowField(true)->save($data);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    function edit($data){
        $result = $this->isUpdate(true)->allowField(true)->save($data);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    protected $insert = ['time'];

    protected function setTimeAttr()
    {
        return time();
    }
}