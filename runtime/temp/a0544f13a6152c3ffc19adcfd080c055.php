<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"E:\phpStudy\WWW\kyw/application/index\view\index_reg.html";i:1546596508;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1546587990;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1546588684;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1546587362;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>登录|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
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
        <i class="iconfont icon-<?php echo $vo['icon']; ?>" ></i><?php echo $vo['name']; ?>
      </a>
      <?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
    
    <div class="nav-user">
    
  <?php if(\think\Session::get('userid') != ''): ?>
     <!-- 登入后的状态 -->
      <a class="avatar" href="<?php echo url('user/home',array('id'=>\think\Session::get('userid'))); ?>">
        <img src="<?php echo getheadurl(\think\Session::get('userhead')); ?>">
        <cite><?php echo \think\Session::get('username'); ?></cite>
        <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
      </a>
      <div class="nav">
        <a href="<?php echo url('user/set'); ?>"  ><i class="iconfont icon-shezhi"></i>设置</a>
        <a data-url="<?php echo url('login/logout'); ?>" location-url="<?php echo url('index/login'); ?>"  href="javascript:void(0)" class="logi_logout"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
      </div>
  
<?php else: ?>
          <!-- 未登入状态 -->
      <a class="unlogin"  href="<?php echo url('index/login'); ?>" ><i style="color:#fff;" class="iconfont icon-touxiang"></i></a>
      <span  class="unlogin-btn">
          <a href="<?php echo url('index/login'); ?>"  style="color:#fff;">登录</a><a href="<?php echo url('login/reg'); ?>"  style="color:#fff;">注册</a></span>
       <?php endif; ?>

    </div>
  </div>
</div>


<div class="main layui-clear">

  <div class="fly-panel fly-panel-user" pad20>
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title">
        <li><a href="<?php echo url('index/login'); ?>">登入</a></li>
        <li class="layui-this">注册</li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <form method="post">
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="usermail" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
              </div>
              <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">昵称</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_username" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">不少于6个字符与数字组成</div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
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
                <button class="layui-btn" lay-filter="login_reg" lay-submit>立即注册</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

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
        <i class="iconfont icon-<?php echo $vo['icon']; ?>"></i><?php echo $vo['name']; ?>
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
layui.use('form',function(){
  var form = layui.form()
  ,jq = layui.jquery;



  form.on('submit(login_reg)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    var param = data.field;
    
    jq.post('<?php echo url("login/reg"); ?>',param,function(data){
    	
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.href = '<?php echo url("index/login"); ?>';
        });
      }else{
        layer.close(loading);
        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
        jq('#captcha').attr('src','<?php echo url("login/captcha"); ?>?'+Math.random());
      }
    });
    return false;
  });

})
</script>
</body>
</html>