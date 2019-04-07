<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:59:"E:\phpStudy\WWW\kyw/application/index\view\index_index.html";i:1554444340;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1554441040;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554174358;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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
    <link rel="stylesheet" href="/kyw/public/css/base.css">
    <link rel="stylesheet" href="/kyw/public/css/index.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    
<script src="/kyw/public/plugins/layui/layui.js"></script>
<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/jquery.SuperSlide.2.1.1.js"></script>
<script src="/kyw/public//js/common.js"></script>
  <style>

  </style>
</head>
<body>

<div class="header">
    <div class="header-top">
        <div class="content-index clearfix">
            <div class="fl">
                <a href="http://<?php echo $web_url; ?>/admin.php" target="_blank" style="color: white;line-height: 30px">后台登录</a>
            </div>
            <div class="fr header-top-right">
                <?php if(\think\Session::get('userid') != ''): ?>
                <a class="avatar fl" href="<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>">
                    <img src="/kyw<?php echo \think\Session::get('userhead'); ?>">
                    <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
                    <i  class="grade" style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
                </a>
                <div class="nav fl">
                    <a href="<?php echo url('user/index/set'); ?>"  target="_blank" style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
                    <a   onclick="loginout();" href="javascript:void(0)"    style="color:#fff;">
                        <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
                </div>
                <?php else: ?>
                 <a href="javascript:void(0);" onclick="showLogin();"  >登录</a>
                    <a href="javascript:void(0);" onclick="showReg();"  >注册</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="header-bootom content-index clearfix">
        <div class="fl">
            <?php if($site_config['logo'] != ''): ?>
            <img src="/kyw<?php echo $site_config['logo']; ?>" class="logo fl">
            <?php endif; ?>
        </div>
        <div class="fr">
            <div class="search-box fl">
                <div class="select-list search-select fl">
                    <span id="commonSearch" data-id="1">课程</span>
                    <ul class="sub-ul" id="commonSearchType">
                        <li data-id="1"><a href="javascript:void(0);" >课程</a></li>
                        <li  data-id="2"><a href="javascript:void(0);"  >学校</a></li>
                        <li  data-id="3"><a href="javascript:void(0);"  >专业</a></li>
                    </ul>
                </div>
                <div class="fl search-input-box">
                    <input type="text" name="commonSearchInput" id="commonSearchInput" placeholder="学院信息" class="search-input fl">
                </div>
                <input type="button" name="" id="btn" value="搜索" class="search-ic fl" style="color: white">
            </div>
        </div>
    </div>
</div>
<script>
$('#commonSearchType li').click(function () {
    var id=$(this).data('id');
    $('#commonSearch').attr('data-id',id)
    $('#commonSearch').text($(this).text());
})
    $('#btn').click(function () {
var id=$('#commonSearch').attr('data-id')
console.log(id)
    var url='#';
    var keywords=$('input[name=commonSearchInput]').val();
    switch (id){
        case '2': url="<?php echo url('index/school/index'); ?>?keywords="+keywords;break;
        case '3': url="<?php echo url('index/magor/index'); ?>?keywords="+keywords;break;
        case '1': url="<?php echo url('index/course/index'); ?>?keywords="+keywords;break;
    }
    window.open(url)
    })

</script>
<div class="main layui-clear "  >

<div class="nav-box">
    <div class="content-index nav-c">
        <div class="nav-tit fl">
            <p>课程导航</p>
            <div class="tit-list tit-list1">
                <dl class="project-list">
                    <?php if(is_array($pptnav) || $pptnav instanceof \think\Collection || $pptnav instanceof \think\Paginator): $i = 0; $__LIST__ = $pptnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <dd>
                        <span><?php echo $vo['name']; ?>&nbsp;<span>|</span></span>
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                        <a href="<?php echo getnavlink($sub['link'],$sub['sid']); ?>" target="<?php echo $sub['target']; ?>"><?php echo $sub['name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
            </div>
        </div>
        <ul class="nav-sub fl"  >
            <?php if(is_array($infonav) || $infonav instanceof \think\Collection || $infonav instanceof \think\Paginator): $i = 0; $__LIST__ = $infonav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><?php echo $vo['name']; ?></a>
                <ul>
                    <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
            <!-- <li><a href="#" target="_blank">成功学员</a></li> -->
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

<style>

</style>
<div class="banner-fu">
    <div class="banner-box">
        <div id="slideBox" class="slideBox">
            <div class="hd">
                <ul>
                    <li class=""></li>
                    <li class=""></li>
                    <li class=""></li>
                    <li class=""></li>
                    <li class=""></li>
                    <li class="on"></li>
                </ul>
            </div>
            <div class="bd">
                <div class="tempWrap" style="overflow:hidden; position:relative; width:1920px">
                    <ul style="width: 15360px; position: relative; overflow: hidden; padding: 0px; margin: 0px; left: -11520px;">
                        <?php if(is_array($ppt) || $ppt instanceof \think\Collection || $ppt instanceof \think\Paginator): $i = 0; $__LIST__ = $ppt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li style="float: left; width: 1920px;">
                            <a href="<?php echo $vo['url']; ?>" target="_blank" class="banner"
                               style="background: url(/kyw<?php echo $vo['path']; ?>) no-repeat center center;background-size:100% 100%;">
                            </a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(".slideBox").slide({
        mainCell: ".bd ul",
        autoPlay: true,
        effect: "leftLoop",
        titCell: ".hd li"
    });
</script>
<div class="content-index wbg ">
    <div class="title-box">
        <span class="title"><span>|</span>考研头条</span>
        <div class="title-links">
            <a href="javascript:void(0);" onclick="showTopic(0,this);" class="active">最新动态</a>
            <?php if(is_array($arttype) || $arttype instanceof \think\Collection || $arttype instanceof \think\Paginator): $i = 0; $__LIST__ = $arttype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <a href="javascript:void(0);" onclick="showTopic('<?php echo $vo['id']; ?>',this);" class=""><?php echo $vo['name']; ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <!-- 	<a href="javascript:showTopic(1);">资料下载</a> -->
        </div>
        <a href=" " target="_blank" class="more">更多</a>
    </div>
    <div class="con clearfix topicFlag" id="topic0" style="display: block;">
        <div class=" ">
            <ul class="news-img">
                <?php if(is_array($newest_arts) || $newest_arts instanceof \think\Collection || $newest_arts instanceof \think\Paginator): $i = 0; $__LIST__ = $newest_arts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li>
                    <a href=" " target="_blank" class="clearfix">
									<span class="fl">
										<img src="/kyw<?php echo $v['pic']; ?>" title="<?php echo $v['title']; ?>">
									</span>
                        <span class="news-img-right">
										<span class="news-img-tit"><?php echo $v['title']; ?></span>
										<span class="news-img-con"><?php echo $v['content']; ?></span>
										<span class="news-img-info">
											<span class="news-label">最新动态</span>
											<span><?php echo date("Y-m-d",$v['time']); ?></span>
											<span>阅读:<?php echo $v['readcount']; ?></span>
										</span>
									</span>
                    </a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <?php if(is_array($arts) || $arts instanceof \think\Collection || $arts instanceof \think\Paginator): $i = 0; $__LIST__ = $arts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="con clearfix topicFlag" id="topic<?php echo $vo['infoid']; ?>" style="display: none;">
        <div class=" ">
            <ul class="news-img">
                <?php if(is_array($vo['arts']) || $vo['arts'] instanceof \think\Collection || $vo['arts'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['arts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li>
                    <a href=" " target="_blank" class="clearfix">
									<span class="fl">
										<img src="/kyw<?php echo $v['pic']; ?>" title="<?php echo $v['title']; ?>">
									</span>
                        <span class="news-img-right">
										<span class="news-img-tit"><?php echo $v['title']; ?></span>
										<span class="news-img-con"><?php echo $v['content']; ?></span>
										<span class="news-img-info">
											<span class="news-label"><?php echo $vo['info']; ?></span>
											<span><?php echo date("Y-m-d",$v['time']); ?></span>
											<span>阅读:<?php echo $v['readcount']; ?></span>
										</span>
									</span>
                    </a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<script>
    layui.use(['form','layer'], function () {
        var form = layui.form
            , jq = layui.jquery;

    });
    function showTopic(id, obj) {
        $('.topicFlag').hide();
        $('#topic' + id).show();
        $(obj).addClass("active").siblings("a").removeClass("active");
    }
</script>


</div>
<div class="maintop " > </div>

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

<script>

    console.log('%c 考研网','color:#1BC7F1;font-size:30px;font-weight: bold ');
    // var mh= $('.main').outerWidth(true) ;
        // var mt= $('.main').offset().top
        // console.log(mt )
        // console.log(mh )
        // var ft=mh+mt;
        // if (ft<800){
        //     ft=800;
        // }
        // $('.footer').css({
        //     'position':'absolute',
        //     'top':ft+'px',
        // })

</script>

</body>
</html>