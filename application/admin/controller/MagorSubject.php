<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/2
 * Time: 14:25
 */

namespace app\admin\controller;


use app\common\model\MagorSubject as SubjectModel;
use app\common\controller\AdminBase;
use think\Db;

class MagorSubject  extends AdminBase
{

    protected  $subject;
    protected  $subslist;
    protected  $arr=array();
    protected function _initialize()
    {
        parent::_initialize();
        $this->subject=new SubjectModel();
    }


    public  function add(){
        return $this->fetch('add');
    }

    public  function  save(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
//            console_log($data)
            $validate_result=$this->validate($data,'magorSubject');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                if ($this->subject->allowField(true)->save($data)){
                    return json(array('code' => 200, 'msg' => '添加成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

        }

    }
    public function edit($id)
    {
        $sub  = $this->subject->find($id);
        $this->assign('sub',$sub);
        return $this->fetch('edit', ['sub' => $sub]);
    }
    public  function  update(){
        if ($this->request->isPost()){
            $data=json_decode($_POST['data'],true);
            $id=$data['id'];
//            console_log($data)
            $validate_result=$this->validate($data,'magorSubject');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{

                    if ($this->subject->allowField(true)->save($data,$id) !== false) {
                        return json(array('code' => 200, 'msg' => '更新成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '更新失败'));
                    }

            }

        }

    }
    public function delete($id)
    {
        $child=$this->subject->getSubMagar($id);
        if (!empty($child) ) {
            return json(array('code' => 0, 'msg' => '此学科下有专业!'));
        }
        if ($this->subject->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
            //   $this->success('删除成功');
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
            //   $this->error('删除失败');
        }
    }







}