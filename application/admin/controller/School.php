<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/28
 * Time: 17:29
 */

namespace app\admin\controller;

use app\common\model\School as schoolModel;
use app\common\model\Magor as MagorModel;
use app\common\controller\AdminBase;
use think\Db;

class School extends  AdminBase
{
    protected  $school;
    protected  $prop;
    protected  $belong;
    protected  $type;
    protected  $magor;
    protected function _initialize()
    {
        parent::_initialize();
        $this->school=new schoolModel();
        $this->magor=new MagorModel();

        $this->prop=Db::name('school_prop')->select();
        $this->type=Db::name('school_type')->select();
        $this->belong=Db::name('school_belong')->select();

        $province=Db::name('province')->select();

        $this->assign('prop',  $this->prop);
        $this->assign('type', $this->type);
        $this->assign('belong', $this->belong);
        $this->assign('province',$province);

    }
   public function  index($keyword='',$page=1){
       $map = [];
       if ($keyword) {
           session('schoolkeyword', $keyword);
           $map['s.name'] = ['like', "%{$keyword}%"];
       }else{
           if(session('schoolkeyword')!=''&&$page>1){
               $map['s.name']  = ['like', "%".session('schoolkeyword')."%"];
           }else{
               session('schoolkeyword',null);
           }
       }

       $schools=$this->school-> alias('s')->join('province prov','s.proid=prov.id')  ->field('s.*,prov.name as provinceName,prov.id as proid')
           ->order('prov.id asc,s.id') ->where($map)->paginate(10);
       $this->assign('schools',$schools);
        return $this->fetch();
    }
    function add(){
        return $this->fetch('add');
    }


    public  function  save(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
//            console_log($data)
            $validate_result=$this->validate($data,'school');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                $data['info']=htmlspecialchars_decode($data['info']);
                if ($this->school->allowField(true)->save($data)){
                    Db::name('schoolandmagor')->where('sid',-1)->setField('sid',$this->school->id);

                    return json(array('code' => 200, 'msg' => '添加成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

        }

    }

    public  function  magor($sid){

        $magors=$this->magor->whereNotIn('pid',[0])->select();

        $arr= Db::name('schoolandmagor')->alias('s')->join('magor m','m.id=s.mid')->where('s.sid',$sid)
            ->field('s.*, m.name as mname')->select();

        $this->assign('sid',$sid);
        $this->assign('magors',$magors);
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public  function savemargors(){
        if ($this->request->isPost()){
            $data=$this->request->post();
            $insert1=array();

            Db::startTrans();
            $isF = true;
            try {
                Db::name('schoolandmagor')->where('sid',$data['sid'])->delete();
          foreach($data as $key=>$datum){
              $m=preg_match_all('/magors-/is',$key,$mat1);
              $yx=preg_match_all('/yx-/is',$key,$mat2);
                  if ($m!=false||$m>0){
                      $insert1['sid']=$data['sid'];
                      $insert1['mid']=$datum;
                  }
                   if ($yx!=false||$yx>0){
                        $insert1['colllege']=$datum;
                        Db::name('schoolandmagor')->insert($insert1);
                        $insert1=array();
                   }
          }
                Db::commit();
            } catch (\Exception $e) {
                $isF = false;
                Db::rollback();
            }
                $arr= Db::name('schoolandmagor')->alias('s')->join('magor m','m.id=s.mid')->where('s.sid',$data['sid'])
                      ->field('s.*, m.name as mname')->select();
            if ($isF) {
                //$this->success('提交成功');
                return json(array('code' => 200, 'msg' => '提交成功','data'=>$arr));
            } else {
                // $this->error('提交失败');
                return json(array('code' => 0, 'msg' => '提交失败'));
            }

        }
        return json(array('code' => 0, 'msg' => '提交失败'));


    }
    public  function  update(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
//            console_log($data)
            $validate_result=$this->validate($data,'school');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                $data['info']=htmlspecialchars_decode($data['info']);
                if ($this->school->allowField(true)->save($data,$data['id'])){
                    return json(array('code' => 200, 'msg' => '更新成功'));

                } else {
                    return json(array('code' => 200, 'msg' => '更新成功'));

                }
            }

        }

    }
    /**
     * {"id":2,"name":"211工程"}en
    20.html:1 {"id":3,"name":"985工程"}
    20.html:1 {"id":4,"name":"34所自划线院校"}
     *
     * @param $id
     * @return mixed
     */

    public function edit($id)
    {
        $school  = $this->school->find($id);
         $propv=explode(',',$school['prop']);
        $typev=explode(',',$school['type']);
        $belongv=explode(',',$school['belong']);
        $p='';$t='';$b='';
        foreach ($propv as $item) {
            if ($item != '') {
                $pp = searchArray('name', 'id', $item, $this->prop);
                if ($pp != false) {
                    $p = $p . ',' . $pp;
                }
            }
        }

        foreach ($typev as $item) {
            if ($item!=''){

                $tt= searchArray('name','id',$item,$this->type);
                if ($tt!=false){
                   $t=$t.','.$tt;
                }
            }
        }

        foreach ($belongv as $item) {
            if ($item!=''){

                $bb= searchArray('name','id',$item,$this->belong);
                if ($bb!=false){
                    $b=$b.','.$bb;
                }
            }
        }
        $m= Db::name('schoolandmagor')->alias('s')->join('magor m','m.id=s.mid')->where('s.sid',$id)
            ->field('s.*, m.name as mname')->select();

        $p=substr($p,1,strlen($p));
        $t=substr($t,1,strlen($t));
        $b=substr($b,1,strlen($b));
        $school['prop']=$p;
        $school['type']=$t;
        $school['belong']=$b;
//        $school['info']=formatHTML($school['info']);
        $this->assign('m',$m);
        return $this->fetch('edit', ['school' => $school]);
    }
    public function delete($id)
    {

        if ($this->school->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }

}