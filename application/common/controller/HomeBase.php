<?php

namespace app\common\controller;

use think\Cache;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
use think\Loader;

use app\common\model\Nav as NavModel;

class HomeBase extends Controller
{

    protected $nav;

    protected function _initialize()
    {
        parent::_initialize();
        $this->getSystem();
        $this->systemlogin();
        $this->nav = new NavModel();
        $infonav = $this->nav->getlist_by_type(2);
        $footnav = $this->nav->getlist_by_type(4);
        $nav = $this->nav->getlist_by_type(1);
        $site_config = Cache::get('site_config');

        $this->assign('footnav', $footnav);
        $this->assign('infonav', $infonav);
        $this->assign('nav', $nav);
        $web_url = $_SERVER['HTTP_HOST'] . WEB_URL;
        $this->assign('site_config', $site_config);
        $this->assign('web_url', $web_url);
        $this->assign('controller', Loader::parseName($this->request->controller()));
    }

    protected function systemlogin()
    {
        if (!session('userid') || !session('username')) {

            $user = unserialize(decrypt(cookie('sys_key')));
            if ((empty($user['id'])) || (empty($user['username']))) {

            } else {
                systemSetKey($user);
                if ($user['userhead'] == '') {
                    $user['userhead'] = '/public/images/default.png';
                }
                session('userstatus', $user['status']);
                session('grades', $user['grades']);
                session('userhead', $user['userhead']);
                session('username', $user['username']);
                session('userid', $user['id']);
                session('point', $user['point']);
                Db::name('user')->update(
                    [
                        'last_login_time' => time(),
                        'last_login_ip' => $this->request->ip(),
                        'id' => $user['id']
                    ]
                );
            }
        }


    }

    /**
     * 获取前端导航列表
     */
    protected function getNav($type)
    {
//        Cache::set('nav', null);
        if (Cache::has('nav')) {
            $nav = Cache::get('nav');
        } else {
            $nav = Db::name('nav')->where(['type' => 1])->where(['status' => 1])->order(['sort' => 'ASC'])->select();


            if (!empty($nav)) {
                Cache::set('nav', $nav);
            }
        }
        $this->assign('nav', $nav);
    }

    /**
     * 获取站点信息
     */
    protected function getSystem()
    { //Cache::set('site_config', null);
        if (Cache::has('site_config')) {
            $site_config = Cache::get('site_config');
        } else {
            $config = Db::name('system')->select();
            $site_config = [];
            foreach ($config as $value) {
                $site_config[$value['name']] = $value['value'];
            }
            Cache::set('site_config', $site_config);
        }
        if (empty($site_config['point_name'])) {
            $site_config['point_name'] = '积分';
        }
//        var_dump($site_config);
        $this->assign('site_config', $site_config);
    }

    protected function getConfig()
    {
        $config = Db::name('system')->select();
        return $config;
    }

}