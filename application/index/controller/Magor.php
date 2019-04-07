<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/25
 * Time: 15:39
 */

namespace app\index\controller;
use think\Db;
use app\common\model\School as SchoolModel;
use app\common\model\Magor as MagorModel;
use app\common\controller\HomeBase;

class Magor extends HomeBase
{
    protected  $school;
    protected  $magor;
    protected function _initialize()
    {
        parent::_initialize();
        $this->school=new SchoolModel();
        $this->magor=new MagorModel();
        $right_s=Db::name('magor')->order('id','asc')->whereNotIn('pid',[0])->limit(1,10)->select();
        $this->assign('right_s',$right_s);

    }
    public  function  index($p=0,$t=0,$page = 1,$keywords=""){
        $map=[];
        if ($keywords=="") {
            if ($p != 0) {
                $map['m.pid'] = ["=", $p];
            }
            if ($t != 0) {
                $map['m.type'] = ["=", $t];
            }
        }else{
            $map['m.name']=["like","%{$keywords}%"];
        }
        $magors=$this->magor->alias('m')->join('magor p','p.id=m.pid')->join('magor_subject ms','ms.id=m.subject')
            -> where($map)
            ->field('m.*,p.name as pname,ms.name as sub') ->paginate(10);
        $pro=$this->magor ->where('pid',0)->select();

        $this->assign('pro',$pro);
        $this->assign('magors',$magors);
        $this->assign('t',$t);
        $this->assign('p',$p);
        return $this->fetch();
    }

    function  detail($id=0 ){
        $magor=$this->magor ->alias('m')->join('magor p','p.id=m.pid')->join('magor_subject ms','ms.id=m.subject')
            ->field('m.*,p.name as pname,ms.name as sub')
            -> where('m.id',$id)->find();
        if ($id==0||empty($magor)){
            return       $this->error('亲！您迷路了！');

        }
        $this->assign('magor',$magor);

        return $this->fetch();
    }
}