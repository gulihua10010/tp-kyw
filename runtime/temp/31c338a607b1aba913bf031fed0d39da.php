<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:60:"E:\phpStudy\WWW\kyw/application/index\view\search_index.html";i:1548663066;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1548667680;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554173934;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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
if ($('#commonSearch').data('id')==1){
    
}


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


    <div class="  clearfix wap12 mt20 bw search-main"  >
        <div class="search-block ">
            <form class="layui-form "   lay-filter="kwy-s">
                <div class="search-title"><span>考研网数据搜索</span></div>
                <label class="  search-block-select ">
                <ul>
                    <li class="this"><span class="selected" data-id="1">学校</span><span><i class="iconfont">&#xe668;</i> </span></li>
                    <li data-id="1">学校</li>
                    <li data-id="2">专业</li>
                    <li  data-id="3">课程</li>
                    <li  data-id="4">资料</li>
                    <li  data-id="5">资讯</li>
                </ul>
                </label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" name="keyword" placeholder="请输入关键字">
                    <span class="search-btn"><i class="iconfont">&#xe616;</i> </span>
                </div>
            </form>
        </div>

        <div class="search-bottom  ">
            <div>
                <h4 class="pubRightTit"><span>最新资讯</span></h4>
                <ul class="hotSchoolList">
                    <?php if(is_array($right_a) || $right_a instanceof \think\Collection || $right_a instanceof \think\Paginator): if( count($right_a)==0 ) : echo "" ;else: foreach($right_a as $k=>$vo): ?>
                    <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/article/detail',array('id'=>$vo['id'])); ?> "
                                                   target="_blank"><?php echo $vo['title']; ?></a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
            <div>
                <h4 class="pubRightTit"><span>最新资源</span></h4>
                <ul class="hotSchoolList">
                    <?php if(is_array($right_r) || $right_r instanceof \think\Collection || $right_r instanceof \think\Paginator): if( count($right_r)==0 ) : echo "" ;else: foreach($right_r as $k=>$vo): ?>
                    <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/resource/detail',array('id'=>$vo['id'])); ?> "
                                                   target="_blank"><?php echo $vo['name']; ?></a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div>
                <h4 class="pubRightTit"><span>最新课程</span></h4>
                <ul class="hotSchoolList">
                    <?php if(is_array($right_c) || $right_c instanceof \think\Collection || $right_c instanceof \think\Paginator): if( count($right_c)==0 ) : echo "" ;else: foreach($right_c as $k=>$vo): ?>
                    <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/course/detail',array('id'=>$vo['id'])); ?> "
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
    var f=0;
$('.this'). click(function (event) {
    stopBubble(event);
    if (f==0){
       $('.search-block-select li').show()
       $('.this').find('i').html('&#xe669;');
       f=1;
   } else if (f==1){
       $('.search-block-select ul li:not(:first-child)').hide()
       $('.this').find('i').html('&#xe668;');
       f=0;
    }


})

        $('.search-block-select ul li:not(:first-child)'). click(function (event) {
            stopBubble(event);
            var t=$(this).text()
            var id=$(this).data('id')
            // console.log('1 :'+id)
            $('.search-block-select ul li:first-child .selected').text(t);
            $('.selected').data('id',id)
            $('.search-block-select ul li:not(:first-child)').hide()
            $('.this').find('i').html('&#xe668;');
            f=0;
        })
    $(document).click(function (event) {
        var id=$('.selected').data('id');
        $('.search-block-select ul li:not(:first-child)').hide()
        $('.this').find('i').html('&#xe668;');
        f=0;
    })
    /**
     *  <li data-id="1">学校</li>
     <li data-id="2">专业</li>
     <li  data-id="3">课程</li>
     <li  data-id="4">资料</li>
     <li  data-id="5">资讯</li>
     */
    $(document).keydown(function (e) {
        if (e.keyCode==13) {
            d()
        }
    })
    $('.search-btn').click(function () {

        d()
    })
    function d() {
        var id=$('.selected').data('id');
          // console.log(id)
        var url='#';
        var keywords=$('input[name=keyword]').val();
        switch (id){
            case 1: url="<?php echo url('index/school/index'); ?>?keywords="+keywords;break;
            case 2: url="<?php echo url('index/magor/index'); ?>?keywords="+keywords;break;
            case 3: url="<?php echo url('index/course/index'); ?>?keywords="+keywords;break;
            case 4: url="<?php echo url('index/resource/index'); ?>?keywords="+keywords;break;
            case 5: url="<?php echo url('index/article/index'); ?>?keywords="+keywords;break;
        }
        window.open(url)
    }
    //阻止冒泡函数
    function stopBubble(e){
        if(e && e.stopPropagation){
            e.stopPropagation();  //w3c
        }else{
            window.event.cancelBubble=true; //IE
        }
    }

</script>

</body>
</html>