<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/2
 * Time: 14:25
 */

namespace app\admin\controller;


use app\common\model\Magor as magorModel;
use app\common\controller\AdminBase;
use app\common\model\MagorSubject as SubjectModel;

use think\Db;

class Magor  extends AdminBase
{

    protected  $magor;
    protected  $magorslist;
    protected  $subject;
    protected  $arr=array();
    protected function _initialize()
    {
        parent::_initialize();
        $this->magor=new magorModel();
        $this->subject=new SubjectModel();

        $subs=$this->subject->select();
        $this->assign('subs', $subs);
            $pm=$this->magor->where('pid',0)->select();
        $this->magorslist=$this->getList([]);
        $this->assign('magorslist', $this->magorslist);
        $this->assign('pm', $pm);
    }
    public function  index($keyword = '', $page = 1){
        $map = [];
        if ($keyword) {
            session('magorkeyword', $keyword);
            $map['m.name'] = ['like', "%{$keyword}%"];
        }else{
            if(session('magorkeyword')!=''&&$page>1){
                $map['m.name']  = ['like', "%".session('magorkeyword')."%"];
            }else{
                session('magorkeyword',null);
            }
        }

        $magors=$this->getList($map) ;
        $sub=$this->subject->select();
        $this->assign('magors',$magors);
        $this->assign('sub',$sub);
    return $this->fetch();
    }

    public  function add(){
        return $this->fetch('add');
    }

    public  function  save(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
//            console_log($data)
            $validate_result=$this->validate($data,'magor');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                $data['info']=htmlspecialchars_decode($data['info']);
                if ($this->magor->allowField(true)->save($data)){
                    return json(array('code' => 200, 'msg' => '添加成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

        }

    }
    public function edit($id)
    {
        $magor  = $this->magor->find($id);
//        $child=$this->magor->getchildid($id);
//        static $ts=array();
//        foreach ( $this->magorslist as $k=>$v){
//            if (in_array($v['id'],$child)===true){
//                $v['ischild']=1;
//            }else{
//                $v['ischild']=0;
//            }
//            $ts[]=$v;
//        }
//        $magor['info']=formatHTML($magor['info']);
        $this->assign('magor',$magor);
//        $this->assign('ts',$ts);
        return $this->fetch('edit', ['school' => $magor]);
    }
    public  function  update(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
            $id=$data['id'];
//            console_log($data)
            $validate_result=$this->validate($data,'magor');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                $child=$this->magor->getchildid($id);
                if (!empty($child)&&in_array($data['pid'],$child)) {
                    return json(array('code' => 0, 'msg' => '不能移动到自己的子分类!'));
                }else{
                    if ($this->magor->allowField(true)->save($data,$id) !== false) {
                        return json(array('code' => 200, 'msg' => '更新成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '更新失败'));
                    }
                }

            }

        }

    }
    public function delete($id)
    {
        $type = $this->magor->where(['pid' => $id])->find();

        if (!empty($type)) {
            return json(array('code' => 0, 'msg' => '此分类下存在子分类，不可删除'));
        }
        if ($this->magor->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
            //   $this->success('删除成功');
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
            //   $this->error('删除失败');
        }
    }







    public  function  getList($map){
//        Db::name('')->field()
        $m = $this-> magor->alias('m')->join('magor m1','m1.id=m.pid')
            ->join('magor_subject s','s.id=m.subject') ->where($map)->whereNotIn('m.pid',[0])->field('m.*,m1.name as pname,s.name as sname')->paginate(10);
        return $m;
    }

    public function catetree($map)
    {
        $tptc = $this-> magor->alias('m')->order('id ASC')->where($map)->select();
        return $this->sort($tptc);
    }
    public function sort($data, $tid = 0, $level = 1)
    {
//        stastzt

        foreach ($data as $v) {

            if ($v['pid'] == $tid) {

                $v['level'] = $level;
                $this->arr[] = $v;
                $this->sort($data, $v['id'], $level + 1);
            }
        }
        if (!isset($this->arr) ){
            $this->arr=[];
        }
        return $this->arr;
    }
}