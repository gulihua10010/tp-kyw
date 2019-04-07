<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"E:\phpStudy\WWW\kyw/application/index\view\index_set.html";i:1546847348;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1546587990;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1546789414;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1546787432;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>用户设置|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public//images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public//plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public//css/globals.css">
	<?php if($site_config['tplh'] == 1): ?>
	<link rel="stylesheet" href="/kyw/public//css/full.css">
	<?php endif; ?>
    
<script src="/kyw/public//plugins/layui/layui.js"></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav">
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pid'] == '1'): ?>
      <a class="nav-this" href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>"  >
          <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <div class="nav-user">
    
  <?php if(\think\Session::get('userid') != ''): ?>
     <!-- 登入后的状态 -->
      <a class="avatar" href="<?php echo url('user/home',array('id'=>\think\Session::get('userid'))); ?>">
        <img src="<?php echo getheadurl(\think\Session::get('userhead')); ?>">
        <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
        <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
      </a>
      <div class="nav">
        <a href="<?php echo url('index/user/set'); ?>"   style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
        <a data-url="<?php echo url('index/user/logout'); ?>" location-url="<?php echo url('index/user/login'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
            <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
      </div>
    <?php else: ?>
          <!-- 未登入状态 -->
      <a class="unlogin"  href="<?php echo url('index/login'); ?>" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
      <span  class="unlogin-btn">
          <a href="<?php echo url('index/user/login'); ?>"  style="color:#fff;">登录</a><a href="<?php echo url('index/user/reg'); ?>"  style="color:#fff;">注册</a></span>
       <?php endif; ?>

    </div>
  </div>
</div>


<div class="main layui-clear">

<style >
 .user-set{
  background-color: rgb(251,251,251)!important;
}
.user-set li a{
  color: #0C0C0C !important;
}
.tab-this a{
  background-color: rgb(23,179,241 ) !important;;
}
.tab-this a>i{
  color: white !important;
}
 .user-set li a:hover{
   background-color: rgba(23,179,241 ,0.7) !important;;
 }
  button{
  background-color: rgb(23,179,241) !important;
    border-radius: 5px !important;
  }
  .panel-user{
    padding: 0 20px!important;
  }
</style>
<div class="fly-user-main">
    <ul class="layui-nav layui-nav-tree layui-inline user-set"  lay-filter="user"  >
    <li class="layui-nav-item">
      <a href="<?php echo url('user/home',array('id'=>$uid)); ?>">
        &nbsp;<i class="iconfont">&#xe607;</i>
        我的主页
      </a>
    </li>
    <li class="layui-nav-item">
      <a href="<?php echo url('user/topic'); ?>">
        &nbsp;<i class=" iconfont">&#xe62d;</i>
        我的帖子
      </a>
    </li>
     <li class="layui-nav-item">
      <a href="<?php echo url('user/comment'); ?>">
        &nbsp;<i class="iconfont">&#xe644;</i>
        我的回复
      </a>
    </li>
    <li class="layui-nav-item">
      <a href="<?php echo url('user/message'); ?>">
        &nbsp;<i class="iconfont">&#xe61b;</i>
        我的消息
      </a>
    </li>
    <li class="layui-nav-item layui-this tab-this" >
      <a href="<?php echo url('user/set'); ?>"  style="color: white !important;">
        &nbsp;<i class="iconfont">&#xe65f;</i>
        基本设置
      </a>
    </li>
    
  </ul>
  
  <div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
  </div>
  <div class="site-mobile-shade"></div>
  
  <div class="fly-panel fly-panel-user panel-user"  >
    <div class="layui-tab layui-tab-brief" lay-filter="user">
      <ul class="layui-tab-title" id="LAY_mine">
        <li class="layui-this" lay-id="info">我的资料</li>
        <li lay-id="avatar">头像</li>
        <li lay-id="pass">密码</li>
        <li lay-id="photowall">照片墙</li>
      </ul>
      <div class="layui-tab-content" style="padding: 20px 0;">
        <div class="layui-form layui-form-pane layui-tab-item layui-show">
          <form method="post">
            <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">邮箱</label>
              <div class="layui-input-inline">
                <input type="text" id="L_email" name="usermail" required lay-verify="email" autocomplete="off"  value="<?php echo $tptc['usermail']; ?>"  class="layui-input">

              </div>
               <div class="layui-form-mid layui-word-aux" id="yzemail">如果您需要变更邮箱，需
              <a href="javascript:;" style="font-size: 12px; color: #4f99cf;"  id="rejhemail">重新验证邮箱</a>。</div>
            </div>
            <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">昵称</label>
              <div class="layui-input-inline">
                <input type="text" id="L_username" name="username" required lay-verify="required" value="<?php echo $tptc['username']; ?>"  autocomplete="off" value="" class="layui-input">
              </div>
              <div class="layui-inline">
                <div class="layui-input-inline">
                 <input type="radio" name="sex" value="1" title="男" <?php if($tptc['sex'] == 1): ?>checked<?php endif; ?>>
					  <input type="radio" name="sex" value="0" title="女" <?php if($tptc['sex'] == 0): ?>checked<?php endif; ?>>
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_city" class="layui-form-label">城市</label>
              <div class="layui-input-inline">
                <input type="text" id="L_city" name="userhome" value="<?php echo $tptc['userhome']; ?>"  autocomplete="off" value="" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <label for="L_sign" class="layui-form-label">签名</label>
              <div class="layui-input-block">
                <textarea placeholder="随便写些什么刷下存在感" id="L_sign"  name="description" autocomplete="off" class="layui-textarea" style="height: 80px;"><?php echo $tptc['description']; ?></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn" key="set-mine"  lay-filter="user_set" lay-submit ='' >确认修改</button>
            </div>
          </div>
          
          <div class="layui-form layui-form-pane layui-tab-item">
        <form method="post">
			<div class="layui-form-item">
              <div class="avatar-add">
                <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过50KB</p>
                <div class="upload-img">
                  <button type="button" class="layui-btn" id="image">
                    <i class="layui-icon">&#xe67c;</i>上传头像
                  </button>
	              <input type="hidden" name="userhead" value="<?php echo $tptc['userhead']; ?>" class="layui-input">
                </div>
                <img id="headedit" src="<?php echo getheadurl($tptc['userhead']); ?>">
              </div>
            </div>
			<div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="user_headedit">确认修改</button>
            </div>
			</form>
          </div>
          
          <div class="layui-form layui-form-pane layui-tab-item">
            <form  method="post">
              <div class="layui-form-item">
                <label for="L_nowpass" class="layui-form-label">当前密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_nowpass" name="nowpass" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">新密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="password" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
              </div>
              <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="confirm_password" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <button class="layui-btn" key="set-mine"  lay-filter="user_setedit" lay-submit>确认修改</button>
              </div>
            </form>
          </div>
        <div class="layui-form layui-form-pane layui-tab-item" >
          <form method="post">
            <div class="layui-form-item" style="background-color:rgb(242,242,245);width:  95%">
              <div class="avatar-add">
                <p>建议尺寸1100*300，支持jpg、png、gif</p>
                <div class="upload-img">
                  <button type="button" class="layui-btn" id="photowall">
                    <i class="layui-icon">&#xe67c;</i>上传照片墙
                  </button>
                  <input type="hidden" name="photowall" value="<?php echo $tptc['photowall']; ?>" class="layui-input">
                </div>
                <!--<img id="photo-wall" width="80%" height="50%" src="<?php echo $tptc['photowall']; ?>">-->
                <?php if($tptc['photowall'] ==  ''): ?>
                <img  class="photo-wall"  style="border-radius: 0px; width: 200px; height: 100px"  } src="/kyw/public//images/nopic.png"
                  <?php else: ?>   <img class="photo-wall"  style="border-radius: 0px; width: 800px; height: 200px;position: relative;left: 50px"  } src="<?php echo getheadurl($tptc['photowall']); ?>"
                <?php endif; ?>>
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn" lay-submit="" lay-filter="user_photoedit">确认修改</button>
            </div>
          </form>
        </div>
        </div>

      </div>
    </div>
  </div>
<script src="/kyw/public//js/common.js"></script>

<?php if(session('userid') > 0): ?>
        <a href="<?php echo url('forum/add'); ?>" class="site-tree-mobile-edit layui-hide">
    <i class="iconfont icon-fabu"></i>
  </a>
  <?php endif; ?>
</div>

				
    
<div class="footer">
  <p>
     <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pid'] == '0'): ?>
      <a class="nav-this" href="<?php echo $vo['link']; ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>">
        <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
  </p>
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


<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

<script>

layui.use(['form', 'upload', 'element'],function(){
  var form = layui.form
  ,element = layui.element
  ,jq = layui.jquery
  ,upload = layui.upload;
var n=1;
  jq('.site-tree-mobile').click(function(){
	  
	  if( n==2){
		  jq('.layui-nav').animate({left: '-300px'}, "fast");
		 jq(this).find('.layui-icon').html('&#xe602;');
		  n=1;
	  }else{
		  n=2;
		  jq('.layui-nav').animate({left: '0px'}, "fast");
		  jq(this).find('.layui-icon').html('&#xe603;');
	  }
  });

    upload.render({
        url: '<?php echo url("admin/upload/upimage"); ?>'
        , elem: '#photowall'
        , exts: 'jpg|png|jpeg'
        , before: function (input) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
        }
        , done: function (res) {
            layer.close(loading);
            jq('input[name=photowall]').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            jq('.photo-wall').attr('src',getRootPath_web()+res.path);
            jq('.photo-wall').css({
                'width':'800px',
                'height':'200px',
                'position': 'relative',
                'left': '50px'

            })
        }, error: function () {
            layer.close(loading);
            layer.msg('上传出错：1', {
                title: '提示'
                //不自动关闭
                , time: 1000
                , icon: 5
                , offset: '400px'
            });
        }
    });

    upload.render({
        url: '<?php echo url("admin/upload/upimage"); ?>'
        , elem: '#image'
        , exts: 'jpg|png|gif'
        , before: function (input) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
        }
        , done: function (res) {
            layer.close(loading);
            jq('input[name=userhead]').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            jq('#headedit').attr('src',getRootPath_web()+res.path);
        }, error: function () {
            layer.close(loading);
            layer.msg('上传出错：1', {
                title: '提示'
                //不自动关闭
                , time: 1000
                , icon: 5
                , offset: '400px'
            });
        }
    });
  var emailold='';
  
  jq('#rejhemail').click(function(){
	  //重新激活邮箱后，去掉disable,然后传送email的参数
		//  var id= jq(this).data('id');
	  	var url="<?php echo url('index/user/resetmail'); ?>";

		  var reemail=jq('#L_email').val();
		  if(reemail==emailold){
			  layer.msg('请更改邮箱进行验证', {icon: 2, anim: 6, time: 1000});
		  }else{
			  jq.post(url,{'email':reemail},function(data){
			      if(data.code == 200){
			        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
			        	 jq('#L_email').attr('disabled','disabled');
			        	 jq('#yzemail').html('邮件已经发出！请查收')
			        });
			      }else{
			        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
			      }
			    });
		  }
	  
 });
  
  

  form.on('submit(user_set)', function(data){
      if (jq('#L_email').val()!='<?php echo $tptc['usermail']; ?>') {
          layer.msg('请先验证新邮箱！', {icon: 2, time: 1000}, function(){
          });
          return false;
      }
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    var param = data.field;
    jq.post('<?php echo url("user/set"); ?>',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){

        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
    return false;
  });

  form.on('submit(user_setedit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    var param = data.field;
    jq.post('<?php echo url("index/user/setedit"); ?>',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.href = '<?php echo url("/index/user/set"); ?>';
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
    return false;
  });

  form.on('submit(user_headedit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    console.log(data);
    var param = data.field;
    jq.post('<?php echo url("index/user/headedit"); ?>',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.href = '<?php echo url("index/user/set"); ?>';
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
      }
    });
    return false;
  });

    form.on('submit(user_photoedit)', function(data){
        loading = layer.load(2, {
            shade: [0.2,'#000']
        });
        console.log(data);
        var param = data.field;
        jq.post('<?php echo url("index/user/photoedit"); ?>',param,function(data){
            if(data.code == 200){
                layer.close(loading);
                layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                    location.href = '<?php echo url("index/user/set"); ?>';
                });
            }else{
                layer.close(loading);
                layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
            }
        });
        return false;
    });
});
</script>
</body>
</html>