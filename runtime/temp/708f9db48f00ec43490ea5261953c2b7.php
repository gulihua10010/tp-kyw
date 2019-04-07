<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"E:\phpStudy\WWW\kyw/application/user\view\index_mynote.html";i:1548917582;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1548817152;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1548906904;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548923454;}*/ ?>
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
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">

    

<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <script src="/kyw/public/js/common.js"></script>

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
            <a data-url="<?php echo url('user/index/logout'); ?>"   location-url="#"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
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


<div class="main layui-clear  ">

<div class="content-index">
    <div class="main-mid user-x-top">
            <a target="_blank" href="<?php echo url('user/index/home',array('id'=>$m['id'])); ?>" title="<?php echo $m['username']; ?>">
                <img src="/kyw<?php echo $m['userhead']; ?>" title="<?php echo $m['username']; ?>"></a>
            <span><a target="_blank" href="<?php echo url('user/index/home',array('id'=>$m['id'])); ?>" title="<?php echo $m['username']; ?>">
                <?php echo $m['username']; ?>的课程笔记</a></span><span>  </span>
                <div class="user-x-btn" style="float: right">
                    <span type="edit"><a style="color:#999"  class="ask-edit" target="_blank" href="<?php echo url('user/index/home',array('id'=>$m['id'])); ?>">TA的个人中心</a></span>
                </div>

    </div>
        <div class=" main-mid x-main ">
            <ul>
                <?php if(is_array($note) || $note instanceof \think\Collection || $note instanceof \think\Paginator): $i = 0; $__LIST__ = $note;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>

                <li  >
                    <div class="flist-title"><span>课程视频名称:
                        <a  class="cb"  target="_blank" href="<?php echo url('index/course/showvideo',array('vid'=>$vo['vid'],'cid'=>$vo['cid'])); ?>"><?php echo $vo['vname']; ?></a> </span></div>
                    <div>

                    <span style="padding-left: 30px"><?php echo isCoverImg($vo['content']); ?><?php echo msubstr(clearcontent($vo['content']),0,50); ?>...</span>
                    </div>
                    <div class="flist-bottom  ">
                            <div class="fr">
                        <span><?php echo friendlyDate($vo['time']); ?></span>
                                <span> 课程名称: <a href="<?php echo url('index/course/detail',array('id'=>$vo['cid'])); ?>" target="_blank"><?php echo $vo['cname']; ?></a></span>
                     <span> <a href="<?php echo url('index/course/notedetail',array('nid'=>$vo['id'])); ?>"  target="_blank" class="jie-title cb">查看详情</a> </span>

                            </div>
                    </div>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

        </div>


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


<script type="text/javascript" src="/kyw/public//js/date.format.js"></script>

<!--页面JS脚本-->


<script type="text/javascript">

</script>
<script>

  layui.use('form', function() {
      var form = layui.form
          , jq = layui.jquery;



  })
</script>

</body>
</html>