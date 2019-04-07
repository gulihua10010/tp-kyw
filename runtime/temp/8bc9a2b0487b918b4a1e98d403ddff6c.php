<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"E:\phpStudy\WWW\kyw/application/user\view\index_reg.html";i:1547727892;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1548817152;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1548821266;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548815724;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>登录|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>


<meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
<meta name="description" content="<?php echo $site_config['seo_description']; ?>">

    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">

    
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <script src="/kyw/public/js/common.js"></script>

</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav">
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <a class="nav-this" href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>"  >
          <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <div class="nav-user">
        <?php if(\think\Session::get('userid') != ''): ?>
        <!-- 登入后的状态 -->
        <a class="avatar" href="<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>">
            <img src="/kyw<?php echo \think\Session::get('userhead'); ?>">
            <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
            <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
        </a>
        <div class="nav">
            <a href="<?php echo url('user/index/set'); ?>"   style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
            <a data-url="<?php echo url('user/index/logout'); ?>" location-url="<?php echo url('user/index/login'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
                <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
        </div>
        <?php else: ?>
        <!-- 未登入状态 -->
        <div class="lg-reg">
            <a class="unlogin"  onclick="showLogin();" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
            <span  class="unlogin-btn" style="cursor: pointer">
          <a onclick="showLogin();" style="color:#fff;">登录</a><a onclick="showReg();"  style="color:#fff;">注册</a></span></div>
        <?php endif; ?>    {/if}

    </div>
  </div>
</div>


<div class="main layui-clear  ">

<div class="fly-panel fly-panel-user" pad20>
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li><a href="<?php echo url('user/index/login'); ?>">登录</a></li>
            <li class="layui-this">注册</li>
        </ul>
        <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
            <div class="layui-tab-item layui-show">
                <div class="layui-form layui-form-pane">
                    <form method="post">
                        <div class="layui-form-item">
                            <label for="R_email" class="layui-form-label">邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" id="R_email" name="usermail" required lay-verify="required"
                                       autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="R_username" class="layui-form-label">用户名</label>
                            <div class="layui-input-inline">
                                <input type="text" id="R_username" name="username" required lay-verify="required"
                                       autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">不少于6个字符与数字组成</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="R_pass" class="layui-form-label">密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="R_pass" name="password" required lay-verify="required"
                                       autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">6到16个字符</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="R_repass" class="layui-form-label">确认密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="R_repass" name="confirm_password" required
                                       lay-verify="required" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" lay-filter="login_reg" lay-submit style="background-color: rgb(23,179,241); border-radius: 5px">立即注册</button>
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
    layui.use('form', function () {
        var form = layui.form
            , jq = layui.jquery;

        form.on('submit(login_reg)', function (data) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
            var formdata = {
                'data': JSON.stringify({
                    // 'usernamil': usermail,
                    'usermail': jq('#R_email').val(),
                    'username': jq('#R_username').val(),
                    'password': jq('#R_pass').val(),
                    'confirm_password': jq('#R_repass').val(),
                })
            }

            jq.ajax({
                data: formdata,
                type: 'post',
                async: true,
                dataType: 'json',
                url: getRootPath_web()+"/user/index/reg",
                beforeSend: function () {
                    loading = layer.load(2, {
                        shade: [0.2, '#000']
                    })
                },
                success: function (res) {
                    layer.close(loading);
                    if (res.code == 200) {
                        layer.msg(res.msg, {icon: 1, time: 1000});
                        setTimeout(function () {
                            sendMail(res)
                        }, 1000)

                    } else if (res.code == 500){
                        var  confirm= layer.confirm(res.msg, {
                            btn: ['确定','取消'] //按钮
                        }, function(){
                            sendMail(res);
                        }, function(){
                            layer.close(confirm);
                        });

                    } else {
                        layer.msg(res.msg, {icon: 2, time: 1000});

                    }

                }, error: function (res) {
                    layer.close(loading);
                    layer.msg('未知错误', {icon: 2, time: 1000});
                }


            })
            return false;
        });

    })
</script>
</body>
</html>