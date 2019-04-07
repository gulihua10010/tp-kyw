<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:64:"E:\phpStudy\WWW\kyw/application/index\view\course_showvideo.html";i:1549023654;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1548667680;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1548833968;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:68:"E:\phpStudy\WWW\kyw\application\index\view\course_ajaxpage_asks.html";i:1549023076;s:69:"E:\phpStudy\WWW\kyw\application\index\view\course_ajaxpage_comms.html";i:1549023076;s:69:"E:\phpStudy\WWW\kyw\application\index\view\course_ajaxpage_notes.html";i:1549022986;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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
    
<link rel="stylesheet" href="/kyw/public//css/course.css">
<link rel="stylesheet" href="/kyw/public//css/aliplayer-min.css" />

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
                    <li><a href="<?php echo getnavlink($vo1['link'],$vo['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

<style>
    .prism-player .prism-cover{
        display:block;
    }

    .prism-player .prism-marker-text{
        display:none;
    }

    img{
        max-width: 350px;
    }
</style>
<div class="video-main">
    <div class="navs" style="line-height: 56px;min-width: 1200px;background-color: #333">
        <a href="<?php echo Url('index/course/detail',['id'=>$cid]); ?>">
            <div style="float:left;width: 66px" id="fanhui"><span style="margin-left: 30px;color: #999ea2" ><i class="iconfont">&#xe61c;</i> </span></div>
        </a>
        <span style="margin-left: 20px;color: #999ea2;"><?php echo $video['name']; ?></span>
    </div>
    <div id="player-con" style="width: 100%; min-height: 600px;  background-color: black; height: 640px;"  class="prism-player">
    </div><input type="hidden"  id="videoplay" value="0">
    <div id="sideBar">
        <div id="sideBarTab"><img src="/kyw/public/images/zhangjie.png" alt="sideBar" title="sideBar"></div>
        <div id="sideBarContents" style="display:none">
            <div id="sideBarContentsInner">
                <?php if(is_array($video_collects) || $video_collects instanceof \think\Collection || $video_collects instanceof \think\Paginator): $i = 0; $__LIST__ = $video_collects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <h2><?php echo $vo['name']; ?></h2>
                <ul>
                    <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a class="tiaozhuan2"  style='font-size:13px; <?php if($sub['id'] == $vid): ?>color: yellow<?php endif; ?> ' href="<?php echo Url('index/course/showvideo',array('vid'=>$sub['id'],'cid'=>$cid)); ?>">
                            <?php echo $sub['name']; ?>
                        </a>
                        <div class="clear"></div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>
    </div>
    <div class="video-x  ">
        <div class="fl " style="width: 860px">
    <div class="page-container">
        <div class="line-content" style="height: 100px;padding-top: 50px;">
            <a href="javascript:void(0)"  class="ask-click">
                <div id="asks" style="font-size: 18px;font-weight: bold;float: left;color: red;">问答</div>
            </a>
            <a href="javascript:void(0)"   class="comm-click" >
                <div id="comms"
                     style="font-size: 18px; font-weight: bold; float: left; margin-left: 60px; color: rgb(78, 85, 93);">评论
                </div>
            </a>
            <a href="javascript:void(0)"   class="note-click" >
                <div id="notes"
                     style="font-size: 18px; font-weight: bold; float: left; margin-left: 60px; color: rgb(78, 85, 93);">同学笔记
                </div>
            </a>
            <div class="clear"></div>
            <hr class="titlehr" style="width: 805px;float: left;margin-top: 30px;">
        </div>
    </div>
    <div class="page-container     "  id="asks-block">
        <div class="line-content   ">
            <div class="contentyangshi  "  >
                <div class="js-tab-item tab-item c-qalist current" data-type="qa" style="display: block;">
                    <div class="comp-filter-bar clearfix">
                        <span class="js-pub-btn moco-btn moco-btn-gray-l ask-answer">提问题</span>
                    </div>
                    <div id="qaContainer" class="answertabcon">
                        <div class="course_quescon mod-post">
                            <?php if(is_array($asks) || $asks instanceof \think\Collection || $asks instanceof \think\Paginator): $i = 0; $__LIST__ = $asks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="wenda-listcon mod-qa-list clearfix">
    <div class='<?php if($vo['issolve'] == 1): ?>icon-finish<?php else: ?>icon-wenda<?php endif; ?>'></div>
    <div class="headslider qa-medias l"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"
                                           class="media" target="_blank"
                                           title="<?php echo $vo['username']; ?>"><img
            src="/kyw<?php echo $vo['userhead']; ?>"
            width="40" height="40"></a></div>
    <div class="wendaslider qa-content">
        <h2 class="wendaquetitle qa-header" style="cursor: pointer;!important;">
            <div class="wendatitlecon qa-header-cnt  " ><a style=" cursor: pointer"
                                                           href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>" target="_blank"
                                                           class="qa-tit "> <?php echo $vo['title']; ?> </a></div>
        </h2>
        <div class="replycont qa-body clearfix">
            <?php if($vo['solve'] != ''): ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt" style="color: #0ae029">已采纳回答</span> / <a
                    href="<?php echo url('user/index/home',array('id'=>$vo['solve']['userid'])); ?>" target="_blank"
                    title="<?php echo $vo['solve']['username']; ?>" class="nickname"  style="color: #666;font-weight: bold;font-size: 16px"><?php echo $vo['solve']['username']; ?></a></span>
                <div class="replydet"><?php echo clearHTMLhead($vo['solve']['content']); ?></div>
            </div>
            <?php elseif($vo['new'] != ''): ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt">最新回答</span> / <a
                    href="<?php echo url('user/index/home',array('id'=>$vo['new']['userid'])); ?>" target="_blank"
                    title="<?php echo $vo['new']['username']; ?>" class="nickname" style="color: #666;font-weight: bold;font-size: 16px"><?php echo $vo['new']['username']; ?></a></span>
                <div class="replydet"><?php echo clearHTMLhead($vo['new']['content']); ?></div>
            </div>
            <?php else: ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt">暂无回答</span>  </span>
                <div class="replydet"><a  target="_blank" style="color: white" href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>" class="layui-btn">我要发布</a></div>
            </div>
            <?php endif; ?>
        </div>
        <div class="replymegfooter qa-footer clearfix">
            <div class="l-box fl"><a href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>"
                                     target="_blank" class="replynumber static-count "> <span
                    class="static-item answer">    <?php echo $vo['reply']; ?> 回答   </span>
                <span class="static-item">           </span>
            </a></div>
            <em class="r"><?php echo friendlyDate($vo['time']); ?></em> </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>

<div class="ask-page">
<?php echo $apage; ?>
</div>
<script>
    layui.use(['layer', 'form', 'element' ], function () {

        var   jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        jq(".ask-page .pagination a").click(function(){
            var url = jq(this).attr('href');
            jq.ajax({
                'type' : 'post',
                'url'  :  url,
                'data':{'type':1,'vid':'<?php echo $vid; ?>'},
                success:function(data){
                    jq('.course_quescon').html(data);
                }
            })
            return false;
        });
  });


</script>

                        </div>
                    </div>
                    <!--<div class="paginationwrap">-->
                    <!--<div class="pagination"><span class="current prev disabled">首页</span><span-->
                    <!--class="current prevclass prev">上一页</span><span class="current p_interval">1</span><a-->
                    <!--href="javascript:;" class="p_interval">2</a><a href="javascript:;"-->
                    <!--class="nextclass next">下一页</a><a-->
                    <!--href="javascript:;" class="prev disabled lastclass">尾页</a></div>-->
                    <!--</div>-->
                </div>
                <div class="clear"></div>
            </div>

        </div>
    </div>


    <div class="page-container" id="comms-block" style="display: none;">
        <div class="line-content">
            <div class="contentyangshi"  >
                <div class="js-tab-item tab-item c-comment" data-type="comment"  >
                    <div class="comp-filter-bar clearfix">
                        <span class="js-pub-btn moco-btn moco-btn-gray-l push-comm">发布评论</span>
                    </div>
                    <div id="commentContainer" class="answertabcon">
                        <div class="course_comment mod-post">
                            <?php if(is_array($comms) || $comms instanceof \think\Collection || $comms instanceof \think\Paginator): $i = 0; $__LIST__ = $comms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="wenda-listcon mod-qa-list post-row clearfix" data-id="<?php echo $vo['userid']; ?>">
    <div class="headslider qa-medias fl"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"
                                            class="media" target="_blank" title="<?php echo $vo['username']; ?>"><img
            src="/kyw<?php echo $vo['userhead']; ?>"
            width="40" height="40"></a></div>
    <div class="wendaslider qa-content">
        <div class="tit"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><?php echo $vo['username']; ?></a>
        </div>
        <div class="cnt"><?php echo clearHTMLhead($vo['content']); ?></div>
        <div class="replymegfooter qa-footer clearfix">
            <div class="l-box fl"><a title="赞" href="javascript:(0);"
                                     class="js-pl-praise  moco-btn moco-btn-gray-l" type="4"
                                     data-id="<?php echo $vo['id']; ?>"> <i <?php if(in_array($vo['id'],$d4s))echo ('style="color:red"');  ?>
                class="iconfont">&#xe611;</i> <em><?php echo $vo['praise']; ?></em> </a>
            </div>
            <span class=" timeago"><?php echo friendlyDate($vo['time']); ?></span></div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="comm-page">
<?php echo $cpage; ?>
</div>
<script>
    layui.use(['layer', 'form', 'element' ], function () {

        var   jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        jq(".comm-page .pagination a").click(function(){
            var url = jq(this).attr('href');
            jq.ajax({
                'type' : 'post',
                'url'  :  url,
                'data':{'type':2,'vid':'<?php echo $vid; ?>'},
                success:function(data){
                    jq('.course_comment').html(data);
                }
            })
            return false;
        });
  });


</script>

                        </div>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>



    <div class="page-container" id="notes-block"  style="display: none;">
        <div class="line-content">
            <div class="contentyangshi" >
                <div class="js-tab-item tab-item c-comment" data-type="comment"  >
                    <div class="comp-filter-bar clearfix">
                        <span class="js-pub-btn moco-btn moco-btn-gray-l write-note">记笔记</span>
                    </div>
                    <div id="noteContainer" class="answertabcon">
                        <div class="course_note mod-post">
                            <?php if(is_array($notes) || $notes instanceof \think\Collection || $notes instanceof \think\Paginator): $i = 0; $__LIST__ = $notes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="wenda-listcon mod-qa-list post-row clearfix" data-id="<?php echo $vo['userid']; ?>">
    <div class="headslider qa-medias fl"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"
                                            class="media" target="_blank" title="<?php echo $vo['username']; ?>"><img
            src="/kyw<?php echo $vo['userhead']; ?>"
            width="40" height="40"></a></div>
    <div class="wendaslider qa-content">
        <div class="tit"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><?php echo $vo['username']; ?></a>
        </div>
        <div class="cnt"><?php echo cutstr_html(clearHTMLhead($vo['content']),100); ?></div>
        <div class="replymegfooter qa-footer clearfix">
            <div class="l-box fl"><a title="赞" href="javascript:(0);"
                                     class="js-pl-praise moco-btn moco-btn-gray-l" type="5"
                                     data-id="<?php echo $vo['id']; ?>"> <i <?php if(in_array($vo['id'],$d5s))echo ('style="color:red"');  ?>
                class="iconfont">&#xe611;</i> <em><?php echo $vo['praise']; ?></em> </a>
            </div>
            <span class=" timeago"><?php echo friendlyDate($vo['time']); ?></span>
            <span style='margin-left: 20px'><a target='_blank'href="<?php echo url('index/course/notedetail',array('nid'=>$vo['id'])); ?>">查看全文</a> </span>
        </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="note-page">
<?php echo $npage; ?>
</div>
<script>
    layui.use(['layer', 'form', 'element' ], function () {

        var   jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        jq(".note-page .pagination a").click(function(){
            var url = jq(this).attr('href');
            jq.ajax({
                'type' : 'post',
                'url'  :  url,
                'data':{'type':3,'vid':'<?php echo $vid; ?>'},
                success:function(data){
                    jq('.course_note').html(data);
                }
            })
            return false;
        });
  });


</script>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
   </div>

    <div style="float: right;width: 300px;margin-top: 150px;  background-color: white;" >
        <span style="margin-left: 35px;"><i class="iconfont" style="color: red">&#xe6a5;</i> </span>
        <span style="font-size: 16px;font-weight: bold;margin-left: 5px;">课程推荐</span> 
        <ul class="hotSchoolList">
            <?php if(is_array($right_tj) || $right_tj instanceof \think\Collection || $right_tj instanceof \think\Paginator): if( count($right_tj)==0 ) : echo "" ;else: foreach($right_tj as $k=>$vo): ?>
            <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'1')); ?> "
                                           target="_blank"><?php echo $vo['name']; ?></a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <div class="clear"></div>

    <div style="opacity:0; width: 350px;height: 200px;position: absolute;top:  1611px;right:  0px;  ">
        <div class="imgs" > </div>
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


<script type="text/javascript" src="/kyw/public//plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/kyw/public//js/prototype.js"></script>
<script type="text/javascript" src="/kyw/public//js/side-bar.js"></script>
<script type="text/javascript" src="/kyw/public//js/effects.js"></script>
<script type="text/javascript" src="/kyw/public//js/date.format.js"></script>
<script type="text/javascript" charset="utf-8" src="/kyw/public//js/aliplayer-min.js">
</script><script type="text/javascript" src="/kyw/public/js/clipboard.min.js"></script>


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

<script>
    layui.use(['layer', 'form', 'element','rate' ], function () {

        var rate = layui.rate
            , jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        var w = jq(window).height()
        var h = jq(window).width()
        var g_startPage = 1;

        '<?php if($islogin==0): ?>';
        showLogin(jq);
        '<?php endif; ?>'
        var player = new Aliplayer({
                "id": "player-con",
                "source": "/kyw<?php echo $video['video']; ?>",
                "width": "100%",
                "height": "500px",
                "autoplay": true,
                "isLive": false,
                "rePlay": true,
                "playsinline": true,
                "preload": true,
                "autoPlayDelayDisplayText": "正在加载中..请稍等",
                "language": "zh-cn",
                "controlBarVisibility": "hover",
                "videoWidth": "100%",
                "useH5Prism": true,
                "extraInfo": {
                    "crossOrigin": "anonymous"
                },
                "skinLayout": [{"name": "bigPlayButton", "align": "blabs", "x": 30, "y": 80},
                    {"name": "H5Loading", "align": "cc"},
                    {"name": "errorDisplay", "align": "tlabs", "x": 0, "y": 0},
                    {"name": "infoDisplay"},
                    {"name": "tooltip", "align": "blabs", "x": 0, "y": 56},
                    {"name": "thumbnail"},
                    {
                        "name": "controlBar", "align": "blabs", "x": 0, "y": 0,
                        "children": [{"name": "progress", "align": "blabs", "x": 0, "y": 44},
                            {"name": "playButton", "align": "tl", "x": 15, "y": 12},
                            {"name": "timeDisplay", "align": "tl", "x": 10, "y": 7},
                            {"name": "fullScreenButton", "align": "tr", "x": 10, "y": 12},
                            {"name": "subtitle", "align": "tr", "x": 15, "y": 12},
                            {"name": "setting", "align": "tr", "x": 15, "y": 12},
                            {"name": "volume", "align": "tr", "x": 5, "y": 10},
                            {"name": "snapshot", "align": "tr", "x": 10, "y": 12}
                        ]
                    }
                ]
            }, function (player) {
                console.log("播放器创建了。");
            }
        );
        /* h5截图按钮, 截图成功回调 */
        player.on('snapshoted', function (data) {
            var pictureData = data.paramData.base64
            var downloadElement = document.createElement('img');
            var img_p=jq(downloadElement);
            img_p.addClass('pimg');
            downloadElement.setAttribute('src', pictureData)
            var fileName = 'Aliplayer' + Date.now() + '.png'
            jq('.imgs').html( img_p)
            // downloadElement.setAttribute('download', fileName)
            // downloadElement.click()
            pictureData = null
            var clipboard = new ClipboardJS('.prism-snapshot-btn', {
                target: function() {
                    layer.msg('截图成功！请在编辑器中粘贴', {icon: 1, time: 1000}, function () {
                    });
                    return document.querySelector('.imgs');
                }
            });
        })

        var timeToSaved='<?php echo $dcvr['progress']; ?>';
        timeToSaved=timeToSaved==''?0:parseInt(timeToSaved);
        if (timeToSaved==null||timeToSaved==''||timeToSaved==NaN){
            timeToSaved=0;
        }
        player.play();
        player.seek(timeToSaved);
        function cancelSpace(e) {
            var e = e || window.event;
            var elm = e.srcElement || e.target;
            var key = e.keyCode || e.charCode;
            if (key == 32) {
                if (elm.tagName.toLowerCase() == "input" && elm.type.toLowerCase() == "text" || elm.tagName.toLowerCase() == "textarea") {
                    return;
                }
                if (window.event) {
                    e.returnValue = false;
                }
                else {
                    e.preventDefault();
                }
            }
        }
        document.onkeypress = cancelSpace;
        jq(document).keydown(function (e) {
            keyNum = e.keyCode;
            //空格暂停播放
            if (keyNum == '32') {
                var videoplay = jq('#videoplay').val();
                if (videoplay == 0) {
                    player.pause();
                    jq('#videoplay').val(1);
                } else {
                    player.play();
                    jq('#videoplay').val(0);
                }
            } else if (keyNum == '37') {
                var videotimes = player.getDuration();
                var playnum = player.getCurrentTime();
                playnum = parseInt(playnum - 10);
                if (playnum <= (videotimes - 30)) {
                    player.seek(playnum);
                }
            } else if (keyNum == '39') {
                var videotimes = player.getDuration();
                var playnum = player.getCurrentTime();
                playnum = parseInt(playnum + 10);
                if (playnum <= (videotimes + 30)) {
                    player.seek(playnum);
                }

            }
        })
        // 监听播放器的pause事件
        player.on("pause", function () {
            var timeToSaved= player.getCurrentTime();
            saveWatchTime(timeToSaved);
        });

        player.on("ended", function () {
            var timeToSaved= player.getCurrentTime();
            saveWatchTime(timeToSaved);
        });


        // //存储观看时间的函数
        function saveWatchTime(timeToSaved) {
            jq.ajax({
                type: "post",
                url: "<?php echo Url('index/course/saveWatchTime',['id'=>$cid]); ?>",
                data: {"vid": '<?php echo $vid; ?>', "seconds": timeToSaved, "uid": '<?php echo \think\Session::get('userid'); ?>'},
                dataType: 'json',
                success: function (ret) {
                    if (ret.code == "200") {
                        timeToSaved = 0;
                    }
                }
            });
        }

        // //关闭页面时做的处理，将观看时间存到数据库中
        window.onbeforeunload = onbeforeunload_handler;

        function onbeforeunload_handler() {
            timeToSaved= player.getCurrentTime();
            saveWatchTime(timeToSaved);
        }


        jq('.ask-click').click(function () {
            jq("#comms-block").hide();
            jq("#notes-block").hide();
            jq("#asks-block").show();
            jq("#asks").css({color: "red"})
            jq("#comms").css({color: "#4e555d"})
            jq("#notes").css({color: "#4e555d"})

        })
        jq('.comm-click').click(function () {
            jq("#comms-block").show();
            jq("#notes-block").hide();
            jq("#asks-block").hide();
            jq("#comms").css({color: "red"})
            jq("#notes").css({color: "#4e555d"})
            jq("#asks").css({color: "#4e555d"})
        })

        jq('.note-click').click(function () {
            jq("#notes-block").show();
            jq("#comms-block").hide();
            jq("#asks-block").hide();
            jq("#notes").css({color: "red"})
            jq("#comms").css({color: "#4e555d"})
            jq("#asks").css({color: "#4e555d"})
        })
        jq('.push-comm').click(function () {
            var ask=" <script type=\"text/javascript\" src=\"/kyw/public//plugins/tinymce/tinymce.min.js\">"+
                "           <\/script><div class=\"layui-form\" style='margin: 10px'>\n" +
                "    <textarea id=\"ask-text\"></textarea>\n" +
                "<button class='layui-btn submit' style='float: right;position: relative;right: 20px;top: 20px;'>提交</button> " +
                "</div>\n" +
                "<script>futext(\"#ask-text\",'merge'); <\/script>";


            layer.open({
                type: 1,
                area:['900px','600px'],
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 0, //不显示关闭按钮
                anim: 2,
                title: '我要评论',
                shadeClose: true, //开启遮罩关闭
                content: ask,
                success:function () {
                },
                end:function () {
                    // location.reload();
                }
            });
            jq('.submit').click(function () {
                var content =tinyMCE.activeEditor.getContent();
                if (clearHtmlexpImg(content) == '' || clearHtmlexpImg(content).trim() == '') {
                    layer.msg('请输入内容后再提交', {icon: 2, time: 1000}, function () {
                    });
                    return false
                }
                ajaxform({'content':content,'vid':'<?php echo $vid; ?>','uid':'<?php echo \think\Session::get('userid'); ?>'}," <?php echo url('index/course/addvideocomm'); ?> ",jq,function (res) {
                    content=clearHtml(content);
                    var str="      <div class=\"wenda-listcon mod-qa-list post-row clearfix\" data-id=\"<?php echo \think\Session::get('userid'); ?>\">\n" +
                        "                            <div class=\"headslider qa-medias l\"><a href=\"<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>\"\n" +
                        "                                                                   class=\"media\" target=\"_blank\" title=\"<?php echo \think\Session::get('username'); ?>\"><img\n" +
                        "                                    src=\"/kyw<?php echo \think\Session::get('userhead'); ?>\"\n" +
                        "                                    width=\"40\" height=\"40\"></a></div>\n" +
                        "                            <div class=\"wendaslider qa-content\">\n" +
                        "                                <div class=\"tit\"><a href=\"<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>\" target=\"_blank\"><?php echo \think\Session::get('username'); ?></a>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"cnt\">"+content+"</div>\n" +
                        "                                <div class=\"replymegfooter qa-footer clearfix\">\n" +
                        "                                    <div class=\"l-box l\"><a title=\"赞\" href=\"javascript:(0);\"\n" +
                        "                                                            class=\"js-pl-praise moco-btn moco-btn-gray-l\"\n" +
                        "                                             type=\"4\"               data-id=\""+res.id+"\"> <i\n" +
                        "                                            class=\"iconfont\">&#xe611;</i> <em>0</em> </a>\n" +
                        "                                    </div>\n" +
                        "                                    <span class=\" timeago\">刚刚</span></div>\n" +
                        "                            </div>\n" +
                        "                        </div>";
                    jq('.course_comment').append(str);
                    layer.closeAll();
                });
            })

        })
        jq('.page-container').on('click','.js-pl-praise',function () {
            var id=jq(this).attr('data-id');
            var type=jq(this).attr('type');
            var uid='<?php echo \think\Session::get('userid'); ?>';
            var $this=jq(this);
            ajaxform({'type':type,'id':id,'uid':'<?php echo \think\Session::get('userid'); ?>'}," <?php echo url('index/course/zan'); ?> ",jq,function (res) {
                $this.find('i').css('color','red');
                var tt=$this.find('em').text();
                $this.find('em').text(parseInt(tt)+1);
            });

        })
        jq('.write-note').click(function () {
            var ask=" <script type=\"text/javascript\" src=\"/kyw/public//plugins/tinymce/tinymce.min.js\">"+
                "           <\/script><div class=\"layui-form\" style='margin: 10px'>" +
                "<span style='color: #ffcc6f' >如需要截图，请在视频下方如图按钮<span class='snapshot-icon'></span>，并且粘贴到编辑器里</span>" +
                "    <textarea id=\"ask-text\"></textarea>\n" +
                "<button class='layui-btn submit' style='float: right;position: relative;right: 20px;top: 20px;'>提交</button> " +
                "</div>\n" +
                "<script>futext(\"#ask-text\",'merge');layui.use(['form', 'layedit', 'laydate'], function(){\n" +
                "  var form = layui.form;form.render();}) <\/script>";

            layer.open({
                type: 1,
                area:['900px','550px'],
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 0, //不显示关闭按钮
                anim: 2,
                title: '记笔记',
                shadeClose: true, //开启遮罩关闭
                content: ask,
                success:function () {
                },
                end:function () {
                    // location.reload();
                }
            });
            jq('.submit').click(function () {
                var content =tinyMCE.activeEditor.getContent();
                console.log(clearHtmlexpImg(content) )
                if (clearHtmlexpImg(content) == '' || clearHtmlexpImg(content).trim() == '') {
                    layer.msg('请输入内容后再提交', {icon: 2, time: 1000}, function () {
                    });
                    return false;
                }
                ajaxform({'content':content,'vid':'<?php echo $vid; ?>','uid':'<?php echo \think\Session::get('userid'); ?>'}," <?php echo url('index/course/addvideonote'); ?> ",jq,function (res) {
                    content=clearHtml(content);
                    var str="      <div class=\"wenda-listcon mod-qa-list post-row clearfix\" data-id=\"<?php echo \think\Session::get('userid'); ?>\">\n" +
                        "                            <div class=\"headslider qa-medias l\"><a href=\"<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>\"\n" +
                        "                                                                   class=\"media\" target=\"_blank\" title=\"<?php echo \think\Session::get('username'); ?>\"><img\n" +
                        "                                    src=\"/kyw<?php echo \think\Session::get('userhead'); ?>\"\n" +
                        "                                    width=\"40\" height=\"40\"></a></div>\n" +
                        "                            <div class=\"wendaslider qa-content\">\n" +
                        "                                <div class=\"tit\"><a href=\"<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>\" target=\"_blank\"><?php echo \think\Session::get('username'); ?></a>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"cnt\">"+content+"</div>\n" +
                        "                                <div class=\"replymegfooter qa-footer clearfix\">\n" +
                        "                                    <div class=\"l-box l\"><a title=\"赞\" href=\"javascript:(0);\"\n" +
                        "                                                            class=\"js-pl-praise moco-btn moco-btn-gray-l\"\n" +
                        "                                                   type=\"5\"         data-id=\""+res.id+"\"> <i\n" +
                        "                                            class=\"iconfont\">&#xe611;</i> <em>0</em> </a>\n" +
                        "                                    </div>\n" +
                        "                                    <span class=\" timeago\">刚刚</span></div><div style='margin-left: 20px'><a target='_blank'href=''>查看全文</a> </div>\n" +
                        "                            </div>\n" +
                        "                        </div>";
                    jq('.course_note').append(str);
                    layer.closeAll();
                });
            })

        })
        jq('.ask-answer').click(function () {
            var ask=" <script type=\"text/javascript\" src=\"/kyw/public//plugins/tinymce/tinymce.min.js\">"+
                "           <\/script><div class=\"layui-form\" style='margin: 10px'>\n" +
                "    <div class=\"layui-form-item\">\n" +
                "        <input type=\"text \" name=\"title\" required class=\"layui-input\" placeholder=\"请输入问题标题\">\n" +
                "    </div>\n" +
                "    <textarea id=\"ask-text\"></textarea>\n" +
                "<button class='layui-btn submit' style='float: right;position: relative;right: 20px;top: 20px;'>提交</button> " +
                "</div>\n" +
                "<script>futext(\"#ask-text\",'merge'); <\/script>";

            layer.open({
                type: 1,
                area:['900px','600px'],
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 0, //不显示关闭按钮
                anim: 2,
                title: '我要提问',
                shadeClose: true, //开启遮罩关闭
                content: ask,
                success:function () {
                },
                end:function () {
                    // location.reload();
                }
            });
            jq('.submit').click(function () {
                var title=jq('input[name=title]').val();
                var content =tinyMCE.activeEditor.getContent();
                if (clearHtmlexpImg(content) == '' || clearHtmlexpImg(content).trim() == ''||title == '' ||title.trim() == '') {
                    layer.msg('请输入内容后再提交', {icon: 2, time: 1000}, function () {
                    });
                    return;
                }
                ajaxform({'title':title,'content':content,'vid':'<?php echo $vid; ?>','uid':'<?php echo \think\Session::get('userid'); ?>'}," <?php echo url('index/course/addvideoask'); ?> ",jq,function (res) {
                    content = clearHtml(content);
                    var str="       <div class=\"wenda-listcon mod-qa-list clearfix\">\n" +
                        "                            <div class='icon-wenda'></div>\n" +
                        "                            <div class=\"headslider qa-medias l\"><a href=\"<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>\"\n" +
                        "                                                                   class=\"media\" target=\"_blank\"\n" +
                        "                                                                   title=\"<?php echo \think\Session::get('username'); ?>\"><img\n" +
                        "                                    src=\"/kyw<?php echo \think\Session::get('userhead'); ?>\"\n" +
                        "                                    width=\"40\" height=\"40\"></a></div>\n" +
                        "                            <div class=\"wendaslider qa-content\">\n" +
                        "                                <h2 class=\"wendaquetitle qa-header\">\n" +
                        "                                    <div class=\"wendatitlecon qa-header-cnt clearfix\"><a\n" +
                        "                                            href=\"<?php echo url('index/course/qadetail'); ?>?aid="+res.id+"\" target=\"_blank\"\n" +
                        "                                            class=\"qa-tit\"> <?php echo \think\Session::get('username'); ?></a></div>\n" +
                        "                                </h2>\n" +
                        "                                <div class=\"replycont qa-body clearfix\">\n" +
                        "                                    <div class=\"fl replydes best\"><span class=\"replysign\"><span\n" +
                        "                                            class=\"adopt\">暂无回答</span>  </span>\n" +
                        "                                        <div class=\"replydet\"><a  target=\"_blank\" style=\"color: white\" href=\"<?php echo url('index/course/qadetail'); ?>?aid="+res.id+"\" class=\"layui-btn\">我要发布</a></div>\n" +
                        "                                    </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"replymegfooter qa-footer clearfix\">\n" +
                        "                                    <div class=\"l-box l\"><a href=\"https://www.imooc.com/qadetail/291797\"\n" +
                        "                                                            target=\"_blank\" class=\"replynumber static-count \"> <span\n" +
                        "                                            class=\"static-item answer\"> 0 回答   </span>\n" +
                        "                                        <span class=\"static-item\">           </span>\n" +
                        "                                    </a></div>\n" +
                        "                                    <em class=\"r\">刚刚</em></div>\n" +
                        "                            </div>\n" +
                        "                        </div>";
                    jq('.course_quescon').append(str);
                    layer.closeAll();
                });
            })

        })

        //

        //


    });

</script>

</body>
</html>