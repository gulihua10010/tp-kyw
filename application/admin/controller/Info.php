<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 14:57
 */

namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\controller\AdminBase;
use app\common\model\Info as InfoModel;
class Info extends  AdminBase
{
    protected  $info;
    protected  $artilce;
    public  function  _initialize()
    {
        parent::_initialize();

        $this->info=new InfoModel();
        $this->artilce=new ArticleModel();
    }
    public  function  add(){

        return $this->fetch('add');

    }
    public function  save(){
    if ($this->request->isPost()){
        $data=$this->request->post();
        $validate_result = $this->validate($data, 'info');
        if ($validate_result !== true) {
            $this->error($validate_result);
        } else {
            if ($this->info->allowField(true)->save($data) !== false) {
                return json(array('code' => 200, 'msg' => '保存成功'));
            } else {
                return json(array('code' => 0, 'msg' => '保存失败'));
            }
        }
    }

   }

    public  function  edit($id){

        $info=$this->info->find($id);

        return $this->fetch('edit',['info'=>$info]);

    }
//,$data['id']  cons
    public  function  update($id){
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validate_result = $this->validate($data, 'info');
            if ($validate_result !== true) {
                $this->error($validate_result);
            } else{
                    if ($this->info->allowField(true)->save($data,$id) !== false) {
                        return json(array('code' => 200, 'msg' => '更新成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '更新失败'));
                    }

            }
        }


    }

    public function delete($id)
    {
        $info = $this->info->where(['pid' => $id])->find();
        $article = $this->artilce->where(['infoid' => $id])->find();

        if (!empty($article)) {
            return json(array('code' => 0, 'msg' => '此分类下存在文章，不可删除'));
        }
        if ($this->info->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
            //   $this->success('删除成功');
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
            //   $this->error('删除失败');
        }
    }
}