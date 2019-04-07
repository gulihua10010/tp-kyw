<?php
namespace app\common\controller;

use think\Loader;
use think\Cache;
use think\Controller;
use think\Db;
use think\Session;
/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class AdminBase extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();

        if (!Session::has('admin_id')) {
            $this->redirect('admin/login/index');
        }

        $root='http://'.$_SERVER['HTTP_HOST'].getbaseurl();
      $menulist=$this->getMenulist();
      $this->assign('menu',json_encode($menulist));

        $this->assign('root',$root);
        // 输出当前请求控制器（配合后台侧边菜单选中状态）
        $this->assign('controller', Loader::parseName($this->request->controller()));
    }

    function getMenulist()
    {
        $menulist = array(
             array(
                'name' => 'System',
                'title' => '系统设置',
                'icon' => '&#xe716;',
                'children' => array(
                    array('name' => 'config', 'title' => '站点配置', 'url' => 'admin/System/siteConfig'),
                    array('name' => 'changepwd', 'title' => '修改密码', 'url' => 'admin/System/changepwd')
                )
            ),
             array(
                'name' => 'info',
                'title' => '资讯管理',
                'icon' => '&#xe705;',
                'children' => array(
                    array('name' => 'course', 'title' => '课程管理', 'url' => 'admin/Course/index'),
                    array('name' => 'school', 'title' => '院校管理', 'url' => 'admin/School/index'),
                    array('name' => 'major', 'title' => '专业管理', 'url' => 'admin/Magor/index'),
                     array('name' => 'data', 'title' => '资料管理', 'url' => 'admin/Resource/index'),
                    array('name' => 'infos', 'title' => '资讯管理', 'url' => 'admin/Article/index'),

                ),
            ),
           array(
                'name' => 'content',
                'title' => '内容管理',
                'icon' => '&#xe663;',
                'children' => array(
                    array('name' => 'forumcate', 'title' => '社区版块', 'url' => 'admin/Forumcate/index'),
                    array('name' => 'forum', 'title' => '帖子管理', 'url' => 'admin/Forum/index'),
                    array('name' => 'comment', 'title' => '评论管理', 'url' => 'admin/Comment/index'),
                    array('name' => 'msg', 'title' => '我的消息', 'url' => 'admin/Message/index')
                )
            ),
            array(
                'name' => 'menu',
                'title' => '菜单管理',
                'icon' => '&#xe60f;',
                'children' => array(
                    array('name' => 'menu', 'title' => '论坛导航', 'url' => 'admin/Nav/index'),
                    array('name' => 'menu', 'title' => '资讯导航', 'url' => 'admin/Nav/infoindex'),
                    array('name' => 'menu', 'title' => '底部导航', 'url' => 'admin/Nav/footernav'),
                )
            ),
           array(
                'name' => 'user',
                'title' => '用户管理',
                'icon' => '&#xe770;',
                'children' => array(
                    array('name' => 'user', 'title' => '普通用户', 'url' => 'admin/User/index'),
                    array('name' => 'admin', 'title' => '管理员', 'url' => 'admin/AdminUser/index'),
                    array('name' => 'grade', 'title' => '会员等级', 'url' => 'admin/Usergrade/index'),

                ),
//            ),

            ),
        );
        foreach ($menulist as &$vo){
            foreach ($vo['children'] as &$child){
                $child['href']=url($child['url']);
            }
    }
        return $menulist;

    }

}
