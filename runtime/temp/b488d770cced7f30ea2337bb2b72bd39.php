<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"E:\phpStudy\WWW\kyw/application/index\view\index_topic.html";i:1546847348;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1546587990;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1546789414;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1546787432;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>用户设置|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public//images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public//plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public//css/globals.css">
	<?php if($site_config['tplh'] == 1): ?>
	<link rel="stylesheet" href="/kyw/public//css/full.css">
	<?php endif; ?>
    
<script src="/kyw/public//plugins/layui/layui.js"></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav">
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pid'] == '1'): ?>
      <a class="nav-this" href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>"  >
          <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <div class="nav-user">
    
  <?php if(\think\Session::get('userid') != ''): ?>
     <!-- 登入后的状态 -->
      <a class="avatar" href="<?php echo url('user/home',array('id'=>\think\Session::get('userid'))); ?>">
        <img src="<?php echo getheadurl(\think\Session::get('userhead')); ?>">
        <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
        <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
      </a>
      <div class="nav">
        <a href="<?php echo url('index/user/set'); ?>"   style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
        <a data-url="<?php echo url('index/user/logout'); ?>" location-url="<?php echo url('index/user/login'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
            <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
      </div>
    <?php else: ?>
          <!-- 未登入状态 -->
      <a class="unlogin"  href="<?php echo url('index/login'); ?>" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
      <span  class="unlogin-btn">
          <a href="<?php echo url('index/user/login'); ?>"  style="color:#fff;">登录</a><a href="<?php echo url('index/user/reg'); ?>"  style="color:#fff;">注册</a></span>
       <?php endif; ?>

    </div>
  </div>
</div>


<div class="main layui-clear">

<style type="text/css">
    .user-set{
        background-color: rgb(251,251,251)!important;
    }
    .user-set li a{
        color: #0C0C0C !important;
    }
    .tab-this a{
        background-color: rgb(23,179,241 ) !important;;
    }
    .tab-this a>i{
        color: white !important;
    }
    .user-set li a:hover{
        background-color: rgba(23,179,241 ,0.7) !important;;
    }

    .panel-user{
        padding: 0 20px!important;
    }
</style>
<div class="main fly-user-main layui-clear">
    <ul class="layui-nav layui-nav-tree layui-inline user-set"  lay-filter="user"  >
        <li class="layui-nav-item">
            <a href="<?php echo url('user/home',array('id'=>$uid)); ?>">
                &nbsp;<i class="iconfont">&#xe607;</i>
                我的主页
            </a>
        </li>
        <li class="layui-nav-item tab-this">
            <a href="<?php echo url('user/topic'); ?>"  style="color: white !important;">
                &nbsp;<i class=" iconfont">&#xe62d;</i>
                我的帖子
            </a>
        </li>
        <li class="layui-nav-item  ">
            <a href="<?php echo url('user/comment'); ?>">
                &nbsp;<i class="iconfont">&#xe644;</i>
                我的回复
            </a>
        </li>
        <li class="layui-nav-item ">
            <a href="<?php echo url('user/message'); ?> " >
               &nbsp;<i class="iconfont">&#xe61b;</i>
                我的消息
            </a>
        </li>
        <li class="layui-nav-item  " >
            <a href="<?php echo url('user/set'); ?>"  >
                &nbsp;<i class="iconfont">&#xe65f;</i>
                基本设置
            </a>
        </li>

    </ul>
  <script>

layui.use(['jquery'],function(){
  var jq = layui.jquery;
var n=1;
  jq('.site-tree-mobile').click(function(){
	  
	  if( n==2){
		  jq('.layui-nav').animate({left: '-300px'}, "fast");
		 jq(this).find('.layui-icon').html('&#xe602;');
		  n=1;
	  }else{
		  n=2;
		  jq('.layui-nav').animate({left: '0px'}, "fast");
		  jq(this).find('.layui-icon').html('&#xe603;');
	  }
  });
})
  </script>
  <div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
  </div>
  <div class="site-mobile-shade"></div>
  
  <div class="fly-panel fly-panel-user" pad20>
    <!--
    <div class="fly-msg" style="margin-top: 15px;">
      您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
    </div>
    -->
    <div class="layui-tab layui-tab-brief" lay-filter="user">
      <ul class="layui-tab-title" id="LAY_mine">
        <li data-type="mine-jie" lay-id="index" class="layui-this">我发的帖（<span><?php echo $count; ?></span>）</li>
      
        
      </ul>
      <div class="layui-tab-content" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
                   <ul class="mine-view jie-row">
            <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<li>
<a href="<?php echo url('index/thread',array('id'=>$vo['id'])); ?>" target="_blank" class="jie-title"><?php echo $vo['title']; ?></a>
              <i><?php echo friendlyDate($vo['time']); ?></i>
             <a class="mine-edit" href="<?php echo url('bbs/forum/edit',array('id'=>$vo['id'])); ?>">编辑</a>
              <em><?php echo $vo['view']; ?>阅/<?php echo $vo['reply']; ?>答</em>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <div class="pages cl">
          
          <?php echo $tptc->render(); ?></div>
        </div>
        
      </div>
    </div>
  </div>
</div>


<?php if(session('userid') > 0): ?>
        <a href="<?php echo url('forum/add'); ?>" class="site-tree-mobile-edit layui-hide">
    <i class="iconfont icon-fabu"></i>
  </a>
  <?php endif; ?>
</div>

				
    
<div class="footer">
  <p>
     <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pid'] == '0'): ?>
      <a class="nav-this" href="<?php echo $vo['link']; ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>">
        <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
  </p>
  <p>
  <?php if($site_config['site_icp'] != ''): ?>
  ICP备案号:<?php echo $site_config['site_icp']; endif; ?>
  
  </p>
    <p>
  <?php if($site_config['site_copyright'] != ''): ?>
 版权信息:<?php echo $site_config['site_copyright']; endif; ?>
  
  </p>
    <p>
  <?php if($site_config['site_tongji'] != ''): ?>
 <?php echo $site_config['site_tongji']; endif; ?>
  
  </p>
</div>


<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

</body>
</html>