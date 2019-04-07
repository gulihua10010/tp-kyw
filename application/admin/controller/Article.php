<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/25
 * Time: 14:57
 */

namespace app\admin\controller;

use app\common\model\Article as ArticleModel;
use app\common\controller\AdminBase;
use app\common\model\Info as InfoModel;

/**
 * Class Article资讯文章
 * @package app\admin\controller
 */
class Article extends  AdminBase
{
    protected  $info;
    protected  $article;
    public  function  _initialize()
    {
        parent::_initialize();

        $this->info=new InfoModel();
        $this->article=new ArticleModel();
        $info=$this->info->select();
        $this->assign('infos',$info);

    }
    public function  index($keyword = '', $page = 1){
        $map = [];
        if ($keyword) {
            session('articlekeyword', $keyword);
            $map['a.title|a.keywords|a.content'] = ['like', "%{$keyword}%"];
        }else{
            if(session('articlekeyword')!=''&&$page>1){
                $map['a.title|a.keywords|a.content']  = ['like', "%".session('articlekeyword')."%"];
            }else{
                session('articlekeyword',null);
            }
        }

        $articlelist=$this->article-> alias('a')->join('info i','i.id=a.infoid') ->field('a.*,i.name as infoname')
            ->order('a.time desc,a.id asc')->where($map)->paginate(10);;
        $this->assign('articlelist',$articlelist);

        return $this->fetch();

    }

    public  function  add(){

        return $this->fetch('add');

    }
    public function  save(){
    if ($this->request->isPost()){
        $data=json_decode($_POST['data'],true);
        $validate_result = $this->validate($data, 'article');
        if ($validate_result !== true) {
            $this->error($validate_result);
        } else {
            $data['content']=htmlspecialchars_decode($data['content']);
            if ($this->article->allowField(true)->save($data) !== false) {
                return json(array('code' => 200, 'msg' => '保存成功'));
            } else {
                return json(array('code' => 0, 'msg' => '保存失败'));
            }
        }
    }

   }

    /**switch 精选|显示
     * @param $id
     * @param $status
     * @param $name
     * @return \think\response\Json
     */
    public function toggle($id,$status,$name)
    {
        if ($this->request->isGet()) {
            if ($this->article->where('id', $id)->update([$name=>$status]) !== false) {
                //  $this->success('更新成功');
                return json(array('code' => 200, 'msg' => '更新成功'));
            } else {
                // $this->error('更新失败');
                return json(array('code' => 0, 'msg' => '更新失败'));
            }
        }

    }
    public  function  edit($id){

        $art=$this->article->find($id);
//        $art['content']=formatHTML($art['content']);
        return $this->fetch('edit',['art'=>$art]);

    }
    public  function  update(){
        if ($this->request->isPost()) {
            $data=json_decode($_POST['data'],true);
            $validate_result = $this->validate($data, 'article');
            if ($validate_result !== true) {
                $this->error($validate_result);
            } else{  $data['content']=htmlspecialchars_decode($data['content']);
                    if ($this->article->allowField(true)->save($data,$data['id']) !== false) {
                        return json(array('code' => 200, 'msg' => '更新成功'));
                    } else {
                        return json(array('code' => 0, 'msg' => '更新失败'));
                    }


            }
        }


    }

    public function delete($id)
    {
        if ($this->article->destroy($id)) {
            return json(array('code' => 200, 'msg' => '删除成功'));
            //   $this->success('删除成功');
        } else {
            return json(array('code' => 0, 'msg' => '删除失败'));
            //   $this->error('删除失败');
        }
    }
}