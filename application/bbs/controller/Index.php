<?php

namespace app\bbs\controller;

use app\common\controller\HomeBase;
use think\Cache;
use think\Db;

use app\common\model\Forumcate as ForumcateModel;
use app\common\model\User as UserModel;

class Index extends HomeBase
{
    protected   $reply=array();
    protected function _initialize()
    {
        parent::_initialize();

        $this->getForums();
    }

    public function index()
    {
        $forum = Db::name('forum');
        $open['open'] = 1;
        $settop['settop'] = 1;
        $nosettop['settop'] = 0;
        $tptc = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,m.id as userid,m.userhead,m.username,c.name')->where($open)->where($settop)->order('f.id desc')->limit(5)->select();
        $this->assign('tptc', $tptc);
        $tptcs = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,m.id as userid,m.userhead,m.username,c.name')->where($open)->where($nosettop)->order('f.id desc')->paginate(15);
        $this->assign('tptcs', $tptcs);

        return view();
    }

    public function getForums()
    {
        $show['show'] = 1;
        $status['status'] = 1;
        $open['open'] = 1;
        $choice['choice'] = 1;
        //	$tptm = Db::name('user')->order('id desc')->limit(12)->select();
        $tptm = Db::name('forum')->alias('f')->join('user u', 'f.uid=u.id')
            ->field('u.*,count(f.id) as forumnum')
            ->group('uid')->order('forumnum desc')->limit(12)
            ->select();
        //$tptm =  Db::name('user')->alias('u')->join('forum f', 'f.uid=u.id')->field('u.*,count(f.id) as forumnum')->order('forumnum desc')->limit(12)->select();

        $this->assign('tptm', $tptm);
        /*  $tptl = Db::name('link')->where($status)->order('id desc')->select();
         $this->assign('tptl', $tptl); */
        $tpte = Db::name('forum')->where($open)->where($choice)->order('id desc')->limit(9)->select();
        $this->assign('tpte', $tpte);
        $tptf = Db::name('forum')->where($open)->order('view desc')->limit(9)->select();
        $this->assign('tptf', $tptf);

        $tpto = Db::name('forumcate')->where($show)->order('sort desc')->limit(12)->select();
        foreach ($tpto as $k => $v) {
            $tpto[$k]['count'] = Db::name('forum')->where('tid', $v['id'])->count();

        }
        $this->assign('tpto', $tpto);
    }



    public function view()
    {
        $id = input('id');
        session('forumviewid', $id);
        if (empty($id)) {
            return $this->error('亲！你迷路了');
        } else {
            $category = Db::name('forumcate');

            $c = $category->where('id', $id)->find();
            if ($c) {
                $forum = Db::name('forum');
                $open['open'] = 1;
                $catemodel = new ForumcateModel();
                $children = $catemodel->getchilrenid($id);
                array_push($children, $id);
                $tptc = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,m.id as userid,m.userhead,m.username,m.grades,c.name')->where('f.tid', 'in', $children)->where($open)->order('f.settop desc,f.id desc')->paginate(15);
                $this->assign('tptc', $tptc);

                $this->assign('name', $c['name']);
                return view();
            } else {
                $this->error("亲！你迷路了！");
            }
        }
    }

    public function thread()
    {

        $id = input('id');
        if (empty($id)) {
            return $this->error('亲！你迷路了');
        } else {
//            Cache::set('site_config',null);
            $site_config = Cache::get('site_config');
            $forum = Db::name('forum');
            $a = $forum->where("id = {$id}")->find();
            if ($a) {
                $forum->where("id = {$id}")->setInc('view', 1);
                $t = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')
                    ->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,c.name,m.id as userid,m.grades,m.point,m.userhead,m.username,m.status')->find($id);
                $this->assign('t', $t);
                $file=Db::name('file')->where('savepath',$a['file'])->find();
                if ($t['keywords'] != '') {
                    $keywordarr = explode(',', $t['keywords']);
                    $this->assign('keywordarr', $keywordarr);
                }
                $comment['uid'] = array('not in', Db::name('user')->where('status', 'elt', 0)->column('id'));

                if ($t['status'] <= 0) {
                    $content = '<font color="#FF5722">该用户已被禁用或禁言</font>';
                } else {
                    $content = $t['content'];
//                    $content=  hook('threadfeecontent',array('content'=>$content,'id'=>$t['id'],'uid'=>session('userid'),'zuid'=>$t['userid']),true,'content');
                }
                $tptcs = Db::name('comment')->alias('c')->join('user m', 'm.id=c.uid')
                    ->where("fid = {$id}")->where('type',1)->where('tid',0)->where($comment)->order('c.id asc')
                    ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username')
                    ->select();
                $tptc=array();
                foreach ($tptcs as $v){
                    $v['reply']=$this->get_comm_reply($v['id']);
                    $this->reply=array();
                    $tptc[]=$v;
                }
                $zan = [];
                foreach ($tptc as $value) {
                    $zan[] = $value['id'];
                    foreach ($value['reply'] as $item) {
                        $zan[] = $item['id'];
                    }
                }
//               console_log($zan);
                $iszan = Db::name('zan')->where('type', 2)->where('uid', session('userid'))->whereIn('sid', $zan)->select();

                $iszans = [];
                foreach ($iszan as $value) {
                    $iszans[] = $value['sid'];
                }
                $isdownload=0;
                if (session('userid') && session('username')&&!empty($file)) {
                    $maptime['uid'] = session('userid');
                    $maptime['pointid'] = $id;
                    $maptime['controller'] = 'forumfiledownload';
                    $count = Db::name('point_note')->where($maptime)->count();
                    if ($count>0){
                        $isdownload=1;
                    }

                }

                 $this->assign('isdownload',$isdownload);

                $this->assign('tptc', $tptc);
                $this->assign('content', $content);
                $this->assign('iszans', $iszans);
                $this->assign('file', $file);
                $this->assign('point_download', $site_config['point_download']);
                return view();
            } else {
                return $this->error('亲！你迷路了');
            }
        }
    }


    public function get_comm_reply($id){
        $replys =Db::name('comment')->where('tid',$id)->select();
        foreach ($replys as $re) {
            $repUsername = Db::name('user')->where('id',$re['uid'])->find();
            $pc=Db::name('comment')->where('id',$re['tid'])->find();
            $parUsername = Db::name('user')->where('id',$pc['uid'])->find();

            $re['pinfo']=$parUsername;
            $re['rinfo']=$repUsername;
            $this->reply[]=$re;
            $this->get_comm_reply($re['id']);
        }
        return  $this->reply;

    }
    public function choice()
    {
        $forum = Db::name('forum');
        $open['open'] = 1;
        $choice['choice'] = 1;
        $tptc = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,m.id as userid,m.userhead,m.username,c.name')->where($open)->where($choice)->order('f.settop desc,f.id desc')->paginate(15);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function errors()
    {
        return view();
    }

    public function search()
    {
        $ks = input('ks');
        $kss = urldecode(input('ks'));
        if (empty($ks)) {
            return $this->error('亲！你迷路了');
        } else {
            $forum = Db::name('forum');
            $open['open'] = 1;


            $map['f.title|f.keywords'] = ['like', "%{$kss}%"];

            $tptc = $forum->alias('f')->join('forumcate c', 'c.id=f.tid')->join('user m', 'm.id=f.uid')->field('f.*,c.id as cid,m.id as userid,m.userhead,m.username,c.name')->order('f.id desc')->where($open)->where($map)->paginate(15, false, $config = ['query' => array('ks' => $ks)]);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    function download($id=0){
        if ($id==0){
            return json(array('code' => 0, 'msg' => '亲！您迷路了！'));
        }
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录');
        } else {
//            $point=$this->res->where('id',$id)->find();
            if ($this->request->isPost()){
                $data=$this->request->post();
                $r=  point_note($data['point'],session('userid')   , 'forumfiledownload',$id);
                if ($r==-1){
                    return json(array('code' => 0, 'msg' => '用户积分不够，下载失败！'));

                }else{
                    return json(array('code' => 200, 'msg' => '积分扣除成功！'));

                }
            }

        }

    }
}
