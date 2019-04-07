<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 14:23
 */

namespace app\admin\controller;

use app\common\model\Course as CourseModel;
use app\common\model\CourseType as CourseTypeModel;
use app\common\controller\AdminBase;
use think\Db;

/**
 * Class Course课程
 * @package app\admin\controller
 */
class Course extends AdminBase
{
    protected $course_type_model;
    protected $course_model;

    protected function _initialize()
    {
        parent::_initialize();
        $this->course_type_model = new CourseTypeModel();
        $this->course_model = new CourseModel();
        $types = $this->course_type_model->getlist();
        $this->assign('types', $types);

    }

    public function index($keyword = '', $page = 1)
    {
        $map = [];
        if ($keyword) {
            session('coursekeyword', $keyword);
            $map['c.name|c.keywords'] = ['like', "%{$keyword}%"];
        } else {
            if (session('coursekeyword') != '' && $page > 1) {
                $map['c.name|c.keywords'] = ['like', "%" . session('coursekeyword') . "%"];
            } else {
                session('coursekeyword', null);
            }
        }
        $courselist = $this->course_model->alias('c')->join('course_type ct', 'ct.id=c.cid')->field('c.*,ct.name as typename')->order('c.time desc,c.id asc')->where($map)->paginate(10);;
        $this->assign('course', $courselist);
//        console_log($courselist);
        return $this->fetch();

    }

    public function add()
    {
        return $this->fetch('add');

    }

    /**视频集
     * @param int $cid
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function videocollect($cid=0)
    {
        $arrs=   Db::name('course_video_collection')->where('cid',$cid)->where('pid',0)->select();
        $arr=array();
        foreach ($arrs as $item) {
            $item['child']= Db::name('course_video_collection')->where('cid',$cid)->where('pid',$item['id'])->select();
            $arr[]=$item;
        }
        if (empty($arr)||$arr==null){
            $flag=-1;
        }else if (!empty($arr)){
            $flag=$cid;
        }else{
            $flag=-1;
        }
        $this->assign('arr',$arr);
        $this->assign('cid',$flag);
        return $this->fetch('videocollect');

    }
//$insert['cid']=-1;
//$insert['pid']=0;
//$insert['time']=time();
//$insert['name']=$title1;
//getLastInsID
    /**保存视频集
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function save_videocollect()
    {

        if ($this->request->isPost()) {
            $data = $this->request->post();
            $cid=$data['cid'];
            $flag1=false;
            $flag2=false;
            $insert1=array();
            $insert2=array();
            $pid=0;
            Db::startTrans();
            $isF = true;
            try {
                Db::name('course_video_collection')->where('cid',$cid)->delete();
            foreach ($data as $key=>$datum) {
                $title1=preg_match_all('/title1/is',$key,$mat1);
                $title2=preg_match_all('/title2/is',$key,$mat2);
                $path=preg_match_all('/path/is',$key,$mat3);
                $duration=preg_match_all('/duration/is',$key,$mat4);
                if ($title1!=false||$title1>0){
                    $insert1['name']=$datum;
                    $insert1['time']=time();
                    $insert1['pid']=0;
                    $insert1['cid']=$cid;
                    Db::name('course_video_collection')->insert($insert1);
                    $pid=  Db::name('course_video_collection')->getLastInsID();
                    $insert1=array();
                }
                if ($title2!=false||$title2>0){
                    $insert2['name']=$datum;
                }
                if ($path!=false||$path>0){
                    $insert2['video']=$datum;
                }
                if ($duration!=false||$duration>0){
                    $insert2['duration']=$datum;
                    $insert2['time']=time();
                    $insert2['pid']=$pid;
                    $insert2['cid']=$cid;
                    Db::name('course_video_collection')->insert($insert2);
                    $insert2=array();
                }

            }
                Db::commit();
            } catch (\Exception $e) {
                $isF = false;
                Db::rollback();
            }
          $arrs=   Db::name('course_video_collection')->where('cid',$cid)->where('pid',0)->select();
          $arr=array();
            foreach ($arrs as $item) {
                //                $item['child']
                $item['child']= Db::name('course_video_collection')->where('cid',$cid)->where('pid',$item['id'])->select();
                $arr[]=$item;
          }
            if ($isF) {
                //$this->success('提交成功');
                return json(array('code' => 200, 'msg' => '提交成功','data'=>$arr,'pic'=>$data['first-video-pic']));
            } else {
                // $this->error('提交失败');
                return json(array('code' => 0, 'msg' => '提交失败'));
            }

        }
    }


    public function toggle($id, $status, $name)
    {
        if ($this->request->isGet()) {
            if ($this->course_model->where('id', $id)->update([$name => $status]) !== false) {
                return json(array('code' => 200, 'msg' => '更新成功'));
            } else {
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }

    }

    public function save()
    {
        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'], true);
            $validate_result = $this->validate($data, 'course');
            if ($validate_result !== true) {
                return json(array('code' => 0, 'msg' => $validate_result));
            } else {
                if ($data['point'] == '' || empty($data['point'])) {
                    $point = Db::name('system')->where('name', 'point_course')->find();
                    $data['point'] = $point['value'];
                }
                $classhour= Db::name('course_video_collection')-> where('cid',-1)->where('pid',0)->count();
                $data['classhour'] = $classhour;

                if ($this->course_model->allowField(true)->save($data)) {
                    Db::name('course_video_collection')-> where('cid',-1)->setField('cid',$this->course_model->id);

                    return json(array('code' => 200, 'msg' => '添加成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '添加失败'));
                }
            }

        }

    }

    public function update()
    {
        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'], true);
            if ($this->course_model->allowField(true)->save($data, $data['id']) !== false) {
                return json(array('code' => 200, 'msg' => '更新成功'));
            } else {
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }
    }


    public function edit($id)
    {
        $course = $this->course_model->find($id);
        $arrs=   Db::name('course_video_collection')->where('cid',$id)->where('pid',0)->select();
        $arr=array();
        foreach ($arrs as $item) {
            $item['child']= Db::name('course_video_collection')->where('cid',$id)->where('pid',$item['id'])->select();
            $arr[]=$item;
        }
        $this->assign('arr',$arr);
        return $this->fetch('edit', ['course' => $course]);
    }

    public function delete($id)
    {

        if ($this->course_model->destroy($id)) {
            Db::name('course_video_collection')->where('cid',$id)->delete();
            return json(array('code' => 200, 'msg' => '删除成功'));
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }

}