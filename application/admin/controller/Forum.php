<?php
namespace app\admin\controller;
use app\common\model\Forum as ForumModel;
use app\common\model\Forumcate as ForumcateModel;
use app\common\controller\AdminBase;
use think\Db;


class Forum extends AdminBase
{
	protected $forum_model;
    protected function _initialize()
    {
        parent::_initialize();
        $this->forum_model = new ForumModel();
    }


 public function index($keyword = '', $page = 1)
    {
        $map = [];
      
        if ($keyword) {
        	session('forumkeyword',$keyword);
        	 $map['title|f.keywords']  = ['like', "%{$keyword}%"];
        }else{
        
        	if(session('forumkeyword')!=''&&$page>1){
        		 $map['title|f.keywords']  = ['like', "%".session('forumkeyword')."%"];
        	}else{
        		session('forumkeyword',null);
        	}
        }


        $forum_list = $this->forum_model->alias('f')->join('forumcate c', 'c.id=f.tid')->field('f.*,c.id as cid,c.name')->order('f.id desc')->where($map)->paginate(10);
        //$user_list = $this->forum_model->where($map)->order('id DESC')->paginate(10, false, ['page' => $page]);

        return $this->fetch('index', ['forum_list' => $forum_list, 'keyword' => $keyword]);
    }

    public function toggle($id,$status,$name)
    {
    	if ($this->request->isGet()) {
    
    
    		 
    		 
    		if ($this->forum_model->where('id', $id)->update([$name=>$status]) !== false) {
    			//  $this->success('更新成功');
    			return json(array('code' => 200, 'msg' => '更新成功'));
    		} else {
    			// $this->error('更新失败');
    			return json(array('code' => 0, 'msg' => '更新失败'));
    		}
    	}
    	 
    }
    /**
     * 编辑分类
         * @param $id
     * @return mixed
     */
    public function edit($id)
    {
    	$category = new ForumcateModel();
    	
    	$tptcs = $category->catetree();
    	$this->assign(array('tptcs' => $tptcs));
        $slide_category = $this->forum_model->find($id);

        return $this->fetch('edit', ['slide_category' => $slide_category]);
    }

    /**
     * 更新分类
     * @throws \think\Exception
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'],true);
           $data['content']= remove_xss($data['content']);
           $data['title']=  $data['title'];
            if ($this->forum_model->allowField(true)->save($data,$data['id']) !== false) {
                return json(array('code' =>200, 'msg' => '更新成功'));
            } else {
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }
    }

    /**
     * 删除分类
     * @param $id
     * @throws \think\Exception
     */
    public function delete($id)
    {
    	$info=$this->forum_model->find($id);
    	$score=getpoint($info['uid'],'forumadd',$id);
    	point_note(0-$score,$info['uid'],'forumdelete',$id);
    	
    	
        if ($this->forum_model->destroy($id)) {
        	
        	
        	
            	return json(array('code' => 200, 'msg' => '删除成功'));
        } else {
           return json(array('code' => 0, 'msg' => '删除失败'));
        }
    }
    public function alldelete()
    {
    	$params = input('post.');
    	foreach ($params['ids'] as $k =>$v){
    		$info=$this->forum_model->find($v);
    	$score=getpoint($info['uid'],'forumadd',$v);
    	point_note(0-$score,$info['uid'],'forumdelete',$v);	
    		
    	}
    	
    	
    	$ids = implode(',', $params['ids']);
    	
    	
    	
    	
    	
    	  $result = $this->forum_model->destroy($ids);
    	  if ($result) {
    	  	return json(array('code' => 200, 'msg' => '删除成功'));
    	  } else {
    	  	return json(array('code' => 0, 'msg' => '删除失败'));
    	  }
   }
}