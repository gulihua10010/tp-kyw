<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/24
 * Time: 14:08
 */

namespace app\index\controller;

use app\common\model\School as SchoolModel;
use app\common\model\Magor as MagorModel;
use app\common\controller\HomeBase;
use think\Db;

class School extends HomeBase
{
    protected  $school;
    protected  $magor;
    protected function _initialize()
    {
        parent::_initialize();
        $this->school=new SchoolModel();
        $this->magor=new MagorModel();
        $provice=Db::name('province')->select();
        $belong=Db::name('school_belong')->select();
        $prop=Db::name('school_prop')->select();
        $type=Db::name('school_type')->select();
        $right_s=Db::name('school')->order('id','asc')->limit(1,10)->select();
        $this->assign('right_s',$right_s);

        $this->assign('provice',$provice);
        $this->assign('belong',$belong);
        $this->assign('prop',$prop);
        $this->assign('type',$type);


    }
    public  function  index($v=0,$p=0,$b=0,$t=0,$page = 1,$keywords=""){
        $prop=Db::name('school_prop')->where('id',$p)->find();
        $belong=Db::name('school_belong')->where('id',$b)->find();
        $type=Db::name('school_type')->where('id',$t)->find();
        $map=[];
        if ($keywords==""){
            if ($v!=0){
                $map['proid']=["=",$v];
            }
            if($t!=0){
                $map['type']=["like","%{$type['name']}%"];
            }
            if($p!=0){
                $map['prop']=["like","%{$prop['name']}%"];
            }
            if($b!=0){
                $map['belong']=["like","%{$belong['name']}%"];
            }
        }else {
            $map['s.name']=["like","%{$keywords}%"];

        }
        $schools=$this->school->alias('s')->join('province v','v.id=s.proid')
            -> where($map)
            ->field('s.*,v.name as vname') ->paginate(10);

        $this->assign('schools',$schools);
        $this->assign('v',$v);
        $this->assign('p',$p);
        $this->assign('b',$b);
        $this->assign('t',$t);
        return $this->fetch();
    }

    function  detail($id=0,$t=1){
        $school=$this->school -> where('id',$id)->find();
        if (empty($school)){
            return       $this->error('亲！您迷路了！');
        }
        $m1=Db::name('schoolandmagor')->alias('sm')->join('magor m','m.id=sm.mid')
            ->where('sm.sid',$id)
            ->where('m.type',1)
            ->field('sm.colllege as college,m.*')
            ->order('sm.colllege asc')->select();
        $m2=Db::name('schoolandmagor')->alias('sm')->join('magor m','m.id=sm.mid')
            ->where('sm.sid',$id)
            ->where('m.type',2)
            ->field('sm.colllege as college,m.*')
            ->order('sm.colllege asc')->select();
        $this->assign('school',$school);
        $this->assign('t',$t);
        $this->assign('m1',$m1);
        $this->assign('m2',$m2);

        return $this->fetch();
    }
}