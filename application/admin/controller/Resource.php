<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/2
 * Time: 14:25
 */

namespace app\admin\controller;


use app\common\model\Resource as ResourceModel;
use app\common\model\ResourceType as ResourceTypeModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * Class Resource资源
 * @package app\admin\controller
 */
class Resource  extends AdminBase
{

    protected  $resource;
    protected  $type;
    protected function _initialize()
    {
        parent::_initialize();
        $this->resource=new ResourceModel();
        $this->type=new ResourceTypeModel();
        $types=$this->type->getlist();
        $this->assign('types',$types);

    }
    public function  index($keyword = '', $page = 1){
        $map = [];
        if ($keyword) {
            session('resourcekeyword', $keyword);
            $map['r.name|r.keywords'] = ['like', "%{$keyword}%"];
        }else{
            if(session('resourcekeyword')!=''&&$page>1){
                $map['r.name|r.keywords']  = ['like', "%".session('resourcekeyword')."%"];
            }else{
                session('resourcekeyword',null);
            }
        }
        $resourcelist=$this->resource-> alias('r')->join('resource_type rt','rt.id=r.tid') ->field('r.*,rt.name as typename') ->order('r.time desc,r.id asc')->where($map)->paginate(10);;
        $this->assign('resource',$resourcelist);
        return $this->fetch();
    }

    public  function add(){
        return $this->fetch('add');
    }



    public  function  save(){
        if ($this->request->isPost()){
            $data=$this->request->post();
            $validate_result=$this->validate($data,'resource');
            if ($validate_result!==true){
                return json(array('code' => 0, 'msg' => $validate_result));
            }else{
                if ($data['point']==''||empty($data['point'])){
                    $point=Db::name('system')->where('name','point_download')->find();
                    $data['point']=$point['value'];
                }
                if ($this->resource->allowField(true)->save($data)){
                    return json(array('code' => 200, 'msg' => '添加成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

        }

    }
    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if ($this->resource->allowField(true)->save($data,$data['id']) !== false) {
                return json(array('code' =>200, 'msg' => '更新成功'));
            } else {
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }
    }


    public function edit($id)
    {
        $resource = $this->resource->find($id);
        return $this->fetch('edit', ['res' => $resource]);
    }
    public function delete($id)
    {

        if ($this->resource->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }




}