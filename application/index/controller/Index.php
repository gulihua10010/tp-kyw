<?php

namespace app\index\controller;

use app\common\controller\HomeBase;
use app\common\model\CourseType;
use think\Cache;
use think\Db;

use app\common\model\User as UserModel;
use app\common\model\Nav as NavModel;
use app\common\model\CourseType as CourseTypeModel;
use app\common\model\Info as InfoModel;
use app\common\model\Article as ArticleModel;

class Index extends HomeBase
{
    protected $coursetype;
    protected $article;
    protected $info;
    protected $nav;
    protected $config;

    protected function _initialize()
    {
        parent::_initialize();
        $this->coursetype = new CourseTypeModel();
        $this->info = new InfoModel();
        $this->article = new ArticleModel();
        $this->nav = new NavModel();
    }

    public function index()
    {
        $arttype = $this->info->order('id asc')->limit(0, 5)->select();
        $arts = [];
        foreach ($arttype as $item) {
            $art = $this->article->where('infoid', $item['id'])->limit(0, 8)->select();
            foreach ($art as $v) {
                $v['content'] = msubstr(clearHtml($v['content']), 0, 20, "utf-8", true);
            }
            $a['arts'] = $art;
            $a['infoid'] = $item['id'];
            $a['info'] = $item['name'];
            $arts[]=$a;
        }
        $newest_arts = $this->article->order('time desc')->limit(0, 8)->select();
        foreach ($newest_arts as $v) {
                $v['content'] = msubstr(clearHtml($v['content']), 0, 70, "utf-8", true);
        }
        $ppt = [];
        $v = array();
        $config=$this->getConfig();
        foreach ($config as $value) {

            $path = preg_match_all('/^ppt[\d]$/is', $value['name'], $res);
            $url = preg_match_all('/^ppt[\d]_url/is', $value['name'], $res);
            if ($url != false && $url > 0) {
                if ($value['value'] == '' || empty($value['value'])) {
                    $value['value'] = '#';
                }
//                 var_dump($value);
//                 var_dump('<br/>');
                $v['url'] = $value['value'];
            } else if ($path != false && $path > 0) {
                $v['path'] = $value['value'];
//                var_dump($value);
//                 var_dump('<br/>');
            }
            if (!empty($v['path']) && !empty($v['url'])) {
                $ppt[] = $v;
                $v = array();
            }

        }
        $pptnav = $this->nav->getlist_by_type(3);
//
//        foreach ($ppt as  $v){
//            var_dump($v);
//            var_dump('<br/>');
//
//        }

        $this->assign('arts', $arts);
        $this->assign('pptnav', $pptnav);
        $this->assign('ppt', $ppt);
        $this->assign('arttype', $arttype);
        $this->assign('newest_arts', $newest_arts);


        return view();
    }

   public  function  test(){


        return $this->fetch();
    }
}
