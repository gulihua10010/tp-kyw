<?php
namespace app\common\model;

use think\Model;

class Nav extends Model
{
   public function  getlist_by_type($type){

        $navs=$this->where('type',$type)->where('pid',0)->order('sort asc')->select();
        return   $this->get_child($navs,$type) ;

    }
    public  function  get_child($navs,$type){
       $list=[];
       foreach ( $navs as $nav){
           $child=$this->where('pid',$nav['id'])->where('type',$type)->order('sort asc')->select();
           $nav['child']=$child;
           $list[]=$nav;
       }
       return $list;
    }
    public  function  get_child_byid($id,$type){
        $child=$this->where('pid',$id)->where('type',$type)->order('sort asc')->select();
        return $child;
    }
}