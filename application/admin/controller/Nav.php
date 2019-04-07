<?php

namespace app\admin\controller;

use app\common\model\Nav as NavModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * 导航管理
 * Class Nav
 * @package app\admin\controller
 */
class Nav extends AdminBase
{

    protected $nav_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->nav_model = new NavModel();
        $count = $this->nav_model->count();
        // $nav_level_list  = array2level($nav_list);
        $this->assign('count', $count);
    }

    /**
     * 导航管理
     * @return mixed
     */
    public function index()
    {      $nav_count = $this->nav_model->where('type', 1)->where('pid', 0)->count();
        $navs = $this->nav_model->getlist_by_type(1);
//      foreach ($navs as $nav){
//          $count=$this->nav_model->where('type',1)->where('pid',0)->count();
//          console_log($count);

//          console_log($nav['name']);
//          foreach ($nav['child'] as $value){
//              console_log('---'.$value['name']);
//          }
//      }
        $this->assign('nav_count', $nav_count);
        $this->assign('nav_list', $navs);

        return $this->fetch();
    }
//footernav
    public function footernav()
    {      $nav_count = $this->nav_model->where('type', 4)->where('pid', 0)->count();
        $navs = $this->nav_model->getlist_by_type(4);
        $this->assign('nav_count', $nav_count);
        $this->assign('nav_list', $navs);

        return $this->fetch();
    }
    public function infoindex()
    {
        $navs = $this->nav_model->getlist_by_type(2);
       $nav_count = $this->nav_model->where('type', 2)->where('pid', 0)->count();
        $navsbb = $this->nav_model->getlist_by_type(3);
        $nav_countbb = $this->nav_model->where('type', 3)->where('pid', 0)->count();
//      foreach ($navs as $nav){
//          $count=$this->nav_model->where('type',1)->where('pid',0)->count();
//          console_log($count);

//          console_log($nav['name']);
//          foreach ($nav['child'] as $value){
//              console_log('---'.$value['name']);
//          }
//      }
        $this->assign('nav_count', $nav_count);
        $this->assign('nav_list', $navs);

        $this->assign('nav_countbb', $nav_countbb);
        $this->assign('nav_listbb', $navsbb);
        return $this->fetch();
    }
    /**
     * 添加导航
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '',$type)
    {
        $this->assign('pid', $pid);
        $this->assign('type', $type);
        return $this->fetch('add');
    }

    /**
     * 保存导航
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'],true);
            $validate_result = $this->validate($data, 'Nav');
            if ($validate_result !== true) {
                return json(array('code' => 0, 'msg' => $validate_result));
            } else {
                if ($this->nav_model->allowField(true)->save($data)) {
                    return json(array('code' => 200, 'msg' => '添加成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }
        }
    }

    /**
     * 编辑导航
     * @param $id
     * @return mixed
     */
    public function edit($id,$type)
    {
        $nav = $this->nav_model->find($id);
        $navaa = $this->nav_model->where('type', $type)->where('pid', 0)->select();

        $this->assign('navss', $navaa);
        $this->assign('type', $type);
        return $this->fetch('edit', ['nav' => $nav]);
    }

    public function infopptedit($id)
    {
        $nav = $this->nav_model->find($id);
        $navaa = $this->nav_model->where('type', 3)->where('pid', 0)->select();
        $this->assign('navss', $navaa);
        $this->assign('type', 3);
        $this->assign('nav', $nav);
        return $this->fetch('edit' );
    }
    /**
     * 更新导航
     * @param $id
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $validate_result = $this->validate($data, 'Nav');
            $child=$this->nav_model->get_child_byid($data['id'],$data['type']);
            if ($data['oldpid']==0&&$data['pid']!==$data['oldpid']&&!empty($child)){
                $this->nav_model->where('id',$child[0]['id'])->setField('pid',0);
               for ($i=1;$i<sizeof($child);$i++){
                    $this->nav_model->where('id',$child[$i]['id'])->setField('pid',$child[0]['id']);
                }
                
            }
            if ($validate_result !== true) {
                //  $this->error($validate_result);
                return json(array('code' => 0, 'msg' => $validate_result));
            } else {
                if ($this->nav_model->allowField(true)->save($data, $data['id']) !== false) {
                    // $this->success('更新成功');
                    return json(array('code' => 200, 'msg' => '更新成功'));
                } else {
                    // $this->error('更新失败');
                    return json(array('code' => 0, 'msg' => '更新失败'));
                }
            }
        }
    }

    public function sort()
    {

        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'], true);
            $ids = $data['data'];
            $pid = $data['pid'];
//            console_log($count);
            $res = false;
            for ($i = 0; $i < sizeof($ids); $i++) {
                $re = $this->nav_model->where('id', intval($ids[$i]))->setField('sort', $i + 1);
                if ($re == true) {
                    $res = true;
                }
            }
            if ($res) {
                return json(array('code' => 200, 'msg' => '更新成功'));
            } else {
                return json(array('code' => 0, 'msg' => '更新失败'));
            }

        }

    }

    public function updatestatus($id, $status)
    {
        if ($this->request->isGet()) {

            if ($this->nav_model->where('id', $id)->update(['status' => $status]) !== false) {
                //  $this->success('更新成功');
                return json(array('code' => 200, 'msg' => '更新成功'));
            } else {
                // $this->error('更新失败');
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }

    }

    /**
     * 删除导航
     * @param $id
     */
    public function delete($id,$type)
    {
        $child = $this->nav_model->get_child_byid($id, $type);
        if (!empty($child)) {
            return json(array('code' => 0, 'msg' => '菜单中还有子菜单，先删除子菜单'));

        } else {
            if ($this->nav_model->destroy($id)) {
                //$this->success('删除成功');
                return json(array('code' => 200, 'msg' => '删除成功'));
            } else {
                return json(array('code' => 0, 'msg' => '删除失败'));
                // $this->error('删除失败');
            }
        }

    }
}