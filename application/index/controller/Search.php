<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/25
 * Time: 19:32
 */

namespace app\index\controller;


use app\common\controller\HomeBase;
use think\Db;

class Search extends  HomeBase
{
    protected function _initialize()
    {
        parent::_initialize();
    }

    function  index(){
        $right_c=Db::name('course')->where('show',1)->order('time','desc')->limit(1,10)->select();
        $right_a=Db::name('article')->where('show',1)->order('time','desc')->limit(1,10)->select();
        $right_r=Db::name('resource')->where('show',1)->order('time','desc')->limit(1,10)->select();
        $this->assign('right_c',$right_c);
        $this->assign('right_a',$right_a);
        $this->assign('right_r',$right_r);
        return $this->fetch();
    }

}