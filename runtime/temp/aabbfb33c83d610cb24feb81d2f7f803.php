<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:60:"E:\phpStudy\WWW\kyw/application/index\view\magor_detail.html";i:1548593480;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1548667680;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1548833968;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548317488;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1547187444;}*/ ?>
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
    
<link rel="stylesheet" type="text/css" href="/kyw/public//css/school.css"/>


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
                <input type="button" name="" id="" value="" class="search-ic fl">
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
                    <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>


<div class="wap12 mt20 bw " style="margin-top: 20px" >
    <div class=" themagor clearfix    ">
        <div class="fl  magor-name  ">
            <span><?php echo $magor['name']; ?></span>
        </div>
        <span class="magor-type"><?php if($magor['type'] == 1): ?>学术硕士<?php else: ?>专业硕士<?php endif; ?></span>
        <div class=" magorWords">
            <div class="magorWordsTop fl ">
                <p class="schoolCode ">专业代码：<?php echo $magor['code']; ?></p>
            </div>
            <div class="magorWordsTop1 ">
                <p class="schoolCode ">所属门类：<?php echo $magor['pname']; ?></p>
            </div>
            <div class="magorWordsTop2  fl">
                <p class="schoolCode ">所属学科：<?php echo $magor['sub']; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="wap12 clearfix  " style="margin-top: 20px">
    <div class="pubLeftBar fl">

        <div class="recordCon brief-con">
            <h4 class="schoolTit"><?php echo $magor['name']; ?>简介</h4>
            <div class="slogBox">
                <div class="reexamCon">
                    <?php if(clearcontent($magor['info'])=='')echo ("  <p>暂无简介</p>"); ?>
                    <?php echo clearHTMLhead($magor['info']); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="pubRightBar fr" style="margin-top:  0">
        <div class="pubSchoolHot ">
            <h4 class="pubRightTit"><span>同类型院校人气排名</span></h4>
            <ul class="hotSchoolList">
                <?php if(is_array($right_s) || $right_s instanceof \think\Collection || $right_s instanceof \think\Paginator): if( count($right_s)==0 ) : echo "" ;else: foreach($right_s as $k=>$vo): ?>
                <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/magor/detail',array('id'=>$vo['id'])); ?> "
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

<script type="text/javascript">


</script>

</body>
</html>