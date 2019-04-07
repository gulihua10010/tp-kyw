<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:65:"E:\phpStudy\WWW\kyw/application/index\view\course_notedetail.html";i:1548919480;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1548667680;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1548833968;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
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

<div class="content-index" style="min-height: 600px" >
    <div class="main-mid user-note-top">
            <a target="_blank" href="<?php echo url('user/index/home',array('id'=>$user['id'])); ?>" title="<?php echo $user['username']; ?>">
                <img src="/kyw<?php echo $user['userhead']; ?>" title="<?php echo $user['username']; ?>"></a>
            <span><a target="_blank" href="<?php echo url('user/index/home',array('id'=>$user['id'])); ?>" title="<?php echo $user['username']; ?>">
                <?php echo $user['username']; ?>的课程笔记</a></span><span>课程名称:
                <a target="_blank" href="<?php echo Url('index/course/detail',['id'=>$course['id']]); ?>"><?php echo $course['name']; ?></a></span>
                <div class="user-note-btn" style="float: right">
                    <span type="edit"><a style="color:#999"  class="ask-edit" target="_blank" href="<?php echo url('user/index/home',array('id'=>$user['id'])); ?>">TA的个人中心</a></span>
                </div>

    </div>
        <div class=" main-mid note-main "  >
            <div class="note-top">
                <span> <i class="iconfont">&#xe629;</i> <a target="_blank" href="<?php echo Url('index/course/showvideo',array('vid'=>$video['id'],'cid'=>$course['id'])); ?>"> <?php echo $video['name']; ?></a></span>

            </div>
            <div class="note-con">
            <span class="note-content"><?php echo clearHTMLhead($note['content']); ?></span>
            <span class="note-content-edit" style="display: none"><textarea id="ask-con"><?php echo $note['content']; ?></textarea> </span>
           <div class="note-btns" style=" margin: 20px;display: none">
               <button class="layui-btn edit-cal fr" style="background-color: rgb(242,242,242);color: black">取消</button>
               <button class="layui-btn edit-save fr">保存</button>

           </div>
            <?php if($user['id'] == session('userid')): ?>
            <div class=" note-op  "  >
                <a title="赞" href="javascript:(0);"
                                        class="js-pl-praise moco-btn moco-btn-gray-l" type="5"
                                        data-id="<?php echo $note['id']; ?>"> <i <?php if(in_array($note['id'],$iszans))echo ('style="color:red"');  ?>
                    class="iconfont">&#xe611;</i> <em><?php echo $note['praise']; ?></em> </a>

                <span type="del" class="fr"><a style="color:#999"  class="note-del" target="_blank">删除</a></span>
                <span type="edit" class="fr"><a style="color:#999"  class="note-edit" target="_blank">编辑</a></span>
            </div>
                <?php else: ?>
                <a title="赞" href="javascript:(0);"
                   class="js-pl-praise moco-btn moco-btn-gray-l" type="5" style="position: relative;top: 20px;"
                   data-id="<?php echo $note['id']; ?>"> <em><i  class="iconfont">&#xe611;</i><?php echo $note['praise']; ?></em> </a>

                <?php endif; ?>
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
    futext('#textarea');

</script>
<script>

  layui.use('form', function() {
      var form = layui.form
          , jq = layui.jquery;

      jq('span[type=edit]').click(function () {
          jq('.note-content').hide();
          jq('.note-op').hide();
          jq('.note-content-edit').show();
          jq('.note-btns').show();
          futext("#ask-con");
          jq('.edit-cal').click(function () {
              jq('.note-btns').hide();
              jq('.note-content').show();
              jq('.note-op').show();
              jq('.note-content-edit').hide();
              return false;
          })
          jq('.edit-save').click(function () {
             var con= tinyMCE.activeEditor.getContent()
              if (clearHtmlexpImg(con) == '' || clearHtmlexpImg(con).trim() == ''){
                  layer.msg('请输入必填项！', {icon: 2, time: 1000});
                  return false;
              }
              loading = layer.load(2, {
                  shade: [0.2,'#000']
              });
              var param = {
                  'data': JSON.stringify({
                      'content': con

                  })
              }
              jq.post('<?php echo url("index/course/updatevideonote",array("id"=>$note['id'])); ?>',param,function(data){
                  if(data.code == 200){
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                          // location.reload();
                      });
                  }else{
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                  }
              });
              return false;
          })


      });

   jq('span[type=del]').click(function () {
       layer.confirm('你确定要删除该条笔记吗?', {icon: 3, title:'删除提示'}, function(index){
           loading = layer.load(2, {
               shade: [0.2,'#000']
           });

           jq.getJSON('<?php echo url("index/course/delnote" ,array("nid"=>$note['id'])); ?>',function(data){
               if(data.code == 200){
                   layer.close(loading);
                   layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                        window.close()
                   });
               }else{
                   layer.close(loading);
                   layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
               }
           });
       });
       return false;
   })

  jq('.js-pl-praise').click(function(){
      var id=jq(this).attr('data-id');
      var type=jq(this).attr('type');
      var uid='<?php echo \think\Session::get('userid'); ?>';
      var $this=jq(this);
      ajaxform({'type':type,'id':id,'uid':'<?php echo \think\Session::get('userid'); ?>'}," <?php echo url('index/course/zan'); ?> ",jq,function (res) {
          $this.find('i').css('color','red');
          var tt=$this.find('em').text();
          $this.find('em').text(parseInt(tt)+1);
      });
      });



  })
</script>

</body>
</html>