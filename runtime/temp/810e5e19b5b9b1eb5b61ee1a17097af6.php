<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:61:"E:\phpStudy\WWW\kyw/application/index\view\course_detail.html";i:1548742022;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1554441040;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554174358;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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
    
<link rel="stylesheet" href="/kyw/public/css/course.css">


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

<div class="wrapper ">
    <div class="detail-header clearfix" id="J_package">
        <div class="detail-h">
        <div class="preview fl">
            <img id="J_videoImg" src="/kyw<?php echo $course['pic']; ?>" title="<?php echo $course['name']; ?>"
                 alt="<?php echo $course['name']; ?>">
        </div>
        <div class="info fl">
            <div class="title">
                <h1 title="<?php echo $course['name']; ?>"><?php echo $course['name']; ?></h1>
            </div>
            <div class="course-detail clearfix fcz">
                <div class="fl" style="width:50%">
                    学习人数：<?php echo $course['learnperson']; ?>人
                </div>
                <div class="fl" style="width:50%">
                    <label class="fl">评分：</label>
                    <p class="b-star-box fl">
                        <?php  for($i=0;$i<$course['star'];$i++) echo(" <span class='full-s'><i
                            class='iconfont' style='color: #ffcc6f'>&#xe60a;</i></span>"); ?>
                    </p>
                </div>
                <div class="fl" id="td" style="width:50%">
                    课时：<?php echo $course['classhour']; ?>
                </div>
            </div>

            <div class="mb20 price-wrap">
                <div class="clearfix">
                    <div class="price fl clearfix">
                        <div class="fl clearfix">
                            <p class="fs30 price-green">免费</p>
                        </div>
                        <div class="fl clearfix">
                            <a class="consult" href="javascript:(0);" id="fav" style="cursor: pointer">
                                <?php if($isFav==1): ?><i class="iconfont"
                                                             style="color: #ffcc6f">&#xe60a;</i><em>已收藏</em><?php else: ?><i
                                    class="iconfont">&#xe60a;</i><em>收藏</em><?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="detail-main clearfix">
        <div class="main-left">

            <div>
                <div class="mainLeftNav" id="mainLeftNav">


                    <a href="javascript:;" class="active" id="study" style="width: 34%;">在线学习</a>
                    <a href="javascript:;" style="width: 33%;">课程介绍</a>
                    <a href="javascript:;" style="width: 33%;">用户评论</a>
                </div>

                <div class="bgwhite clist cour-list">
                    <?php if(is_array($videos) || $videos instanceof \think\Collection || $videos instanceof \think\Paginator): if( count($videos)==0 ) : echo "" ;else: foreach($videos as $k=>$vo): ?>
                    <div class="course-item-0">
                        <h3><?php echo $k+1; ?>、<?php echo $vo['name']; ?></h3>
                        <div class="course-list">
                            <ul>
                                <?php if(is_array($vo['sub']) || $vo['sub'] instanceof \think\Collection || $vo['sub'] instanceof \think\Paginator): if( count($vo['sub'])==0 ) : echo "" ;else: foreach($vo['sub'] as $s=>$sub): ?>
                                <li class="course-item  ">
                                    <dl class="module-list course-hour-item  ">
                                        <dd class="module-item  ">
                                            <div class="course-tit-info">
                                                <span class="course-tit"><?php if($sub['video'] != ''): ?><i class="iconfont">&#xe62a;</i><?php endif; ?>&nbsp;<?php echo $k+1; ?>.<?php echo $s+1; ?>、 <?php echo $sub['name']; ?></span>
                                                <?php if($sub['video'] != ''): ?>
                                                <div class="fr">
                                                    <span class="duration shichang"
                                                          shichang="1808">时长 ： <?php echo $sub['duration']; ?></span>
                                                    <a class="item-btn show-video" <?php if(in_array($sub['id'],$watches)){ echo ("data-name='1'");}else {echo ("data-name='0'");}  ?>  style="cursor: pointer" data-id="<?php echo $sub['id']; ?>">【立即观看】</a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </dd>
                                    </dl>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="bgwhite   clist">
                    <h3>课程介绍</h3>
                    <div class="txt">
                        <p>
                            <?php echo clearHTMLhead($course['introduce']); ?>
                        </p>
                    </div>
                </div>
                <div class="clist bgwhite">
                    <h3>用户评论</h3>
                    <div class="content-box">
                        <div class="answer-top clearfix">
                            <div class="phone fl">
                                <em class="phone-bg">
                                    <img style="border-radius: 30px" src='<?php if(\think\Session::get('userhead') == ''): ?>/kyw/public/images/defaultbw.png<?php else: ?>/kyw<?php echo \think\Session::get('userhead'); endif; ?>'>
                                </em>
                            </div>
                            <div class="fl">
                                <div class="df-text fl"><span class="redc">*</span>我要打分</div>
                                <div id="stars" style="margin-left: 30px"></div><span id="start-value"></span>
                            </div>
                        </div>
                        <div class="answer-mid clearfix">
                                <textarea class="origin-color" maxlength="300" placeholder="扯淡、吐槽、表扬...想说啥说啥"
                                          id="content"></textarea>
                            <a class="submitBtn submit-btn add-comment" href="javascript:(0);">发布</a>
                        </div>
                        <div class="answer-bottom">
                            <dl class="answer-list">
                                <dd style="display:none;" id="addComment"></dd>
                                <?php if(is_array($comms) || $comms instanceof \think\Collection || $comms instanceof \think\Paginator): $i = 0; $__LIST__ = $comms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <dd class="list-item">
                                    <div class="phone">
                                        <em class="phone-bg">
                                            <img src="/kyw<?php echo $vo['userhead']; ?>"/>
                                        </em>
                                    </div>
                                    <div class="comment-box">
                                        <div class="comment-edit clearfix">
                                            <span class="fl"><?php echo $vo['username']; ?></span>
                                            <div class="star-box fl">
                                                <?php  for($i=0;$i<$vo['star'];$i++)echo(' <span class="n-s active"><i class="iconfont" style="color: #ffcc6f">&#xe60a;</i> </span>'); ?>

                                            </div>
                                        </div>
                                        <div class="comment-des">
                                            <?php echo clearHTMLhead($vo['content']); ?>
                                        </div>
                                        <p class="operate-box">时间<?php echo friendlyDate($vo['time']); ?></p>
                                    </div>
                                </dd>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-right">
            <div class="other-see bgwhite refreshMore">
                <div class="tea-tit">学过的人还学了</div>
                <ul>
                    <?php if(is_array($right_tj) || $right_tj instanceof \think\Collection || $right_tj instanceof \think\Paginator): $i = 0; $__LIST__ = $right_tj;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <a target="_blank" href="<?php echo Url('index/course/detail',['id'=>$vo['id']]); ?>">
                            <img src="/kyw<?php echo $vo['pic']; ?>">
                            <span class="courseText" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></span>
                        </a>
                        <div class="clearfix">
                            <span class="coursePrice pred">免费</span>

                            <span class="courseTime"><?php echo $vo['learnperson']; ?>在学</span>
                        </div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>

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


<script type="text/javascript" src="/kyw/public//plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/kyw/public//js/date.format.js"></script>

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

    layui.use(['layer', 'form', 'element','rate' ], function () {
        var rate = layui.rate
            , $ = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        futext('#content');
        rate.render({
            elem: '#stars'
            , value: 5 //初始值
            , text: true //开启文本
            ,choose: function(value){
                $('#start-value').val(value);
            }
        });

    var oNav = $('#mainLeftNav');
    var aNav = oNav.find('a');
    var aDiv = $('.main-left .clist');
    $(window).scroll(function () {
        var winH = $('#J_package').height();
        var iTop = $(window).scrollTop();
        if (iTop >= winH) {
            aDiv.each(function () {
                if (iTop - $(this).offset().top > $(this).height() / 2) {
                    oNav.addClass('nav-fixed');
                    aNav.removeClass('active');
                    aNav.eq($(this).index()).addClass('active');
                }
            })
        } else {
            oNav.removeClass('nav-fixed');
            aNav.removeClass('active');
            aNav.eq(0).addClass('active');
        }
    })
    aNav.click(function () {
        var t = aDiv.eq($(this).index()).offset().top;
        $('body,html').animate({"scrollTop": t - 35}, 500);
        $(this).addClass('active').siblings().removeClass('active');
    });
    $('#fav').click(function () {
        '<?php if(\think\Session::get('userid')  == ''): ?>'
        showLogin();
        return;
        '<?php endif; ?>'
            var msg = $("#fav em").html().trim();
            var method = '';
            if (msg == '收藏') {
                method = 'addFavoritesItems';
                msg = '已收藏';
            } else {
                msg = '收藏';
                method = 'delFavoritesItems';
            }
            var url = '<?php echo Url("index/course/method"); ?>';
            url = url.replace(/method/, method);
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: {"uid": "<?php echo \think\Session::get('userid'); ?>", "cid": "<?php echo $course['id']; ?>"},
                success: function (res) {
                    if (res.code == 200) {
                        if (method == 'addFavoritesItems') {
                            $("#fav").find('i').css('color', '#ffcc6f');
                            layer.msg(res.msg, {icon: 1, time: 1000}, function () {

                            });
                        } else if (method == 'delFavoritesItems') {
                            $("#fav").find('i').removeAttr("style");
                            layer.msg(res.msg, {icon: 1, time: 1000}, function () {

                            });
                        }
                        $("#fav em").html(msg);
                    } else {
                        layer.msg(res.msg, {icon: 2, time: 1000}, function () {
                        });
                    }
                },
                error: function (res) {
                    layer.msg('加载失败', {icon: 2, time: 1000}, function () {
                    });

                }
            });
        });
$('.show-video').click(function () {
    var vid=$(this).attr('data-id');
    var cid="<?php echo $course['id']; ?>";
    '<?php if(\think\Session::get('userid')  == ''): ?>'
    showLogin();
    return;
    '<?php endif; ?>'
    var iswatch=$(this).data('name');
    // console.log(iswatch)
    if (iswatch==1){
        layer.confirm('此视频已经看过了，可以直接观看！', {
            btn: ['确定','取消'] //按钮
        }, function(){
            window.open("<?php echo Url('index/course/showvideo'); ?>?vid="+vid+"&cid="+cid);

            layer.closeAll()
        }, function(){
            layer.closeAll()
        });
    }else{
        layer.confirm('观看此视频需要消耗<?php echo $course['point']; ?>积分，确定观看?', {
            btn: ['确定','取消'] //按钮
        }, function(){
            ajaxform({'point':'<?php echo $course['point']; ?>'}," <?php echo url('index/course/watchpoint'); ?>?vid="+vid+"&cid="+cid,$,function (res) {
                window.open("<?php echo Url('index/course/showvideo'); ?>?vid="+vid+"&cid="+cid);
                layer.closeAll()
            });
        }, function(){
            layer.closeAll()
        });
    }

})

        $('.add-comment').click(function () {
            '<?php if(\think\Session::get('userid')  == ''): ?>'
            showLogin();
            return;
            '<?php endif; ?>'
                var activeEditor = tinymce.activeEditor;
                var editBody = activeEditor.getBody();
                activeEditor.selection.select(editBody);
                var text = activeEditor.selection.getContent({'format': 'text'});
               var content =tinyMCE.activeEditor.getContent();
                var num = $('#start-value').val()  ;
            if (text == '' || text.trim() == '') {
                console.log(num)
                layer.msg('请输入留言评价后再提交', {icon: 2, time: 1000}, function () {
                });
                return;
            }
          num= num==0?5:num;
            $.ajax({
                url: '<?php echo Url("index/course/addCommon"); ?>',
                type: "post",
                dataType: "json",
                data: {"uid": "<?php echo \think\Session::get('userid'); ?>", "cid": "<?php echo $course['id']; ?>", "content": content, "star": num},
                success: function (res) {
                    if (res.code == 200) {
                        var datetime = new Date().Format("yyyy-MM-dd hh:mm:ss");
                        var str = '';
                        str += '<dd class="list-item">';
                        str += '<div class="phone">';
                        str += '	<em class="phone-bg">';
                        str += '	<img src="/kyw<?php echo \think\Session::get('userhead'); ?>"/>';
                        str += '		</em>';
                        str += '	</div>';
                        str += '	<div class="comment-box">';
                        str += '		<div class="comment-edit clearfix">';
                        str += '			<span class="fl"><?php echo \think\Session::get('username'); ?></span>';
                        str += '			<div class="star-box fl">';
                        for (var i = 1; i <= num; i++) {
                                str += '<span class="n-s active"><i class="iconfont" style="color: #ffcc6f">&#xe60a;</i> </span>';
                        }
                        str += '			</div>';
                        str += '		</div>';
                        str += '		<div class="comment-des">';
                        str += content;
                        str += '		</div>';
                        str += '		<p class="operate-box">时间：' + datetime + '</p>';
                        str += '	</div>';
                        str += '</dd>';
                        $('#addComment').after(str);
                        $("#content").val('');
                        $('#nocomments').remove();
                        layer.msg(res.msg, {icon: 1, time: 1000}, function () {

                        });
                    } else {
                        layer.msg(res.msg, {icon: 2, time: 2000}, function () {

                        });
                    }
                },
                error: function (res) {
                    layer.msg('加载失败', {icon: 2, time: 1000}, function () {
                    });

                }
            });
        });

  });

</script>


</body>
</html>