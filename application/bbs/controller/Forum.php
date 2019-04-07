<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/6
 * Time: 16:57
 */

namespace app\bbs\controller;


use app\common\controller\HomeBase;
use think\Cache;

use app\common\model\Forum as ForumModel;
use app\common\model\Upload as UploadModel;
use think\Db;

class Forum extends  HomeBase
{
protected function _initialize()
{
    parent::_initialize();
//    $this->getNav(1);
}
    public function add()
    {
        $site_config = Cache::get('site_config');

        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录',url('bbs/index/index'));
        } else {
            if (session('userstatus')==2){
                $this->error('您已经被管理员禁言',url('bbs/index/index'));

            }
            $forum = new ForumModel();
            if (request()->isPost()) {
                $data=json_decode($_POST['data'],true);
                if($data['tid']==0){
                    return json(array('code' => 0, 'msg' => '版块为空'));
                }
                if($data['content']==''){
                    return json(array('code' => 0, 'msg' => '内容为空'));
                }
                $data['time'] = time();

                if(session('userstatus')>0){
                    $data['open'] =$site_config['forum_sh'];
                }else{
                    $data['open'] =session('userstatus');
                }
                $data['view'] = 1;
                $data['uid'] = session('userid');
                $data['description'] = mb_substr(remove_xss($data['content']), 0, 200, 'utf-8');
                $data['title']=  strip_tags( $data['title']);

                //$member = Db::name('user');
                // $member->where('id', session('userid'))->setInc('point', $site_config['jifen_add']);

                if ($forum->add($data)) {
                    point_note($site_config['point_write'],session('userid'),'forumadd',$forum->id);
                    if ($data['file']!=''){
                        point_note($site_config['point_upload'],session('userid'),'forumfileupload',$forum->id);

                    }

                    return json(array('code' => 200, 'msg' => '添加成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

            $category = Db::name('forumcate');
            $tptc = $category->where(array('show'=>1))->select();
            $this->assign('tptc', $tptc);
            $tags = $site_config['site_keyword'];
            $tagss = explode(',', $tags);
            $this->assign('tagss', $tagss);
            $this->assign('title', '发布帖子');
            return view();
        }
    }

    public function edit()
    {
        $site_config = Cache::get('site_config');
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录',url('bbs/index/index'));
        } else {
            $id = input('id');
            session('editid',$id);
            $uid = session('userid');
            $forum = new ForumModel();
            $a = $forum->find($id);
            if (empty($id) || $a == null || $a['uid'] != $uid) {
                $this->error('亲！您迷路了');
            } else {
                if (request()->isPost()) {
                    $data =json_decode($_POST['data'],true);
                    $data['id']=session('editid');
                    session('editid', null);
                    if($data['content']==''){
                        return json(array('code' => 0, 'msg' => '内容为空'));
                    }
                    $data['description'] = mb_substr(remove_xss($data['content']), 0, 200, 'utf-8');
                    $data['title']=  strip_tags( $data['title']);

                    $data['content']= remove_xss($data['content']);

                    if ($forum->edit($data)) {
                        return json(array('code' => 200, 'msg' => '修改成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '修改失败'));
                    }
                }
                $category = Db::name('forumcate');
                $tptc = $forum->find($id);
                $tptc['title']=strip_tags($tptc['title']);
                $tptcs = $category->where(array('show'=>1))->select();
                $this->assign(array('tptcs' => $tptcs, 'tptc' => $tptc));
                $tags = $site_config['site_keyword'];
                $tagss = explode(',', $tags);
                $this->assign('tagss', $tagss);
                $this->assign('title', '编辑帖子');
                return view();
            }
        }
    }

}