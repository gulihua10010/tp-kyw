<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 14:57
 */

namespace app\admin\controller;

use app\common\model\ResourceType as ResourceTypeModel;
use app\common\controller\AdminBase;
use app\common\model\Resource as ResourceModel;
class ResourceType extends  AdminBase
{
    protected  $resource ;
    protected  $type ;
    protected  $types;
    public  function  _initialize()
    {
        parent::_initialize();

        $this->type=new ResourceTypeModel();
        $this->resource=new ResourceModel();
       $this->types=$this->type->getlist();
        $this->assign('types',$this->types);
    }

    public  function  add(){

        return $this->fetch('add');

    }
    public function  save(){
    if ($this->request->isPost()){
        $data=$this->request->post();
        $validate_result = $this->validate($data, 'CourseType');
        if ($validate_result !== true) {
            $this->error($validate_result);
        } else {
            if ($this->type->allowField(true)->save($data) !== false) {
                return json(array('code' => 200, 'msg' => '保存成功'));
            } else {
                return json(array('code' => 0, 'msg' => '保存失败'));
            }
        }
    }

   }

    /**70     35
     *  1 0
     * 2 1
     * 3 2
     * 2 3
     * @param $id
     * @return mixed
     */
    public  function  edit($id){

        $type=$this->type->find($id);
        $child=$this->type->getchildid( $id);
        static $ts=array();
        foreach ($this->types as $k=>$v){
            if (in_array($v['id'],$child)===true){
                $v['ischild']=1;
            }else{
                $v['ischild']=0;
            }
            $ts[]=$v;
        }
        $this->assign('type',$type);
        $this->assign('ts',$ts);

        return $this->fetch('edit');

    }
//,$data['id']
    public  function  update($id){
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validate_result = $this->validate($data, 'CourseType');
            if ($validate_result !== true) {
                $this->error($validate_result);
            } else{
                $child=$this->type->getchildid(  $id);
                if (!empty($child)&&in_array($data['pid'],$child)) {
                    return json(array('code' => 0, 'msg' => '不能移动到自己的子分类!'));
                }else{
                    if ($this->type->allowField(true)->save($data,$id) !== false) {
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
        $type = $this->type->where(['pid' => $id])->find();
        $cresource  = $this->resource->where(['tid' => $id])->find();

        if (!empty($type)) {
            return json(array('code' => 0, 'msg' => '此分类下存在子分类，不可删除'));
        }
        if (!empty($cresource)) {
            return json(array('code' => 0, 'msg' => '此分类下存在资源，不可删除'));
        }
        if ($this->type->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
            //   $this->success('删除成功');
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
            //   $this->error('删除失败');
        }
    }
}