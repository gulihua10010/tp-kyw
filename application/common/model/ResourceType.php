<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 15:00
 */

namespace app\common\model;


use think\Model;

class ResourceType extends Model
{

    protected $insert = ['time'];
    public function getlist()
    {
        return $this->catetree();

    }
    public function catetree()
    {
        $tptc = $this->order('id ASC')->select();

        return $this->sort($tptc);
    }
    public function sort($data, $tid = 0, $level = 1)
    {
        static $arr = array();

        foreach ($data as $v) {

            if ($v['pid'] == $tid) {


                $v['level'] = $level;
                $arr[] = $v;
                $this->sort($data, $v['id'], $level + 1);
            }
        }

        return $arr;
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
    protected function setTimeAttr()
    {
        return time();
    }

}