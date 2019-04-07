<?php
namespace app\common\model;
use think\Model;
use think\File;
use think\Db;
use app\common\model\File as FileModel;
class Upload extends Model
{
	
	function initialize()
	{
		parent::initialize();
	}

	public function upfile($type,$filename = 'file',$is_water = false){
		$file = request()->file($filename);
		
		$filemode=new FileModel();
		$md5=$file->hash('md5');
		$n=$filemode->where('md5',$md5)->find();
		
		if(empty($n)){
			if ($type=='images'){
                $info = $file->validate(['size'=>10000000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . DS . 'uploads');

            }else if ($type=='videos'){
                $info = $file->validate(['size'=>1024000000,'ext'=>'mp4,rm,rmvb,mpeg,mov,mtv,dat,wmv,avi ,3gp,amv,dmv,flv'])->move(ROOT_PATH . DS . 'uploads');

            }else{
                $info = $file->validate(['size'=>1024000000])->move(ROOT_PATH . DS . 'uploads');

            }

			if($info){
				
				$path = DS . 'uploads' . DS .$info->getSaveName();
				$path=str_replace("\\","/",$path);
				$realpath=WEB_URL.$path;
				$data['sha1']=$info->sha1();
				$data['md5']=$info->md5();
				$data['create_time']=time();
				$data['location']=1;
				$data['ext']=$info->getExtension();
				$data['size']=$info->getSize();
				$data['savepath']=$path;
				$data['savename']=$info->getFilename();
				$data['download']=0;
				$fileinfo=$info->getInfo();
				$data['name']=$fileinfo['name'];
				$data['mime']=$fileinfo['type'];

                $svename=convert_from_latin1_to_utf8_recursively($info->getSaveName());
                $filename=convert_from_latin1_to_utf8_recursively($info->getFilename());
                $infos=convert_from_latin1_to_utf8_recursively($info->getInfo());
				if($filemode->save($data)){
					return array('code'=>200,'msg'=>'上传成功','id'=>$filemode->id,'path'=>$path,'headpath'=>$realpath,'savename'=>$svename,'filename'=>$filename,'info'=>$infos);
				}else{
					return array('code'=>0,'msg'=>'上传失败');
				}
			}else{
				return array('code'=>0,'msg'=>$file->getError());
			}
		}else{
			$path = $n['savepath'];
			$realpath=WEB_URL.$path;
			return array('code'=>200,'msg'=>'上传成功','id'=>$n['id'],'path'=>$path,'headpath'=>$realpath,'savename'=>$n['savename'],'filename'=>$n['name'],'info'=>$n);
		}
	}

    public function upblob($type,$filename = 'file',$is_water = false){
//        $file = request()->file($filename);
//
//        $filemode=new FileModel();
        $file = request()->file($filename);

        $filemode=new FileModel();
//        $md5=$file->hash('md5');
//        $n=$filemode->where('md5',$md5)->find();
                $info = $file->rule('md5')->validate(['size'=>5000000])->move(ROOT_PATH . DS . 'uploads');


            if($info){
                $md5=$info->md5();
                $n=$filemode->where('md5',$md5)->find();
                if (empty($n)){
                    $path = DS . 'uploads' . DS .$info->getSaveName();
                    $path=str_replace("\\","/",$path);
                    $realpath=WEB_URL.$path;

                    $data['sha1']=$info->sha1();
                    $data['md5']=$md5;
                    $data['create_time']=time();//;
                    $data['location']=1;
                    $data['ext']=$info->getExtension();
                    $data['size']=$info->getSize();
                    $data['savepath']=$path;
                    $data['savename']=$info->getFilename();
                    $data['download']=0;
                    $fileinfo=$info->getInfo();
                    $data['name']=$fileinfo['name'];
                    $data['mime']=$fileinfo['type'];
                    $svename=convert_from_latin1_to_utf8_recursively($info->getSaveName());
                    $filename=convert_from_latin1_to_utf8_recursively($info->getFilename());
                    $infos=convert_from_latin1_to_utf8_recursively($info->getInfo());
                    if($filemode->save($data)){

                        return array('code'=>200,'msg'=>'上传成功','id'=>$filemode->id,'path'=>$path,'headpath'=>$realpath,'savename'=>$svename,'filename'=>$filename,'info'=> $infos);
                    }else{
                        return array('code'=>0,'msg'=>'上传失败');
                    }

                }else{
                    $path = $n['savepath'];

                    $realpath=WEB_URL.$path;
                    return array('code'=>200,'msg'=>'上传成功','id'=>$n['id'],'path'=>$path,'headpath'=>$realpath,'savename'=>$n['savename'],'filename'=>$n['name'],'info'=>$n);

                }


            }else{
                return array('code'=>0,'msg'=>$file->error());
            }



    }
}