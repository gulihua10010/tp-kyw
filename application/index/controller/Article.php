<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/26
 * Time: 11:14
 */

namespace app\index\controller;

use app\common\model\Comment as CommentModel;

use app\common\controller\HomeBase;
use app\common\model\Info as InfoModel;
use app\common\model\Article as  ArticleModel;
use think\Cache;
use think\Db;

class Article extends  HomeBase
{
    protected $info;
    protected  $art;
    protected   $reply=array();
    protected function _initialize()
    {
        parent::_initialize();
        $this->info=new InfoModel();
        $this->art=new ArticleModel();
        $right_a=$this->art->order('time desc')->limit(1,10)->select();
        $this->assign('right_a',$right_a);

    }
    public  function index($type=0,$keywords=''){
        $infos=$this->info->select();
        $this->assign('info',$infos);
        $map=[];
        if ($type!=0){
            $map['a.infoid']=['=',$type];
        }
        if ($keywords!==''){
            $map['a.title|a.keywords|a.desc']=['like',"%{$keywords}%"];
        }
        $arts=$this->art->alias('a')->join('info i','a.infoid=i.id')->where($map)->where('show',1)->field('a.* ,i.name as info')->paginate(10);
        $zans=[];
        if (session('userid') && session('username')) {
            $z['type']=7;
            $z['uid']=session('userid');
            $zans=Db::name('zan')->where($z)->column('sid');
        }


        $this->assign('zans',$zans);
        $this->assign('t',$type);
        $this->assign('arts',$arts);
        $this->assign('infos',$infos);
        return $this->fetch();

    }

    public function zan(){
        $data=$this->request->param();
        $uid = session('userid');
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            $insertdata['type']=7;
            $insertdata['uid']=$uid;
            $insertdata['sid']=$data['id'];

            $n=Db::name('zan')->where($insertdata)->find();
            if(empty($n)){
                $insertdata['time']=time();
                if(Db::name('zan')->insert($insertdata)){
                    Db::name('article')->where('id',$data['id'])->setInc('praise');
                    return json(array('code'=>200,'msg'=>'操作成功'));
                }else{
                    return json(array('code'=>0,'msg'=>'操作失败'));
                }

            }else{
                return json(array('code'=>0,'msg'=>'你已经赞过啦'));
            }

        }
    }

    protected function get_comm_reply($id){
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
    function  detail($id=0){

        $art=$this->art->alias('a')->join('info i','a.infoid=i.id')->field('a.* ,i.name as info')->where('a.id',$id)->find();
        if ($id==0||empty($art)){
            return $this->error('亲，你迷路了');
        }
        $this->art->where("id = {$id}")->setInc('readcount', 1);
        $a_iszan=0;
        if (session('userid') && session('username')) {
            $z['type']=7;
            $z['uid']=session('userid');
            $z['sid']=$id;
            $zans=Db::name('zan')->where($z)->find();
            if (!empty($zans)){
                $a_iszan=1;
            }
        }
        $comment['uid'] = array('not in', Db::name('user')->where('status', 'elt', 0)->column('id'));

        $tptcs = Db::name('comment')->alias('c')->join('user m', 'm.id=c.uid')
            ->where("fid = {$id}")->where('type',7)->where('tid',0)->where($comment)->order('c.id asc')
            ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username')
            ->select();
        $tptc=array();
        foreach ($tptcs as $v){
            $v['reply']=$this->get_comm_reply($v['id']);
            $this->reply=array();
            $tptc[]=$v;
        }
        $comm_iszans=[];
        if (session('userid') && session('username')) {

            $zan = [];
            foreach ($tptc as $value) {
                $zan[] = $value['id'];
                foreach ($value['reply'] as $item) {
                    $zan[] = $item['id'];
                }
            }
//               console_log($zan);

            $comm_iszans = Db::name('zan')->where('type', 2)->where('uid', session('userid'))->whereIn('sid', $zan)->column('sid');
        }
//        $iszans = [];
//        foreach ($iszan as $value) {
//            $iszans[] = $value['sid'];
//        }
        $this->assign('tptc', $tptc);
        $this->assign('iszan',$a_iszan);
        $this->assign('iszans',$comm_iszans);
        $this->assign('art',$art);
        return $this->fetch();

    }

    /**评论赞
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function commZan(){

        $data=$this->request->param();
        $uid = session('userid');
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{

            $insertdata['type']=2;
            $insertdata['uid']=$uid;
            $insertdata['sid']=$data['id'];
            $n=Db::name('zan')->where($insertdata)->find();
            if(empty($n)){
                $insertdata['time']=time();
                if(Db::name('zan')->insert($insertdata)){
                    Db::name('comment')->where('id',$data['id'])->setInc('praise');
                    return json(array('code'=>200,'msg'=>'操作成功'));
                }else{
                    return json(array('code'=>0,'msg'=>'操作失败'));
                }

            }else{
                return json(array('code'=>0,'msg'=>'你已经赞过该评论'));
            }

        }
    }
    public function addcomms()
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录');
        } else {
            $site_config = Cache::get('site_config');
            $comment = new CommentModel();
            $id = input('id');
            if (request()->isPost()) {
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $data =json_decode($_POST['data'],true);
                $data['time'] = time();
                $data['fid'] = $id;
                $data['uid'] = session('userid');
                $data['type'] =7;

                //  $data['content']=htmlspecialchars_encode($data['content']);

//                $member = Db::name('user');
                //$member->where('id', session('userid'))->setInc('point', $site_config['jifen_comment']);
                $art = Db::name('article');
                $art->where('id', $id)->setInc('comms', 1);
                if($data['tid']>0){
                    Db::name('comment')->where('id',$data['tid'])->setInc('reply');
                    $n=Db::name('comment')->where('id',$data['tid'])->find();
                    $messdata['type']=7;
                    $messdata['content']=$id;
                    $messdata['status']=1;
                    $messdata['uid']=session('userid');
                    $messdata['touid']=$n['uid'];
                    $messdata['time']=time();
                    Db::name('message')->insert($messdata);
                }
                if ($comment->add($data)) {
                    point_note($site_config['comment'],session('userid'),'commentadd',$comment->id);
                    return json(array('code' => 200, 'msg' => '回复成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '回复失败'));
                }
            }
        }
    }

    function updatecomms($aid=0){


        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录');
        } else {
            session('commenteditid',$aid);
            $uid = session('userid');
            $comment = new CommentModel();
            $a = $comment->find($aid);
            if ($aid==0 || $a == null || $a['uid'] != $uid) {
                $this->error('亲！您迷路了');
            } else {
                if (request()->isPost()) {
                    $data = input('post.');
                    $data['id']=session('commenteditid');
                    session('commenteditid', null);
                    if ($comment->edit($data)) {
                        return json(array('code' => 200, 'msg' => '修改成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '修改失败'));
                    }
                }

            }
        }

    }

}