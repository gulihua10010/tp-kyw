<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:60:"E:\phpStudy\WWW\kyw/application/index\view\school_index.html";i:1548658822;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1554441040;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554174358;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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

    <div class="  clearfix wap12  "  style="margin-top: 20px">
        <div class="side_L_x fl  ">
            <div class="tab_title_Shx">
                <div class=" "  >
                    <div class="classify_ZY_x ">
                        <div class="clearfix pt30 mb17 ">
                            <div class="classify_L_x fl">所属地区：</div>
                            <div class="classify_RTop_x fl">
                                <div class="Colleges_R_x fl Col_x1">
                                    <a href="<?php echo url('index/school/index',array('v'=>'0','p'=>$p,'t'=>$t,'b'=>$b)); ?>" class='<?php if($v == 0): ?>on<?php endif; ?>'>全部</a>
                                    <?php if(is_array($provice) || $provice instanceof \think\Collection || $provice instanceof \think\Paginator): $i = 0; $__LIST__ = $provice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <span><a href="<?php echo url('index/school/index',array('v'=>$vo['id'],'p'=>$p,'t'=>$t,'b'=>$b)); ?>" class='<?php if($v == $vo['id']): ?>on<?php endif; ?>'><?php echo $vo['name']; ?></a></span>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mt_5 clearfix mb17">
                            <div class="classify_L_x fl">学校属性：</div>
                            <div class="classify_RTop_x fl classify_RTop_x1">
                                <a href="<?php echo url('index/school/index',array('p'=>'0','v'=>$v,'t'=>$t,'b'=>$b)); ?>"  class='<?php if($p == 0): ?>on<?php endif; ?>'>全部</a>
                                <?php if(is_array($prop) || $prop instanceof \think\Collection || $prop instanceof \think\Paginator): $i = 0; $__LIST__ = $prop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <span><a href="<?php echo url('index/school/index',array('p'=>$vo['id'],'v'=>$v,'t'=>$t,'b'=>$b)); ?>"  class='<?php if($p == $vo['id']): ?>on<?php endif; ?>'><?php echo $vo['name']; ?></a></span>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <div class=" clearfix mb17">
                            <div class="classify_L_x fl">学校类型：</div>
                            <div class="classify_RTop_x fl classify_RTop_x2">
                                <a href="<?php echo url('index/school/index',array('t'=>'0','p'=>$p,'v'=>$v,'b'=>$b)); ?>" class='<?php if($t == 0): ?>on<?php endif; ?>'>全部</a>
                                <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <span><a href="<?php echo url('index/school/index',array('t'=>$vo['id'],'p'=>$p,'v'=>$v,'b'=>$b)); ?>"   class='<?php if($t == $vo['id']): ?>on<?php endif; ?>'><?php echo $vo['name']; ?></a></span>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <div class=" clearfix mb17">
                            <div class="classify_L_x fl">学校隶属：</div>
                            <div class="classify_RTop_x fl classify_RTop_x3">
                                <a href="<?php echo url('index/school/index',array('b'=>'0','p'=>$p,'t'=>$t,'v'=>$v)); ?>" class='<?php if($b == 0): ?>on<?php endif; ?>'>全部</a>
                                <?php if(is_array($belong) || $belong instanceof \think\Collection || $belong instanceof \think\Paginator): $i = 0; $__LIST__ = $belong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <span><a href="<?php echo url('index/school/index',array('b'=>$vo['id'],'p'=>$p,'t'=>$t,'v'=>$v)); ?>"   class='<?php if($b == $vo['id']): ?>on<?php endif; ?>'><?php echo $vo['name']; ?></a></span>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <form id="formName" action="<?php echo url('index/school/index'); ?>" method="get">
                            <div class="serSchoolBar">
                                <input type="text" class="serSchoolIpt" placeholder="输入院校名称" name="keywords" value="">
                                <input type="submit"   value="" style="cursor: pointer"
                                   class="serSchoolBtn"/>
                            </div>
                        </form>
                    </div>
                    <div class="rq_px_x">
                        <ul class="information_x">
                            <?php if(is_array($schools) || $schools instanceof \think\Collection || $schools instanceof \think\Paginator): $i = 0; $__LIST__ = $schools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="clearfix mb16">
                                <div class="information_L_x fl">
                                    <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'])); ?>" target="_blank"><img
                                            src="/kyw<?php echo $vo['badge']; ?>"></a>
                                    <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'])); ?>" target="_blank"><p><?php echo $vo['name']; ?></p>
                                    </a>
                                </div>
                                <div class="information_R_x fl">
                                    <div class="information_R_Topx">
                                        <?php $prop=explode(',',$vo['prop']);foreach($prop as $v) echo ("<span>$v</span>");  ?>
                                    </div>
                                    <p class="information_R_Titlex">
                                        <span>地点：<?php echo $vo['vname']; ?></span>|<span>院校类型：
                                     <?php $type=explode(',',$vo['prop']);foreach($type as $v) echo ("<span>$v</span>");  ?></span>
                                    </p>
                                    <div class="information_R_Contx">
                                        <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'1')); ?>" target="_blank">学校简介</a>|
                                        <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'2')); ?>" target="_blank">招生简章</a>|
                                        <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'3')); ?>" target="_blank">招生专业</a>|
                                        <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'4')); ?>" target="_blank">分数线</a>|
                                        <a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'5')); ?>" target="_blank">复试</a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>


                        </ul>
                        <div class="btable-paged  " >
                                <?php echo $schools->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side_R_x fr">
            <h4 class="pubRightTit"><span>同类型院校人气排名</span></h4>
            <ul class="hotSchoolList">
                <?php if(is_array($right_s) || $right_s instanceof \think\Collection || $right_s instanceof \think\Paginator): if( count($right_s)==0 ) : echo "" ;else: foreach($right_s as $k=>$vo): ?>
                <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'1')); ?> "
                                               target="_blank"><?php echo $vo['name']; ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>

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