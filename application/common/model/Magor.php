<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/28
 * Time: 16:56
 */

namespace app\common\model;


use think\Model;

class Magor extends  Model
{
    protected $insert = ['time'];

    protected function setTimeAttr()
    {
        return time();
    }

    public function getchildid($cateid)
    {
        $cates = $this->select();
        return $this->_getchildid($cates, $cateid);
    }
    public function _getchildid($cates, $cateid)
    {
        static $arr = array();
        foreach ($cates as $k => $v) {
            if ($v['pid'] == $cateid) {
                $arr[] = $v['id'];
                $this->_getchildid($cates, $v['id']);
            }
        }
        return $arr;
    }


}