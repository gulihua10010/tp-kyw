<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:57:"E:\phpStudy\WWW\kyw/application/bbs\view\index_index.html";i:1548942254;s:56:"E:\phpStudy\WWW\kyw\application\bbs\view\index_base.html";i:1548851774;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_header.html";i:1548855238;s:56:"E:\phpStudy\WWW\kyw\application\bbs\view\index_menu.html";i:1547377358;s:57:"E:\phpStudy\WWW\kyw\application\bbs\view\index_right.html";i:1547377358;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_footer.html";i:1548923454;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title><?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <!--<link rel="stylesheet" href="/kyw/public/plugins/layui/css/modules/layer/default/layer.css">-->
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <!--<script src="/kyw/public/plugins/layui/lay/modules/layer.js"></script>-->
    <script src="/kyw/public/js/common.js"></script>
    <script src="/kyw/public/js/gt.js"></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav-bbs">
        <ul>
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <li   >
         <span><a  href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><i class="iconfont"><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?></a></span>
          <ul>
              <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
              <li> <span><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></span></li>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
      </li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="nav-user">

  <?php if(\think\Session::get('userid') != ''): ?>
     <!-- 登入后的状态 -->
      <a class="avatar" href="<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>">
        <img src="/kyw<?php echo \think\Session::get('userhead'); ?>">
        <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
        <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
      </a>
      <div class="nav">
        <a href="<?php echo url('user/index/set'); ?>"   style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
        <a data-url="<?php echo url('user/index/logout'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
            <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
      </div>
    <?php else: ?>
        <!-- 未登入状态 -->
        <div class="lg-reg">
        <a class="unlogin"  onclick="showLogin();" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
        <span  class="unlogin-btn" style="cursor: pointer">
          <a onclick="showLogin();" style="color:#fff;">登录</a><a onclick="showReg();"  style="color:#fff;">注册</a></span></div>
        <?php endif; ?>
    </div>
  </div>
</div>


<div class="main layui-clear">

<style>
ul li{
    list-style: none;
}

</style>


  <div class="wrap">
    <div class="content">
        <div class="fly-tab fly-tab-index">
        <span>
          <a href="<?php echo url('bbs/index/index'); ?>">全部</a>
      
          <a href="<?php echo url('bbs/index/choice'); ?>">精帖</a>
          <a href="<?php echo url('user/index/topic'); ?>">我的帖</a>
        </span>
        <form action="<?php echo url('bbs/index/search'); ?>" class="fly-search">
        <button style="position: absolute;right: 0;top: 2px;border: 0px solid #fff;background-color: #fff" type="submit">
            <i class="iconfont " style="font-size: 30px ;position:relative;top:2px">&#xe616;</i></button>
          <input autocomplete="off" placeholder="搜索" type="text" name="ks" value="<?php echo input('ks');?>" required lay-verify="required" class="layui-input">
        </form>
        <a href="<?php echo url('bbs/forum/add'); ?>" class="layui-btn jie-add" style="background-color: rgb(23,179,241); border-radius: 5px">发布帖子</a>
      </div>
      <ul class="fly-list fly-list-top">
        <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="fly-list-li">
          <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" class="fly-list-avatar">
             <img src="<?php echo getheadurl($vo['userhead']); ?>" alt="<?php echo $vo['username']; ?>">
          </a>
          <h2 class="fly-tip">
            <a href="<?php echo url('index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
            <span class="fly-tip-stick">置顶</span>
            <?php if($vo['choice'] == 1): ?><span class="fly-tip-jing">精帖</span><?php endif; ?>
          </h2>
          <p>
            <span><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"><?php echo $vo['username']; ?></a></span>
            <span><?php echo friendlyDate($vo['time']); ?></span>
            <span><?php echo $vo['name']; ?></span>
            <span class="fly-list-hint"> 
             <i class="iconfont" title="回答">&#xe6b7;</i>  <?php echo $vo['reply']; ?>
              <i class="iconfont" title="人气">&#xe6a5;</i><?php echo $vo['view']; ?>
            </span>
          </p>
        </li>
       <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      
      <ul class="fly-list">
          <?php if(is_array($tptcs) || $tptcs instanceof \think\Collection || $tptcs instanceof \think\Paginator): $i = 0; $__LIST__ = $tptcs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?> <li class="fly-list-li">
          <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" class="fly-list-avatar">
            <img src="/kyw<?php echo $vo['userhead']; ?>" alt="<?php echo $vo['username']; ?>">
          </a>
          <h2 class="fly-tip">
            <a href="<?php echo url('index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
             <?php if($vo['choice'] == 1): ?><span class="fly-tip-jing">精帖</span><?php endif; ?>
          </h2>
          <p>
            <span><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"><?php echo $vo['username']; ?></a></span>
            <span><?php echo friendlyDate($vo['time']); ?></span>
            <span><?php echo $vo['name']; ?></span>
            <span class="fly-list-hint"> 
              <i class="iconfont" title="回答">&#xe6b7;</i>  <?php echo $vo['reply']; ?>
              <i class="iconfont" title="人气">&#xe6a5;</i><?php echo $vo['view']; ?>
            </span>
          </p>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <div class="btable-paged  " style="text-align: center;    " ><?php echo $tptcs->render(); ?></div>
    </div>
  </div>

  <div class="edge">
    <div class="fly-panel leifeng-rank"> 
      <h3 class="fly-panel-title">近一月发帖榜 - TOP 12</h3>
      <dl>
      
       <?php if(is_array($tptm) || $tptm instanceof \think\Collection || $tptm instanceof \think\Paginator): $i = 0; $__LIST__ = $tptm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <dd>
          <a href="<?php echo url('user/index/home',array('id'=>$vo['id'])); ?>">
            <img src="<?php echo getheadurl($vo['userhead']); ?>">
            <cite><?php echo $vo['username']; ?></cite>
            <i><?php echo $vo['forumnum']; ?>帖子</i>
          </a>
        </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </dl>
    </div>
    	<div class="fly-panel fly-link leifeng-rank" style="padding-bottom: 0;"> 
      <h3 class="fly-panel-title">版块列表</h3>
      <ul>
	    <?php if(is_array($tpto) || $tpto instanceof \think\Collection || $tpto instanceof \think\Paginator): $i = 0; $__LIST__ = $tpto;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo url('bbs/index/view',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?>(<?php echo $vo['count']; ?>)</a></li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">最近热帖</dt>
       <?php if(is_array($tptf) || $tptf instanceof \think\Collection || $tptf instanceof \think\Paginator): $i = 0; $__LIST__ = $tptf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <dd>
        <a href="<?php echo url('bbs/index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
        <span><i class="iconfont" style="color: rgb(255,165,0)"> &#xe6a5;</i> <?php echo $vo['view']; ?></span>
      </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </dl>
    
    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">精选帖子</dt>
      <?php if(is_array($tpte) || $tpte instanceof \think\Collection || $tpte instanceof \think\Paginator): $i = 0; $__LIST__ = $tpte;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <dd>
        <a href="<?php echo url('index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
        <span><i class="iconfont">&#xe62c;</i> <?php echo $vo['view']; ?></span>
      </dd>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </dl>

  </div>

<?php if(session('userid') > 0): ?>
        <a href="<?php echo url('forum/add'); ?>" class="site-tree-mobile-edit layui-hide">
    <i class="iconfont icon-fabu"></i>
  </a>
  <?php endif; ?>
</div>

				
<div class="footer">
    <div class="content-index clearfix">
        <div class="footnav">
            <ul>
                <?php if(is_array($footnav) || $footnav instanceof \think\Collection || $footnav instanceof \think\Paginator): $i = 0; $__LIST__ = $footnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><?php echo $vo['name']; ?></a>
                    <ul>
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>
        <span>
            <?php if($site_config['site_icp'] != ''): ?>
            ICP备案号:<?php echo $site_config['site_icp']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_copyright'] != ''): ?>
            版权信息:<?php echo $site_config['site_copyright']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_tongji'] != ''): ?>
            <?php echo $site_config['site_tongji']; endif; ?>

        </span>


    </div>
</div>    
 

<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

</body>
</html>
<script>
    console.log('%c 考研网','color:#1BC7F1;font-size:30px;font-weight: bold ');


</script>