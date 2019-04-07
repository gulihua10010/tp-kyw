<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/26
 * Time: 20:49
 */

namespace app\index\controller;

use app\common\model\Comment as CommentModel;

use app\common\model\Resource as ResourceModel;
use app\common\model\ResourceType as  TypeModel;
use app\common\controller\HomeBase;
use think\Cache;
use think\Db;

class Resource extends HomeBase
{
    protected $res;
    protected  $type;
    protected   $reply=array();

    protected function _initialize()
    {
        parent::_initialize();
        $this->res=new ResourceModel();
        $this->type=new TypeModel();
        $right_d=$this->res->order('time desc')->limit(1,10)->select();
        $this->assign('right_d',$right_d);

    }
    public  function index($pt=0,$st=0,$keywords=""){

        $pts=$this->type->where('pid',0)->select();
        $sts=[];
        if ($pt!=0){
            $sts=$this->type->where('pid',$pt)->select();
        }
        $map=[];
        if ($pt!=0&&$st==0){
            $in=array();
           $in= $this->type->where('pid',$pt)->column('id');
            $in[]=$pt;
            $map['tid']=['in',$in];
        }else if ($pt!=0&&$st!=0){
            $map['tid']=['=',$st];
        }
        if ($keywords!==""){
            $map['r.name|r.keywords|r.desc']=["like","%{$keywords}%"];
        }
        $res=$this->res->alias('r')->join('resource_type t','r.tid=t.id')
            ->join('file f','r.data=f.savepath')
            ->where($map)
            ->where('show',1)
            ->field('r.* ,t.name as info,f.ext,f.name as fname,f.md5,f.size')->paginate(5);
//
//        foreach ($res as &$r) {
//           $d=Db::name('file')->where('savepath',$r['data'])->find();
//           $extpic=$d['ext'].'.png';
////           $r['ext']=$d['ext'];
////           $r['fname']=$d['name'];
////           $r['md5']=$d['md5'];
////           $r['size']=$d['size'];
//           $r['extpic']=$extpic;
////            console_log($d);
////            console_log("<br/>============");
//        }
//        console_log($res);
        $this->assign('pts',$pts);
        $this->assign('sts',$sts);
        $this->assign('pt',$pt);
        $this->assign('st',$st);
        $this->assign('res',$res);
        return $this->fetch();

    }
    function detail($id=0){
        $res=$this->res->alias('r')->join('resource_type t','r.tid=t.id')
            ->join('file f','r.data=f.savepath')
            ->where('r.id',$id)
            ->field('r.* ,t.name as info,f.ext,f.name as fname,f.md5,f.size')->find();
        if ($id==0||empty($res)){
            return       $this->error('亲！您迷路了！');

        }

        $zans=[];
        if (session('userid') && session('username')) {
            $z['type']=8;
            $z['uid']=session('userid');
            $zans=Db::name('zan')->where($z)->column('sid');
        }

        //获取评论
        $comment['uid'] = array('not in', Db::name('user')->where('status', 'elt', 0)->column('id'));

        $tptcs = Db::name('comment')->alias('c')->join('user m', 'm.id=c.uid')
            ->where("fid = {$id}")->where('type',8)->where('tid',0)->where($comment)->order('c.id asc')
            ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username')
            ->select();
        $tptc=array();
        foreach ($tptcs as $v){
            $v['reply']=$this->get_comm_reply($v['id']);
            $this->reply=array();
            $tptc[]=$v;
        }
        $comm_iszans=[];
        $isdownload=0;
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
            $maptime['uid'] = session('userid');
            $maptime['pointid'] = $id;
            $maptime['controller'] = 'resource';
            $count = Db::name('point_note')->where($maptime)->count();
            if ($count>0){
                $isdownload=1;
            }
        }
        $this->assign('tptc',$tptc);
        $this->assign('isdownload',$isdownload);
        $this->assign('res',$res);
        $this->assign('zans',$zans);
        $this->assign('comm_iszans',$comm_iszans);
        return $this->fetch();
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
    public function zan(){
        $data=$this->request->param();
        $uid = session('userid');
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            $insertdata['type']=8;
            $insertdata['uid']=$uid;
            $insertdata['sid']=$data['id'];

            $n=Db::name('zan')->where($insertdata)->find();
            if(empty($n)){
                $insertdata['time']=time();
                if(Db::name('zan')->insert($insertdata)){
                    Db::name('resource')->where('id',$data['id'])->setInc('praise');
                    return json(array('code'=>200,'msg'=>'操作成功'));
                }else{
                    return json(array('code'=>0,'msg'=>'操作失败'));
                }

            }else{
                return json(array('code'=>0,'msg'=>'你已经赞过啦'));
            }

        }
    }
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
            if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

            }
            $comment = new CommentModel();
            $id = input('id');
            if (request()->isPost()) {

                $data =json_decode($_POST['data'],true);
                $data['time'] = time();
                $data['fid'] = $id;
                $data['uid'] = session('userid');
                $data['type'] =8;

                //  $data['content']=htmlspecialchars_encode($data['content']);

//                $member = Db::name('user');
                //$member->where('id', session('userid'))->setInc('point', $site_config['jifen_comment']);
                if($data['tid']>0){
                    Db::name('comment')->where('id',$data['tid'])->setInc('reply');
                    $n=Db::name('comment')->where('id',$data['tid'])->find();
                    $messdata['type']=8;
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

    function updatecomms($rid=0){
        if ($rid==0){
            $this->error('亲！您迷路了');
        }
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录');
        } else {
            session('commenteditid',$rid);
            $uid = session('userid');
            $comment = new CommentModel();
            $a = $comment->find($rid);
            if ($rid==0|| $a == null || $a['uid'] != $uid) {
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
                $r=  point_note($data['point'],session('userid')   , 'resource',$id);
                if ($r==-1){
                    return json(array('code' => 0, 'msg' => '用户积分不够，下载失败！'));

                }else{
                    $this->res->where('id',$id)->setInc('download', 1);
                    return json(array('code' => 200, 'msg' => '积分扣除成功！'));

                }
            }

        }

    }

}