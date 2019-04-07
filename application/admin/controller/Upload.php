<?php
namespace app\admin\controller;
use app\common\model\Upload as UploadModel;

use app\common\model\File as FileModel;
//use app\common\model\File as FileModel;
use app\common\controller\AdminBase;
use think\Controller;

class Upload extends  Controller
{
    protected  $filemodel;
    function _initialize()
    {
    	
        parent::_initialize();
        $this->filemodel=new UploadModel();
    }
    public function upimage()
    {
    	
   // return 	$this->model->upfile('images');
    	 return json($this->filemodel->upfile('images'));
    }

    public function upvideo()
    {

        // return 	$this->model->upfile('images');
        return json($this->filemodel->upfile('videos'));
    }
    public function upblob()
    {

        // return 	$this->model->upfile('images');
        return json($this->filemodel->upblob('videos'));
    }
    public function upfile()
    {
        return json($this->filemodel->upfile('files'));
    }
    public function layedit_upimage()
    {
        $result = $this->filemodel->upfile('layedit', 'file', true);
        if ($result['code'] == 200) {
            $data = array('code' => 0, 'msg' => '上传成功', 'data' => array('src' => $result['path'], 'title' => $result['info']['name']));
        } else {
            $data = array('code' => 1, 'msg' => $result['msg']);
        }
        return json($data);
    }
    public function umeditor_upimage()
    {
        $result = $this->filemodel->upfile('umeditor', 'upfile', true);
        if ($result['code'] == 200) {
            $data = array("originalName" => $result['info']['name'], "name" => $result['savename'], "url" => $result['path'], "size" => $result['info']['size'], "type" => $result['info']['type'], "state" => "SUCCESS");
        } else {
            $data = array("originalName" => $result['info']['name'], "name" => $result['savename'], "url" => $result['path'], "size" => $result['info']['size'], "type" => $result['info']['type'], "state" => $result['msg']);
        }
        echo json_encode($data);
        exit;
    }
//upothedrfile

    public function upotherfile( ){
        $file = request()->file('file');
//        $md5=$file->hash('md5');
        $n=$this->filemodel->where('md5','d')->find();

        if(empty($n)){
                $info = $file->validate(['size'=>5000000])->move(ROOT_PATH . DS . 'uploads');

            if($info){

//                $path = DS . 'uploads' . DS .$info->getSaveName();
//                $path=str_replace("\\","/",$path);
//                $realpath=WEB_URL.$path;
//                $data['sha1']='dddd';
//                $data['md5']='dddd';
//                $data['create_time']=time();
//                $data['location']=1;
//                $data['ext']=$info->getExtension();
//                $data['size']=$info->getSize();
//                $data['savepath']=$path;
//                $data['savename']=$info->getFilename();
//                $data['download']=0;
//                $fileinfo=$info->getInfo();
//                $data['name']=$fileinfo['name'];
//                $data['mime']=$fileinfo['type'];

//                if($info){
//                    return array('code'=>200,'msg'=>'上传成功','id'=>$this->filemodel->id,'path'=>$path,'headpath'=>$realpath,'savename'=>$info->getSaveName(),'filename'=>$info->getFilename(),'info'=>$info->getInfo());
//                }else{
//                    return array('code'=>0,'msg'=>'上传失败');
//                }
            }else{
                return array('code'=>0,'msg'=>$info->getError());
            }
        }else{
            $path = $n['savepath'];
            $realpath=WEB_URL.$path;
            return array('code'=>200,'msg'=>'上传成功','id'=>$n['id'],'path'=>$path,'headpath'=>$realpath,'savename'=>$n['savename'],'filename'=>$n['name'],'info'=>$n);
        }
    }

}