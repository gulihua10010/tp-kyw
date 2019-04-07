<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 14:20
 */

namespace app\common\model;


use think\Model;

class Course  extends  Model
{    protected $insert = ['time'];

    protected function setTimeAttr()
    {
        return time();
    }


}