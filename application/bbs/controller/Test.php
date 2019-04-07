<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/7
 * Time: 18:08
 */

namespace app\bbs\controller;


use think\Controller;

class Test extends  Controller
{
    public  function  index(){
        return $this->fetch();
    }

}