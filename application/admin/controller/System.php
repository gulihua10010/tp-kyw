<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Cache;
use think\Db;
use think\Session;

/**
 * 系统配置
 * Class System
 * @package app\admin\controller
 */
class System extends AdminBase
{
    public function _initialize()
    {
        parent::_initialize();

    }

    /**
     * 站点配置
     */
    public function siteConfig()
    {
//        $site_config = unserialize($site_config['value']);

        //  return view('site_config', ['site_config' => $site_config]);

        /*    $site_config['user_reg']=1;
           $site_config['forum_sh']=1;
           $site_config['site_wjt']=1;
           $site_config['site_keyword']=''; */
        $config = Db::name('system')->select();
        $site_config = [];
        foreach ($config as $value) {
            $site_config[$value['name']] = $value['value'];

        }

//        console_log($site_config);
        return $this->fetch('site_config', ['site_config' => $site_config]);
    }

    /**
     * 更新配置
     */
    public function updateSiteConfig()
    {
        if ($this->request->isPost()) {
            $site_config = $this->request->post('site_config/a');
            $site_config['site_tongji'] = htmlspecialchars_decode($site_config['site_tongji']);

            $path = 'application/config.php';

            $str = '<?php return [';
            $str .= " 
             'app_debug'              => true,
            'datetime_format'           => false,
            'geetest' => [
        'geetest_id' => 'c57f7c1f9daf244c3ae62f0e7c6ea6c6', 
        'geetest_key' => '1ffcf1559c1eae2cfedea93e635a70fd',  
    ],";

            if ($site_config['site_route'] == 1) {
                $str .= "'url_route_on'           => true,";
            } else {
                $str .= "'url_route_on'           => false,";
            }

            $str .= ']; ';
            file_put_contents($path, $str);

            Db::startTrans();
            $isF = true;
            try {
                foreach ($site_config as $key => $value) {
                    Db::name("system")->where('name', $key)->update(['value' => $value]);
                }

                Db::commit();
            } catch (\Exception $e) {
                $isF = false;
                Db::rollback();
            }
            if ($isF) {
                //$this->success('提交成功');

                return json(array('code' => 200, 'msg' => '提交成功'));
            } else {
                // $this->error('提交失败');
                return json(array('code' => 0, 'msg' => '提交失败'));
            }
        }
    }

    /**
     * 清除缓存
     */
    /*     public function clear()
        {
            if (delete_dir_file(CACHE_PATH) || delete_dir_file(TEMP_PATH)) {
                $this->success('清除缓存成功');
            } else {
                $this->error('清除缓存失败');
            }
        } */
    function clear()
    {
        delete_dir_file(CACHE_PATH);
        array_map('unlink', glob(TEMP_PATH . '/*.php'));
        if (!file_exists(TEMP_PATH)) {
            return json(array('code' => 200, 'msg' => '暂无缓存'));
        } else {
            rmdir(TEMP_PATH);
            return json(array('code' => 200, 'msg' => '更新缓存成功'));
        }


    }

    public function doUploadPic()
    {
        $uploadmodel = new UploadModel();


        $info = $uploadmodel->upfile('images', 'FileName');
        echo $info['headpath'];


    }

    public function diachange_password()
    {
        return $this->fetch();
    }


    public function changepwd()
    {
        return $this->fetch();
    }

    /**
     * 更新密码
     */
    public function updatePassword()
    {
        if ($this->request->isPost()) {
            $admin_id = Session::get('admin_id');
            $data = $this->request->param();
            $result = Db::name('user')->where('isadmin', 1)->find($admin_id);

            if ($result['password'] == md5($data['old_password'] . $result['salt'])) {
                if ($data['password'] == $data['confirm_password']) {
                    $new_password = md5($data['password'] . $result['salt']);
                    $res = Db::name('user')->where(['id' => $admin_id])->where('isadmin', 1)->setField('password', $new_password);

                    if ($res !== false) {
                        //$this->success('修改成功');
                        return json(array('code' => 200, 'msg' => '修改成功'));
                    } else {
                        // $this->error('修改失败');
                        return json(array('code' => 0, 'msg' => '修改失败'));
                    }
                } else {
                    // $this->error('两次密码输入不一致');
                    return json(array('code' => 0, 'msg' => '两次密码输入不一致'));
                }
            } else {
                //  $this->error('原密码不正确');
                return json(array('code' => 0, 'msg' => '原密码不正确'));
            }
        }
    }

    public function ajax_mail_test()
    {

        $data = $this->request->param();

        if (!$data['email']) {
            return json(array('code' => 0, 'msg' => '邮箱地址为空'));
        } else {

            $data['body'] = '测试邮件内容';
            $data['title'] = '测试邮件标题';
//            send_mail_local('', $data['title'], $data['body']);
//            send_mail_local($data);
            if ($res = send_code_to_email($data['email'], $data['title'], $data['body']) == true) {
                return json(array('code' => 1, 'msg' => '已发送测试邮件'));
            } else {
                return json(array('code' => 0, 'msg' => '发送失败'));

            }

            //return json(array('code'=>1,'msg'=>$data['email']));
        }

    }
}