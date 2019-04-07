<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 15:00
 */

namespace app\common\model;


use think\Model;

class Article extends Model
{

    protected $insert = ['time'];

    protected function setTimeAttr()
    {
        return time();
    }

}