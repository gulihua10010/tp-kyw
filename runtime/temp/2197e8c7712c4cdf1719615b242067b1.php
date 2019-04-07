<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"E:\phpStudy\WWW\kyw/application/index\view\resource_index.html";i:1554174426;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1554441040;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554174358;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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
    
<link rel="stylesheet" href="/kyw/public/css/res.css">


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

<div class="nav-box ">
    <div class="content-index nav-c ">
        <div class="nav-home fl">
           <a href="<?php echo url('index/index/index'); ?>">首页</a>
        </div>
        <ul class="nav-sub fl  "  >
            <?php if(is_array($infonav) || $infonav instanceof \think\Collection || $infonav instanceof \think\Paginator): $i = 0; $__LIST__ = $infonav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" <?php  if($vo['link']!=''&&$controller==getnav_Controller($vo['link'] ,$vo['sid'])) echo ('class="sel-this"'); ?>><?php echo $vo['name']; ?></a>
                <ul>
                    <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo getnavlink($vo1['link'],$vo['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

<div class="content-index">
    <div class="main-mid"  >
        <ul class="choose-list">
            <li class="li-bg">
                <label  >分类：</label>
                <a href="<?php echo url('index/resource/index',['pt'=>0]); ?>" name="category" tip="0" <?php if($pt == 0): ?> class="active"<?php endif; ?>>全部</a>
                <?php if(is_array($pts) || $pts instanceof \think\Collection || $pts instanceof \think\Paginator): $i = 0; $__LIST__ = $pts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('index/resource/index',['pt'=>$vo['id']]); ?>" name="category" tip="<?php echo $vo['id']; ?>"  <?php if($pt == $vo['id']): ?> class="active"<?php endif; ?>><?php echo $vo['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li class="li-bg"   style="">
                <label >子类别：</label>
                <a href="<?php echo url('index/resource/index',['pt'=>$pt,'st'=>0]); ?>" name="category2" tip="" <?php if($st == 0): ?> class="active"<?php endif; ?>>全部</a>
                <?php if($sts != 0): if(is_array($sts) || $sts instanceof \think\Collection || $sts instanceof \think\Paginator): $i = 0; $__LIST__ = $sts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('index/resource/index',['pt'=>$pt,'st'=>$vo['id']]); ?>" name="category2" tip="<?php echo $vo['id']; ?>" <?php if($st == $vo['id']): ?> class="active"<?php endif; ?>><?php echo $vo['name']; ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </li>
        </ul>
    </div>

    <div class="main-bottom  " style="margin-top: 30px">
            <div class="res-main ">
                <ul>
                    <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <div class="fl"><img title="<?php echo $vo['name']; ?>" href="<?php echo url('index/resource/detail',['id'=>$vo['id']]); ?>"
                                             src="/kyw/public/images/ext/<?php echo $vo['ext']; ?>.png"> </div>
                        <div >
                            <div class="res-title">
                                <span><?php echo $vo['name']; ?></span>
                            </div>
                            <div class="res-info  ">
                               <div> <span ><a target="_blank" title="<?php echo $vo['fname']; ?>" href="">
                                                <svg class="icon" aria-hidden="true">
                                                  <use xlink:href="<?php echo getExtIcon($vo['ext']); ?>"></use>
                                                </svg> <?php echo $vo['fname']; ?></a>
                               </span></div>
                                <div class="res-info-data">  <span >大小:<?php echo format_bytes($vo['size']); ?></span><span>下载次数:<?php echo $vo['download']; ?></span>
                                    <span>下载积分:<?php echo $vo['point']; ?></span>
                                    <!--<span>创建时间:<?php echo friendlyDate($vo['time']); ?></span>-->
                                    <a  class="layui-btn fr" href="<?php echo url('index/resource/detail',['id'=>$vo['id']]); ?>" title="<?php echo $vo['name']; ?>" target="_blank">查看详情</a> </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="btable-paged  " >
                    <?php echo $res->render(); ?>
                </div>

            </div>
        <div class="res-right  ">
            <h4 class="pubRightTit"><span>最新资源</span></h4>
            <ul class="hotSchoolList">
                <?php if(is_array($right_d) || $right_d instanceof \think\Collection || $right_d instanceof \think\Paginator): if( count($right_d)==0 ) : echo "" ;else: foreach($right_d as $k=>$vo): ?>
                <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/resource/detail',array('id'=>$vo['id'])); ?> "
                                               target="_blank"><?php echo $vo['name']; ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

        </div>
    </div>

</div>




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


<script type="text/javascript" src="/kyw/public//js/iconfont.js"></script>


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

<script type="text/javascript">

</script>

</body>
</html>