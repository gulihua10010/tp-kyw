<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:63:"E:\phpStudy\WWW\kyw/application/index\view\course_qadetail.html";i:1548919880;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1548667680;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1548833968;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1547187444;}*/ ?>
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

<div class="content-index">
    <div class="main-mid">
    <span class="daohang"><a target="_blank" href="<?php echo Url('index/course/index'); ?>" >课程</a>\
        <a target="_blank" href="<?php echo Url('index/course/detail',['id'=>$course['id']]); ?>" ><?php echo $course['name']; ?></a>
        \<a target="_blank" href="<?php echo Url('index/course/showvideo',['vid'=>$video['id'],'cid'=>$course['id']]); ?>" ><?php echo $video['name']; ?></a></span>
        <div  class="user-top" >
            <a target="_blank" href="<?php echo url('user/index/home',array('id'=>$user['id'])); ?>" title="<?php echo $user['username']; ?>">
                <img src="/kyw<?php echo $user['userhead']; ?>" title="<?php echo $user['username']; ?>">
                <span><?php echo $user['username']; ?></span>
                <?php if($user['id'] == session('userid')): ?>
                <div class=" comm-edit" style="float: right">
                    <span type="edit"><a style="color:#999"  class="ask-edit" target="_blank">编辑</a></span>
                </div>
                <?php endif; ?>
            </a>
        </div>
        <div>
            <span class="ask-title"><?php echo $ask['title']; ?></span>
            <span class="ask-title-edit" style="display: none"><input type="text" class="layui-input title-edit" value="<?php echo $ask['title']; ?>"></span>
            <span class="ask-content"><?php echo clearHTMLhead($ask['content']); ?></span>
            <span class="ask-content-edit" style="display: none"><textarea id="ask-con"><?php echo $ask['content']; ?></textarea> </span>
           <div class="edit-btns" style="float: right;margin: 20px;display: none">
               <button class="layui-btn edit-save">保存</button>
               <button class="layui-btn edit-cal" style="background-color: rgb(242,242,242);color: black">取消</button>
           </div>
            <div class="comment-list" style="margin: 20px">
                <?php if(($answer==null)): ?>
                暂无回答！
                <?php endif; if(is_array($answer) || $answer instanceof \think\Collection || $answer instanceof \think\Paginator): $i = 0; $__LIST__ = $answer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="comment-unit">
                    <div class="comment-info">
                        <a target="_blank"  href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>">
                            <img src="/kyw<?php echo $vo['userhead']; ?>"  width="30"  alt="<?php echo $vo['username']; ?>"/>
                            <span><?php echo $vo['username']; ?></span></a> <span><?php echo friendlyDate($vo['time']); ?></span>
                        <?php if($vo['issolve'] == 1): ?>
                        <span style="color: #ffcc6f"><i class="iconfont">&#xe606;</i>最佳答案 </span>
                        <?php endif; ?>
                    </div>
                    <div class="comment-con">
                        <span><?php echo clearHTMLhead($vo['content']); ?></span>
                    </div>
                    <div class="comment-op">
                        <span <?php   if(in_array($vo['id'],$iszans))echo 'style="color:red"'; ?>  data-id="<?php echo $vo['id']; ?>" type="zan">
                        <i class="iconfont">&#xe611;</i>&nbsp;<span><?php echo $vo['praise']; ?></span>
                        </span>
                        <span type="reply"  data-id="<?php echo $vo['id']; ?>"  data-name="<?php echo $vo['username']; ?>"><i class="iconfont  ">&#xe644;</i>&nbsp;回复</span>
                        <?php if($vo['userid'] == session('userid')): ?>
                        <div class=" comm-edit">
                            <span type="edit"><a style="color:#999"  class="comm-ask-edit" data-id="<?php echo $vo['id']; ?>" target="_blank">编辑</a></span>
                        </div>
                        <?php endif; if($user['id'] == session('userid')): ?>
                        <div class=" comm-edit " style="margin: auto 8px;">
                            <span type="edit" > <a style="color:#ffcc6f"  class="comm-ask-solve" data-id="<?php echo $vo['id']; ?>" target="_blank">采纳为最佳</a></span>
                        </div>
                        <?php endif; ?>
                    </div>


                    <div class="reply-comment">
                        <?php if(is_array($vo['reply']) || $vo['reply'] instanceof \think\Collection || $vo['reply'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['reply'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?>
                        <div class="comment-unit">
                            <div class="comment-info">
                                <a target="_blank"  href="<?php echo url('user/index/home',array('id'=>$reply['rinfo']['id'])); ?>"><img
                                        src="/kyw<?php echo $reply['rinfo']['userhead']; ?>" width="30"></a><span>
                            <a target="_blank"   href="<?php echo url('user/index/home',array('id'=>$reply['rinfo']['id'])); ?>">
                                <?php echo $reply['rinfo']['username']; ?></a>&nbsp;回复&nbsp;<a target="_blank" href="<?php echo url('user/index/home',array('id'=>$reply['pinfo']['id'])); ?>">
                            <?php echo $reply['pinfo']['username']; ?></a></span><span><?php echo friendlyDate($reply['time']); ?></span>

                            </div>
                            <div class="comment-con">
                        <span><?php echo clearHTMLhead($reply['content']); ?>
                        </span>
                            </div>
                            <div class="comment-op">
                                <span <?php   if(in_array($reply['id'],$iszans))echo 'style="color:red"'; ?> data-id="<?php echo $reply['id']; ?>" type="zan">
                                <i class="iconfont">&#xe611;</i>&nbsp;<span><?php echo $reply['praise']; ?></span>
                                </span>

                                <span type="reply"  data-id="<?php echo $reply['id']; ?>"  data-name="<?php echo $reply['rinfo']['username']; ?>"><i class="iconfont  ">&#xe644;</i>&nbsp;回复</span>
                                <?php if($reply['rinfo']['id'] == session('userid')): ?>
                                <div class=" comm-edit">
                                    <span type="edit"><a style="color:#999"   data-id="<?php echo $reply['id']; ?>" class="comm-ask-edit"   target="_blank">编辑</a></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
                      <div class="fly-panel detail-box"  style="margin: 20px auto;">
                <a name="comment" id="edit-mode"></a>
                <div id="pinglun" class="layui-form layui-form-pane">
                    <form method="post">
                        <div class="layui-form-item layui-form-text">
                            <div class="layui-input-block"  id="reply">
                                <span id="huifu"></span>
                                <textarea id="textarea" name="content" style="height:150px;width: 100%;"  ></textarea>
                                <input type="hidden" name="tid" value="<?php echo $ask['id']; ?>" id="tid" />
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn submit-answer" lay-submit="" lay-filter="comment_add" style="background-color: rgb(23,179,241); border-radius: 5px">提交回答</button>
                            <button class="layui-btn submit-edit"   data-id="0" lay-filter="comment_edit" style="display:none;background-color: rgb(23,179,241); border-radius: 5px">更新</button>
                            <button class="layui-btn submit-edit-exit"   style="display:none;background-color: rgb(240,240,240); border-radius: 5px">取消</button>
                        </div>
                    </form>
                </div>
            </div>

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
      jq('.comm-ask-solve').click(function () {
          var $this=jq(this);
          layer.confirm('确定采纳为此问题最佳答案?', {
              btn: ['确定','取消'] //按钮
          }, function(){
              var aid=$this.data('id');
              console.log(aid)
              ajaxform({'aid':aid}," <?php echo url('index/course/bestanswer'); ?> ",jq,function (res) {
                  location.reload();
              });
          }, function(){
              layer.closeAll()
          });

      });
      jq('.ask-edit').click(function () {
          jq('.ask-title').hide();
          jq('.ask-title-edit').show();
          jq('.edit-btns').show();
          jq('.ask-content').hide();
          jq('.ask-content-edit').show();
          futext("#ask-con");
          jq('.edit-cal').click(function () {
              jq('.ask-title').show();
              jq('.ask-title-edit').hide();
              jq('.edit-btns').hide();
              jq('.ask-content').show();
              jq('.ask-content-edit').hide();
              return false;
          })
          jq('.edit-save').click(function () {
              var title=jq('.title-edit').val();
              var activeEditor = tinymce.editors[1];
              var editBody = activeEditor.getBody();
              activeEditor.selection.select(editBody);
              var text = activeEditor.selection.getContent({'format': 'text'});
             var con= tinyMCE.editors[1].getContent()

              if (text.trim()==''){
                  layer.msg('请输入必填项！', {icon: 2, time: 1000});
                  return false;
              }
              loading = layer.load(2, {
                  shade: [0.2,'#000']
              });
              var param = {
                  'data': JSON.stringify({
                      'content': con
                      , 'title': title

                  })
              }
              jq.post('<?php echo url("index/course/updatevideoask",array("id"=>$ask['id'])); ?>',param,function(data){
                  if(data.code == 200){
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                          location.reload();
                      });
                  }else{
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                  }
              });
              return false;
          })


      });


      jq('.comm-ask-edit').click(function () {
          jq(".submit-edit").unbind('click');
          //comment-con
          var con=jq(this).parent().parent().parent().parent().find('.comment-con span').html()
          tinyMCE.activeEditor.setContent(con);
          jq('.submit-edit').show();
          jq('.submit-edit').data('id',jq(this).data('id'));
          var aid=jq(this).data('id');
          // console.log(aid)
          jq('.submit-edit-exit').show();
          jq('.submit-answer').hide();
          jq('#edit-mode').html("<span style='color:#F7B824 ;font-size: 18px'>编辑模式</span>") ;
          jq("html,body").animate({scrollTop:jq ("#reply").offset().top},1000);
          jq('.submit-edit-exit').click(function () {
              jq('.submit-edit').hide();
              jq('.submit-edit-exit').hide();
              jq('.submit-answer').show();
              tinyMCE.activeEditor.setContent('');
              jq('#edit-mode').html('');
              return false;
          })
          // console.log
          jq('.submit-edit').click(function () {

              var aid=jq(this).data('id');
              // console.log(jq(this).data('id'))
              // console.log( jq('.submit-edit').data('id'))
              console.log('r')
              var activeEditor = tinymce.editors[0];
              var editBody = activeEditor.getBody();
              activeEditor.selection.select(editBody);
              var text = activeEditor.selection.getContent({'format': 'text'});
              var con= tinyMCE.editors[0].getContent()
                // console.log(text);
              if (text.trim()==''){
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
              jq.post('<?php echo url("index/course/updatevideoanswer"); ?>?aid='+aid,param,function(data){
                  if(data.code == 200){
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                          location.reload();
                      });
                  }else{
                      layer.close(loading);
                      layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                  }
              });
              return false;
          })


      });

      //comm-ask-edit
  jq('span[type=zan]').click(function(){
          var idnum=jq(this).data('id');
          var obj=jq(this);
          jq.post('<?php echo url("course/zan"); ?>',{'type':3,'id':idnum,'uid':'<?php echo \think\Session::get('userid'); ?>'},function(data){
              if(data.code == 200){
                  jq(obj).css('color','red');
                  var intnum=parseInt(jq(obj).find('span').html());
                  jq(obj).find('span').html(intnum+1);
                  layer.msg(data.msg, {icon: 1, time: 1000}, function(){

                  });
              }else{
                  layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
              }
          });

      });
      jq('span[type=reply]').click(function(){
          jq("html,body").animate({scrollTop:jq ("#reply").offset().top},1000);
          var idnum=jq(this).data('id');
          var htmlname='@'+ jq(this).attr('data-name');
          jq('#tid').val(idnum);
          jq('#huifu').html('<i style="color:#F7B824">'+htmlname+'</i>');

      });

      form.on('submit(comment_add)', function(data){
          var activeEditor = tinymce.activeEditor;
          var editBody = activeEditor.getBody();
          activeEditor.selection.select(editBody);
          var text = activeEditor.selection.getContent({'format': 'text'});
          if (text.trim()==''){
              layer.msg('请输入必填项！', {icon: 2, time: 1000});
              return false;
          }

          loading = layer.load(2, {
              shade: [0.2,'#000']
          });
          var param = {
              'data': JSON.stringify({
                  'content': tinyMCE.activeEditor.getContent()
                  , 'tid': jq('input[name=tid]').val()

              })
          }
          jq.post('<?php echo url("index/course/answer",array("id"=>$video['id'])); ?>',param,function(data){
              if(data.code == 200){
                  layer.close(loading);
                  layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                      location.reload();
                  });
              }else{
                  layer.close(loading);
                  layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
              }
          });
          return false;
      });

  })
</script>

</body>
</html>