<?php
namespace app\admin\controller;

use app\common\model\User as UserModel;
use app\common\controller\AdminBase;
use think\Config;
use think\Db;

/**
 * 管理员管理
 * Class AdminUser
 * @package app\admin\controller
 */
class AdminUser extends AdminBase
{
    protected $admin_user_model;
    protected function _initialize()
    {
        parent::_initialize();
        $this->admin_user_model        = new  UserModel();
    }

    /**
     * 管理员管理
     * @return mixed
     */
    public function index()
    {
        $admin_user_list = $this->admin_user_model->where('isadmin',1)->paginate(10);

        return $this->fetch('index', ['admin_user_list' => $admin_user_list]);
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add()
    {

        return $this->fetch('add');
    }

    /**
     * 保存管理员
     * @param $group_id
     */
    public function save()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'AdminUser');

            if ($validate_result !== true) {
              //  $this->error($validate_result);
                return json(array('code' => 0, 'msg' => $validate_result));
            } else {
                
            	$data['salt'] = generate_password(18);
            	$data['password'] = md5($data['password'] .$data['salt']);
            	$data['isadmin']=1;
                
                if ($this->admin_user_model->allowField(true)->save($data)) {
                    
                    return json(array('code' => 200, 'msg' => '添加成功'));
                   // $this->success('保存成功');
                } else {
                	return json(array('code' => 0, 'msg' => '添加失败'));
                  //  $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑管理员
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $admin_user             = $this->admin_user_model->find($id);

        return $this->fetch('edit', ['admin_user' => $admin_user]);
    }

    /**
     * 更新管理员
     * @param $id
     * @param $group_id
     */
    public function update($id)
    {
        if ($this->request->isPost()) {
            $data            = $this->request->param();
            $validate_result = $this->validate($data, 'AdminUser');

            if ($validate_result !== true) {
               // $this->error($validate_result);
                return json(array('code' => 0, 'msg' =>$validate_result));
            } else {
            	
            	if($id==1&&$data['status']==0){
            		return json(array('code' => 0, 'msg' =>'默认管理员不能禁用'));
            	}else{
            		$admin_user = $this->admin_user_model->find($id);
            		
            		$admin_user->id       = $id;
            		$admin_user->username = $data['username'];
            		$admin_user->status   = $data['status'];
            		
            		if (!empty($data['password']) && !empty($data['confirm_password'])) {
            			$admin_user->password = md5($data['password'] . $admin_user['salt']);
            		}
            		if ($admin_user->save() !== false) {
            			//$this->success('更新成功');
            			return json(array('code' => 200, 'msg' => '更新成功'));
            		} else {
            			//  $this->error('更新失败');
            			return json(array('code' => 0, 'msg' => '更新失败'));
            		}
            	}
            	
            	

            }
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id)
    {
        if ($id == 1) {
           // $this->error('默认管理员不可删除');
            return json(array('code' => 0, 'msg' => '默认管理员不可删除'));
        }
        if ($this->admin_user_model->destroy($id)) {
           // $this->success('删除成功');
            return json(array('code' => 200, 'msg' => '删除成功'));
            
        } else {
          //  $this->error('删除失败');
            return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }
}