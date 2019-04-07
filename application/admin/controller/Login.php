<?php

namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;
/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    protected function _initialize()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->config=Config::get('geetest');
        $this->data= array(
            "user_id" => "user", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "127.0.0.1" # 请在此处传输用户请求验证时所携带的IP
        );

    }

    /**
     * 后台登录
     * @return mixed
     */
    public function index()
    {
        $config = Db::name('system')->select();
        $site_config = [];
        foreach ($config as $value) {
            $site_config[$value['name']] = $value['value'];
        }
        $yzmarr = explode(',', $site_config['site_yzm']);
        if (in_array(4, $yzmarr)) {
            $yzm = 1;
        } else {
            $yzm = 0;
        }
        $this->assign('yzm', $yzm);
        return $this->fetch();
    }


    /**
     * 登录验证
     * @return string
     */
    public function login()
    {
        $config = Db::name('system')->select();
        $site_config = [];
        foreach ($config as $value) {
            $site_config[$value['name']] = $value['value'];

        }
//        $yzmarr = explode(',', $site_config['site_yzm']);
//        if (in_array(4, $yzmarr)) {
//            $yzm = 1;
//        } else {
//            $yzm = 0;
//        }

        if ($this->request->isPost()) {
            $data = $this->request->only(['username', 'password', 'verify']);
            //  $validate_result = $this->validate($data, 'Login');

            $salt = Db::name('user')->where(array('username' => $data['username']))->value('salt');
            $where['username'] = $data['username'];
            $where['password'] = md5($data['password'] . $salt);

            $admin_user = Db::name('user')->field('id,username,status,isadmin')->where($where)->find();
            if (!empty($admin_user)) {
                if ($admin_user['status'] ==0) {
                    //$this->error('当前用户已禁用');
                    return json(array('code' => 0, 'msg' => '当前用户已禁用')) ;
                } else if ($admin_user['isadmin']!==1){
                    return json(array('code' => 0, 'msg' => '当前用户不是管理员！'));

                } else{
                    //Session::set('admintoken', md5($admin_user['id'].$admin_user['username'].$salt));

                    //Session::set('admin_salt', $salt);
                    Session::set('admin_id', $admin_user['id']);
                    Session::set('admin_name', $admin_user['username']);
                    Db::name('user')->update(
                        [
                            'last_login_time' => time(),
                            'last_login_ip' => $this->request->ip(),
                            'id' => $admin_user['id']
                        ]
                    );
                    return json(array('code' => 200, 'msg' => '登录成功'));
                    //  $this->success('登录成功', 'admin/index/index');
                }
            } else {
                return json(array('code' => 0, 'msg' => '用户名或密码错误'));
                //$this->error('用户名或密码错误');
            }
        }
    }

    public function locker()
    {
        $data = $this->request->only(['username', 'password']);
        $salt = Db::name('user')->where(array('username' => $data['username']))->value('salt');
        $where['username'] = $data['username'];
        $where['password'] = md5($data['password'] . $salt);
        $where['isadmin'] =1;
        $admin_user = Db::name('user')->field('id,username,status')->where($where)->find();
        if (!empty($admin_user)) {
            Session::set('admin_id', $admin_user['id']);
            Session::set('admin_name', $admin_user['username']);
            return json(array('code' => 200, 'msg' => '登录成功'));
        } else {
            return json(array('code' => 0, 'msg' => '密码错误或不是管理员'));

        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        // $this->success('退出成功', 'admin/login/index');
        return json(array('code' => 200, 'msg' => '退出成功'));
        //return NULL;
    }
}