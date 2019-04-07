<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/11
 * Time: 14:09
 */

namespace app\index\controller;


use app\common\model\CourseAsk;
use app\common\model\CourseNote;
use app\common\model\User as UserModel;
use app\common\model\Nav as NavModel;
use app\common\model\Comment as CommentModel;
use app\common\model\CourseType as CourseTypeModel;
use app\common\model\Course as CourseModel;
use app\common\model\Info as InfoModel;
use app\common\model\Article as ArticleModel;

use app\common\controller\HomeBase;
use think\Cache;
use think\Db;
use think\paginator\driver\Page;

class Course extends HomeBase
{
    protected  $reply=array();
    protected $coursetype;
    protected $info;
    protected $nav;
    protected $config;
    protected $course;
    protected $comment;
    protected $ask;
    protected $note;

    protected function _initialize()
    {
        $this->coursetype = new CourseTypeModel();
        $this->info = new InfoModel();
        $this->article = new ArticleModel();
        $this->nav = new NavModel();
        $this->course = new CourseModel();
        $this->comment = new CommentModel();
        $this->ask = new CourseAsk();
        $this->note = new CourseNote();
        parent::_initialize();
    }

    /**
     * @param int $type类型
     * @param string $keywords关键词
     * @return mixed
     */
    function index($type = 0,$keywords='')
    {    $map=[];
        $arr = explode('_', $type);
        if (!empty($arr[1])) {
            $sub = $arr[1];
        } else {
            $sub = -9;
        }
        if ($keywords!==''){
            $map['name|keywords|desc']=['like',"%{$keywords}%"];
        }
        $coursetype = $this->coursetype->where('pid', 0)->select();
        $subtype = $this->coursetype->where('pid', $arr[0])->select();

        //获取课程列表
         if ($arr[0] > 0 && $sub == -9) {
            $subtypes = array();
            $subtypes[] = intval($arr[0]);

            $subtypes = $this->coursetype->where('pid', $arr[0])->column('id');

            $map['cid']=['in', $subtypes];
//            $courselist = $this->course->whereIn('cid', $subtypes)->order('time desc')->paginate(10);

        } else if ($sub > 0) {
            $map['cid']=['=', $sub];
        }
        $courselist = $this->course->where($map)->where('show',1)->order('time desc')->paginate(10);

        $this->assign('coursetype', $coursetype);
        $this->assign('subtype', $subtype);
        $this->assign('le1', $arr[0]);
        $this->assign('le2', $sub);
        $this->assign('courselist', $courselist);
        return $this->fetch();
    }

    public function detail($id=0)
    {
        $course = $this->course->where('id', $id)->find();
        if ($id==0||empty($course)){
            return $this->error('亲，你迷路了！');
        }
        $type = $this->coursetype->where('id', $course['cid'])->find();
        if ($type['pid'] != 0) {
            $typep = $this->coursetype->where('id', $type['pid'])->find();
        }
        $types = array();
        $types[] = $type['name'];
        if (!empty($typep)) {
            $types[] = $typep['name'];
        }
        //获取视频集
        $course_video = Db::name('course_video_collection')->where('cid', $id)->where('pid', 0)->select();
        $videos = array();
        foreach ($course_video as $item) {
            $item['sub'] = Db::name('course_video_collection')->where('pid', $item['id'])->select();
            $videos[] = $item;
        }
        //获取收藏
        $watches=[];
        if (session('userid') && session('username')) {
            $isColl = Db::name('user_course')->where('cid', $id)->where('vid',0)->where('uid', session('userid'))->find();
            if (!empty($isColl)&&$isColl['collect'] == 1) {
                $isFav = 1;
            } else {
                $isFav = 0;
            }
            $point['uid']=session('userid');
            $point['controller']='course';
            $watches = Db::name('point_note')->where($point)->column('pointid');

        } else {
            $isFav = 0;
        }
  ;
        //获取评论
        //
        $comment['m.id'] = array('not in', Db::name('user')->where('status', 'elt', 0)->column('id'));
        $comms = Db::name('comment')->alias('c')->join('user m', 'm.id=c.uid')->join('user_course uc','c.uid=uc.uid')
            ->where('uc.vid',0)
            ->where('uc.cid',$id)
            ->where("fid = {$id}")->where('type',6)->where($comment)->order('c.id asc')->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username ,uc.star')
            ->select()  ;
        //计算评分
        $stars=Db::name('user_course')->where('cid',$id)->where('vid',0)->column('star');
//        var_dump($stars);
        $sum=0;
        for($i=0;$i<sizeof($stars);$i++){
            $sum+=$stars[$i];
        }
        if (sizeof($stars)==0){
        $st=5;
        }else{
         $st=round( $sum/sizeof($stars));
         }
        //获取推荐
//            $a=['d','3','t','h','y'];
//        $rid = rand(0, sizeof($a)-1);
//        console_log("rid".$rid);
//        $arrs=[];
//        for ($i = 0; $i < 5; $i++) {
//            if (in_array($a[$rid],$arrs)){
//                $i--;  continue;
//            }
//            $arrs[]=$a[$rid];
//            array_splice($a, $rid, 1);
//            $rid = rand(0, sizeof($a)-1);
//            console_log("size".sizeof($a));
//            console_log("rid".$rid);
//            var_dump($a);
//        }
//        console_log($arrs);
//        $right_tj=$arrs;

        $courses = $this->course->whereNotIn('id',$id)->select();
        $courselen=sizeof($courses);
        $right_tj=array();
        $arrs=array();
        if ($courselen<8){
            $right_tj=$courses;
        }else{
            $rid = rand(0, $courselen-1);
            for ($i = 0; $i < 8; $i++) {
                if (in_array($courses[$rid],$arrs)){
                  $i--;  continue;
                }
                $arrs[]=$courses[$rid];
                array_splice($courses, $rid, 1);
                $rid = rand(0, sizeof($courses)-1);
            }
            $right_tj=$arrs;

        }

//console_log($comms);
//        console_log($iswatch);
        $this->course->where('id', $id)->setField('star', $st);
        $this->assign('course', $course);
        $this->assign('watches', $watches);
        $this->assign('types', $types);
        $this->assign('isFav', $isFav);
        $this->assign('videos', $videos);
        $this->assign('comms', $comms);
        $this->assign('right_tj', $right_tj);
        return $this->fetch();
    }

    public function addFavoritesItems()
    {
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()) {
                $data = $this->request->post();
                $res = Db::name('user_course')->where('cid', $data['cid'])->where('uid', $data['uid'])->where('vid',0)->find();
                if (!empty($res)) {
                    $r = Db::name('user_course')->where('id', $res['id'])->update(['collect' => 1]);
                    if ($r) {
                        return json(array('code' => 200, 'msg' => '收藏成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '收藏失败'));
                    }
                } else {
                    $insert['cid'] = $data['cid'];
                    $insert['uid'] = $data['uid'];
                    $insert['vid'] = 0;
                    $insert['collect'] = 1;
                    $r = Db::name('user_course')->insert($insert);
                    if ($r) {
                        return json(array('code' => 200, 'msg' => '收藏成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '收藏失败'));
                    }
                }


            }
        }



    }

    public function delFavoritesItems()
    {
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()) {
                $data = $this->request->post();
                $res = Db::name('user_course')->where('cid', $data['cid'])->where('uid', $data['uid'])->where('vid',0)->find();
                if (!empty($res)) {
                    $r = Db::name('user_course')->where('id', $res['id'])->update(['collect' => 0]);
                    if ($r) {
                        return json(array('code' => 200, 'msg' => '取收藏成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '取消收藏失败'));
                    }
                } else {
                    return json(array('code' => 0, 'msg' => '取消收藏失败'));

                }
            }
        }

    }

    /**添加评论
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function addCommon()
    {
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()) {
                $site_config = Cache::get('site_config');
                $data = $this->request->post();
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $comm['tid']=0;
                $comm['fid']=$data['cid'];
                $comm['uid']=$data['uid'];
                $comm['content']=$data['content'];
                $comm['reply']=0;
                $comm['type']=6;
                $comm['time']=time();
                $iscom=Db::name('user_course')->where('cid', $data['cid'])->where('vid',0)->where('uid',$data['uid'])->find();
                if ($iscom['iscomment'] ==1){
                    return json(array('code' => 0, 'msg' => '您已经评论过了'));
                }
                if ( $this->comment->allowField(true)->save($comm)){
                    /**
                     * 插入用户-课程信息
                     */
                    $res = Db::name('user_course')->where('cid', $data['cid'])->where('vid',0)->where('uid', $data['uid'])->find();
                    if (!empty($res)){
                        Db::name('user_course')->where('id', $res['id'])->update(['iscomment' =>1]);
                        Db::name('user_course')->where('id', $res['id'])->update(['star' =>$data['star']]);
                    }else{
                        $in['cid']= $data['cid'];
                        $in['vid']= 0;
                        $in['uid']= $data['uid'];
                        $in['iscomment']= 1;
                        $in['star']= $data['star'];
                        $r=Db::name('user_course')->insert($in);
                       if ($r!==false){
                           point_note($site_config['point_reply'],session('userid'),'commentadd',$this->comment->id);

                           return json(array('code' => 200, 'msg' => '评论成功'));

                       }else{
                           return json(array('code' => 0, 'msg' => '评论失败'));

                       }

                    }

                }else{
                    return json(array('code' => 0, 'msg' => '评论失败'));

                }
            }

        }


    }

    function  showvideo($vid=0,$cid=0,$page=1){
        //笔记
        $notes = Db::name('course_note')->alias('c')->join('user m', 'm.id=c.uid')
            ->where("vid = {$vid}")->order('c.id asc')->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')
            ->paginate(5);
        //评论
        $comms = Db::name('comment')->alias('c')->join('user m', 'm.id=c.uid')
            ->where("fid = {$vid}")->where('type',4)->order('c.id asc')
            ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')->paginate(5);
        //ask
        $asks =$this->ask->alias('c')->join('user m', 'm.id=c.uid')->where('tid',0)
            ->where("vid = {$vid}")->order('c.id asc')->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')
            ->paginate(5);
        foreach ($asks as &$item) {

            $item['solve']=Db::name('course_ask')->alias('c')->join('user m', 'm.id=c.uid')
                ->where("vid={$vid}")->where("tid={$item['id']}")->where('issolve',1)->whereNotIn('tid',[0])
                ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')->find();
            $item['new']=Db::name('course_ask')->alias('c')->join('user m', 'm.id=c.uid')
                ->where("vid={$vid}")->where("tid={$item['id']}")->whereNotIn('tid',[0])->order('c.time desc')
                ->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')->find();
        }
//        console_log($asks);
        $apages=$asks->render();
        $cpages=$comms->render();
        $npages=$notes->render();

        $this->assign('apage',$apages);
        $this->assign('cpage',$cpages);
        $this->assign('npage',$npages);
        /**
         * ajax获取评论
         */
        if ($this->request->isAjax()){
            $dpage=$this->request->post();
            $d5s=array();
            $d4s=array();
            if (session('userid') && session('username')) {
                if ($dpage['type'] == 1) {
                    $this->assign('vid', $vid);

                } else if ($dpage['type'] == 2) {
                    $d4['type'] = 4;
                    $d4['uid'] = session('userid');
                    $d4s = Db::name('zan')->where($d4)->column('sid');
                    $this->assign('d4s', $d4s);
                } else if ($dpage['type'] == 3) {

                    $d5['type'] = 5;
                    $d5['uid'] = session('userid');
                    $d5s = Db::name('zan')->where($d5)->column('sid');
                    $this->assign('d5s', $d5s);
                }

            }
            if ($dpage['type']==1){
//                $pages=$notes->render();
                $this->assign('asks',$asks);
                $this->assign('vid', $vid);
                return $this->fetch('course_ajaxpage_asks');

            }else if ($dpage['type']==2){
//                $pages=$notes->render();
                $this->assign('comms',$comms);
                $this->assign('vid', $vid);
                return $this->fetch('course_ajaxpage_comms');

            }else if ($dpage['type']==3){

//                $pages=$notes->render();
                $this->assign('notes',$notes);
                $this->assign('vid', $vid);
                return $this->fetch('course_ajaxpage_notes');

            }
        }
        if ($cid==0||$vid==0){
            return $this->error('亲，你迷路了！');
        }
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录',url('index/course/index'));

        }else{
            $point['uid']=session('userid');
            $point['controller']='course';
            $point['pointid']=$vid;
            $isv = Db::name('point_note')->where($point)->find();
            if (!$isv){
                $this->error('非法操作！(原因是您未观看过改视频，请先消耗积分观看！)',url('index/course/index',array('id'=>$cid)));

            }
            $video=Db::name('course_video_collection')->where('id', $vid)->find();
            if (empty($video)||$video['video']==''||$video['video']==null){
                return $this->error('亲，你迷路了！',url('index/course/index'));
            }
            $video_collects=Db::name('course_video_collection')->where('cid', $cid)->where('pid',0)->select();
            $arr=array();
            foreach ($video_collects as $video_collect) {
                $video_collect['sub']=Db::name('course_video_collection')->where('pid', $video_collect['id'])->select();
                $arr[]=$video_collect;
            }
            //获取推荐

            $courses = $this->course->whereNotIn('id',$cid)->select();
            $courselen=sizeof($courses);
            $right_tj=array();
            $arrs=array();
            if ($courselen<8){
                $right_tj=$courses;
            }else{
                $rid = rand(0, $courselen-1);
                for ($i = 0; $i < 8; $i++) {
                    if (in_array($courses[$rid],$arrs)){
                        $i--;  continue;
                    }
                    $arrs[]=$courses[$rid];
                    array_splice($courses, $rid, 1);
                    $rid = rand(0, sizeof($courses)-1);
                }
                $right_tj=$arrs;

            }
            $dcvr=array('progress'=>0);
            $d5s=array();
            $d4s=array();
            if (session('userid') && session('username')) {

                $d4['type']=4;
                $d4['uid']=session('userid');
                $d4s=Db::name('zan')->where($d4)->column('sid');

                $d5['type']=5;
                $d5['uid']=session('userid');
                $d5s=Db::name('zan')->where($d5)->column('sid');
                $islogin=1;
                $dcv['cid']=$cid;
                $dcv['vid']=$vid;
                $dcv['uid']=session('userid');
                $dcvr=Db::name('user_course')->where($dcv)->find();
            }else{
                $islogin=0;
                $d4s=array();
            }

//            $notes = Db::name('course_note')->alias('c')->join('user m', 'm.id=c.uid')
//                ->where("vid = {$vid}")->order('c.id asc')->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')
//                ->select();

            $this->assign('islogin',$islogin);
            $this->assign('d4s',$d4s);
            $this->assign('d5s',$d5s);;
            $this->assign('dcvr',$dcvr);;
            $this->assign('video',$video);
            $this->assign('video_collects',$arr);
            $this->assign('cid',$cid);
            $this->assign('vid',$vid);
            $this->assign('comms',$comms);
            $this->assign('notes',$notes);
            $this->assign('asks',$asks);
            $this->assign('right_tj',$right_tj);
            return $this->fetch();

        }
    }

    public  function  ajaxpage_notes($vid){
          $notes = Db::name('course_note')->alias('c')->join('user m', 'm.id=c.uid')
            ->where("vid = {$vid}")->order('c.id asc')->field('c.*,m.id as userid,m.grades,m.point,m.userhead,m.username  ')
            ->paginate(5);
          $page=$notes->render();
          if ($this->request->isAjax()){
              return $this->fetch('notepage');
          }
          $this->assign('notes',$notes);
          $this->assign('page',$page);

//        $page=new Page()

    }
    function  addvideocomm(){
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()){
                $site_config = Cache::get('site_config');
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $data=$this->request->post() ;
                $comm['tid']=0;
                $comm['fid']=$data['vid'];
                $comm['uid']=$data['uid'];
                $comm['content']=$data['content'];
                $comm['reply']=0;
                $comm['type']=4;
                $comm['time']=time();
                if ( $this->comment->allowField(true)->save($comm)){
                    point_note($site_config['comment'],session('userid'),'commentadd',$this->comment->id);


                    return json(array('code' => 200, 'msg' => '评论成功','id'=>$this->comment->getLastInsID()));
                }else{
                    return json(array('code' => 0, 'msg' => '评论失败'));

                }


            }

        }


    }

    /**保存视频观看时间
     * @param int $id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function  saveWatchTime($id=0){
        if ($id==0){
            return json(array('code' => 0, 'msg' => '亲，你迷路了'));
        }
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{

            if ($this->request->isPost()) {
                $data = $this->request->post();
                $d['cid']=$id;
                $d['vid']=$data['vid'];
                $d['uid']=$data['uid'];
                //setField('duration',$data['seconds'])
                $res=Db::name('user_course')->where($d)->find();
                if (!empty($res)){
                    $r=Db::name('user_course')->where('id',$res['id'])->setField('progress',$data['seconds']);
                }else{
                    $d['progress']=$data['seconds'];
                    $r= Db::name('user_course') ->insert($d);
                }
                if ($r){
                    return json(array('code' => 200, 'msg' => '保存进度成功' ));
                }else{
                    return json(array('code' => 0, 'msg' => '保存进度失败'));

                }
            }

        }

    }
    function  addvideonote(){
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()){
                $site_config = Cache::get('site_config');
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $data=$this->request->post() ;
                $comm['vid']=$data['vid'];
                $comm['uid']=$data['uid'];
                $comm['content']=$data['content'];
                $comm['time']=time();
                if ( $this->note->add($comm)){
                    point_note($site_config['note'],session('userid'),'noteadd',$this->note->id);

                    return json(array('code' => 200, 'msg' => '笔记提交成功','id'=>$this->note->getLastInsID()));
                }else{
                    return json(array('code' => 0, 'msg' => '笔记提交失败'));
                }

            }
        }


    }
    //addvideoask addvideonote

    /***视频问题
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function  addvideoask(){
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()){
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $site_config = Cache::get('site_config');
                $data=$this->request->post() ;
                $ask['tid']=0;
                $ask['vid']=$data['vid'];
                $ask['uid']=$data['uid'];
                $ask['content']=$data['content'];
                $ask['title']=$data['title'];
                $ask['reply']=0;
                $ask['issolve']=0;
                $ask['time']=time();
                if ( $this->ask->allowField(true)->save($ask)){
                    point_note($site_config['ask'],session('userid'),'askadd',$this->ask->id);

                    return json(array('code' => 200, 'msg' => '提问成功','id'=>$this->ask->getLastInsID()));
                }else{
                    return json(array('code' => 0, 'msg' => '提问失败'));

                }
            }

        }

    }

    function  updatevideoask($id=0){
        if ($id==0){
            return json(array('code' => 0, 'msg' => '亲，你迷路了'));
        }
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{

            if ($this->request->isPost()){
                $data=json_decode($_POST['data'],true);
                $ask['content']=$data['content'];
                $ask['title']=$data['title'];
                $ask['id']=$id;
                if ( $this->ask->edit($ask)!==false){
                    return json(array('code' => 200, 'msg' => '修改成功' ));
                }else{
                    return json(array('code' => 0, 'msg' => '修改失败'));

                }


            }
        }


    }
    //updatevideoanswer

    /**问答的回答
     * @param int $aid
     * @return \think\response\Json
     */
    function  updatevideoanswer($aid=0){
        if (!session('userid') || !session('username')) {
            return json(array('code' => 0, 'msg' => '亲！请登录'));
        } else {
            $uid = session('userid');
            $a=$this->ask->find($aid);
            if ($aid==0 || $a == null || $a['uid'] != $uid) {
                $this->error('亲！您迷路了');
            } else {
                if ($this->request->isPost()){
                    $data=json_decode($_POST['data'],true);
                    $ask['content']=$data['content'];
                    $ask['id']=$aid;
                    if ( $this->ask->edit($ask)!==false){
                        return json(array('code' => 200, 'msg' => '修改成功' ));
                    }else{
                        return json(array('code' => 0, 'msg' => '修改失败'));
                    }
                }
            }
        }

    }

    //updatevideonote
    function  updatevideonote($id=0){
            if ($id==0){
                return json(array('code' => 0, 'msg' => '亲，你迷路了'));
            }
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->request->isPost()){
                $data=json_decode($_POST['data'],true);
                $note['content']=$data['content'];
                $note['id']=$id;
                if ( $this->note->edit($note)!==false){
                    return json(array('code' => 200, 'msg' => '修改成功' ));
                }else{
                    return json(array('code' => 0, 'msg' => '修改失败'));

                }
            }


        }

    }
    public function zan(){
        $data=$this->request->param();
        $uid = session('userid');
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            $insertdata['type']=$data['type'];
            $insertdata['uid']=$uid;
            $insertdata['sid']=$data['id'];

            $n=Db::name('zan')->where($insertdata)->find();
            if(empty($n)){
                $insertdata['time']=time();
                if(Db::name('zan')->insert($insertdata)){
                    if ($data['type']==3){
                        Db::name('course_ask')->where('id',$data['id'])->setInc('praise');
                    }else if($data['type']==5) {
                        Db::name('course_note')->where('id', $data['id'])->setInc('praise');

                    }else {
                        Db::name('comment')->where('id',$data['id'])->setInc('praise');

                    }
                    return json(array('code'=>200,'msg'=>'操作成功'));
                }else{
                    return json(array('code'=>0,'msg'=>'操作失败'));
                }

            }else{
                return json(array('code'=>0,'msg'=>'你已经赞过啦'));
            }

        }
    }

    /**获取评论树
     * @param $id
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get_comm_reply($id){
        $replys =Db::name('course_ask')->where('tid',$id)->select();
        foreach ($replys as $re) {
            $repUsername = Db::name('user')->where('id',$re['uid'])->find();
            $pc=Db::name('course_ask')->where('id',$re['tid'])->find();
            $parUsername = Db::name('user')->where('id',$pc['uid'])->find();

            $re['pinfo']=$parUsername;
            $re['rinfo']=$repUsername;
            $this->reply[]=$re;
            $this->get_comm_reply($re['id']);
        }
        return  $this->reply;

    }
    public  function  qadetail($aid=0){
        if ($aid==0){
            return       $this->error('亲！您迷路了！');

        }
//        $cid,$vid,
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录',url('index/index/index'));

        }else{
            $ask=$this->ask->where('id',$aid)->find();
            if (empty($ask)){
                return       $this->error('亲！您迷路了！');
            }
            $vid=$ask['vid'];
            $video=Db::name('course_video_collection')->where('id', $vid)->find();
            $cid=$video['cid'];
//        Cache::set('site_config',null);
//        $site_config = Cache::get('site_config');
//        console_log($site_config);
            $course=$this->course->where('id',$cid)->find();

            $answer=$this->ask->alias('a')->join('user u','u.id=a.uid')->where('tid',$aid)->field('a.*,u.id as userid,u.grades,u.point,u.userhead,u.username')->select();
            $answers=array();
            foreach ($answer as $v){
                $v['reply']=$this->get_comm_reply($v['id']);
                $this->reply=array();
                $answers[]=$v;
            }
            $zan = [];
//        foreach ($answers as $value) {
////            print_r($value['reply']);
////            print_r("====================");
//            $zan[] = $value['id'];
//            foreach ($value['reply'] as $item){
//                $zan[] = $item['id'];
//            }
//        }
////               console_log($zan);
            $iszan = Db::name('zan')->where('type', 3)->where('uid', session('userid')) ->column('sid');


            $user=Db::name('user')->where('id',$ask['uid'])->find();
            $this->assign('course',$course);
            $this->assign('video',$video);
            $this->assign('ask',$ask);
            $this->assign('user',$user);
            $this->assign('iszans',$iszan);
            $this->assign('answer',$answers);

            return $this->fetch();
        }

    }

    /**笔记
     * @param int $nid
     * @return mixed|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public  function  notedetail($nid=0){
        if ($nid==0){
            return       $this->error('亲！您迷路了！');

        }
//        $cid,$vid,
            $note=$this->note->where('id',$nid)->find();
            if (empty($note)){
                return       $this->error('亲！您迷路了！');

            }
            $vid=$note['vid'];
            $video=Db::name('course_video_collection')->where('id', $vid)->find();
            $cid=$video['cid'];
//        Cache::set('site_config',null);
//        $site_config = Cache::get('site_config');
//        console_log($site_config);
            $course=$this->course->where('id',$cid)->find();

            $iszan = Db::name('zan')->where('type', 5)->where('uid', session('userid')) ->column('sid');


            $user=Db::name('user')->where('id',$note['uid'])->find();
            $this->assign('course',$course);
            $this->assign('video',$video);
            $this->assign('note',$note);
            $this->assign('user',$user);
            $this->assign('iszans',$iszan);

            return $this->fetch();

    }

    /**最佳答案
     * @return \think\response\Json
     */
    public function bestanswer(){
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if (request()->isPost()) {
                $data=$this->request->post();
               $a= $this->ask->where('id',$data['aid'])->find();
                $vid=$a['vid'];
                $this->ask->where('vid',$vid)->setField('issolve', 0);
                $this->ask->where('id',$a['tid'])->setField('issolve', 1);
               $r= $this->ask->where('id',$data['aid'])->setField('issolve', 1);
                if ($r) {
                    return json(array('code' => 200, 'msg' => '采纳成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '回答采纳失败'));
                }
            }
        }

    }
    public function answer()
    {
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
//            Cache::set('site_config',null);
            $site_config = Cache::get('site_config');
            $id = input('id');
            if (request()->isPost()) {
                if (session('userstatus')==2){
//                    $this->error('您已经被管理员禁言',url('bbs/index/index'));
                    return json(array('code' => 0, 'msg' => '您已经被管理员禁言'));

                }
                $data =json_decode($_POST['data'],true);
                $data['time'] = time();
                $data['vid'] = $id;
                $data['title'] = '回答';
                $data['uid'] = session('userid');

                $this->ask->where('id', $data['tid'])->setInc('reply', 1);
                $n=$this->ask->where('id',$data['tid'])->find();
                $messdata['type']=3;
                $messdata['content']=$data['tid']; //ask id
                $messdata['status']=1;
                $messdata['uid']=session('userid');
                $messdata['touid']=$n['uid'];
                $messdata['time']=time();
                Db::name('message')->insert($messdata);
                if ($this->ask->add($data)) {
                    point_note($site_config['answer'],session('userid'),'answeradd',$n->id);
                    return json(array('code' => 200, 'msg' => '回答成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '回答失败'));
                }
            }
        }
    }

    function  delnote($nid=0){
        if ($nid==0){
            return json(array('code' => 0, 'msg' => '亲，您迷路了'));
        }
        if (!session('userid') || !session('username')) {
            return json(array('code'=>0,'msg'=>'请先登录'));
        }else{
            if ($this->note->destroy($nid)){
                return json(array('code' => 200, 'msg' => '删除成功'));
            }else {
                return json(array('code' => 0, 'msg' => '删除失败'));
            }
        }


    }

    /**扣课程视频积分
     * @param int $vid
     * @param int $cid
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    function watchpoint($vid=0,$cid=0){
        if ($vid==0||$cid==0){
            return json(array('code' => 0, 'msg' => '亲！您迷路了！'));
        }
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录');
        } else {
            if ($this->request->isPost()){
                $data=$this->request->post();
                $v= Db::name('course_video_collection')->where('cid',$cid)->column('id');
                $u=  Db::name('point_note')->where('controller','course')->whereIn('pointid',$v)->column('uid');
                $r=  point_note($data['point'],session('userid')   , 'course',$vid);
                if ($r==-1){
                    return json(array('code' => 0, 'msg' => '用户积分不够，观看失败！'));
                }else{

                    if (!in_array(session('userid'),$u)){
                        Db::name('course')->where('id',$cid)->setInc('learnperson');
                    }
                    $d['cid']=$cid;
                    $d['vid']=$vid;
                    $d['uid']=session('userid');
                    //setField('duration',$data['seconds'])
                    $res=Db::name('user_course')->where($d)->find();
                    if (empty($res)){
                         Db::name('user_course') ->insert($d);
                    }
                    return json(array('code' => 200, 'msg' => '积分扣除成功！'));

                }
            }
        }


    }

}