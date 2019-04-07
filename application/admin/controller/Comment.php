<?php
namespace app\admin\controller;

use app\common\controller\AdminBase;
use think\Db;
use app\common\model\Comment as CommentModel;

class Comment extends AdminBase
{
	protected $commentmodel;
    protected function _initialize()
    {
        parent::_initialize();
        $this->commentmodel = new CommentModel();
    }
    public function index()
    {
    	
    	$tptc = $this->commentmodel->alias('c')->join('user m', 'm.id=c.uid')->field('c.*,m.username')->order('c.id desc')->paginate(15);
    	$this->assign('tptc', $tptc);
    	return view();
    }
   protected function delcomms($sub){
        foreach ($sub as $v ){
            $sub1=Db::name('comment')->where('tid',$v['id'])->where('type',$v['type'])->select();
            if (!empty($sub1)){
                $this->delcomms($sub1);
            }else{
                 Db::name('comment')->where('id',$v['id'])->delete();
            }
        }

   }
  public function delete($id)
    {
    	$info=$this->commentmodel->find($id);
    	Db::name('forum')->where('id',$info['fid'])->setDec('reply');
    	$score=getpoint($info['uid'],'commentadd',$id);
    	point_note(0-$score,$info['uid'],'commentdelete',$id);
//        $sub=Db::name('comment')->where('tid',$info['id'])->where('type',$info['type'])->select();
//        $this->delcomms($sub);
    	
        if ($this->commentmodel->destroy($id)) {
            	return json(array('code' => 200, 'msg' => '删除成功'));
        } else {
           return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }
    public function alldelete()
    {
    	$params = input('post.');
    foreach ($params['ids'] as $k =>$v){
    		$info=$this->commentmodel->find($v);
    		Db::name('forum')->where('id',$info['fid'])->setDec('reply');
    		
    		
    	$score=getpoint($info['uid'],'commentadd',$v);
    	point_note(0-$score,$info['uid'],'commentdelete',$v);	
    		
    	}
    	$ids = implode(',', $params['ids']);
    	  $result = $this->commentmodel->destroy($ids);
    	  if ($result) {
    	  	return json(array('code' => 200, 'msg' => '删除成功'));
    	  } else {
    	  	return json(array('code' => 0, 'msg' => '删除失败'));
    	  }
   }
}