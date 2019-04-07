<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:59:"E:\phpStudy\WWW\kyw/application/user\view\index_forget.html";i:1549106408;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1549092470;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1549177024;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548923454;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>找回密码|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">

    
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <script src="/kyw/public/js/common.js"></script>
    <script type='text/javascript' src='/kyw/public/js/webim.config.js'></script>
    <script type='text/javascript' src='/kyw/public/js/strophe-1.2.8.min.js'></script>
    <script type='text/javascript' src='/kyw/public/js/websdk-1.4.13.js'></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
      <div class="nav-bbs">
          <ul>
              <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <li   >
                  <span><a  href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><i class="iconfont"><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?></a></span>
                  <ul>
                      <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                      <li> <span><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></span></li>
                      <?php endforeach; endif; else: echo "" ;endif; ?>
                  </ul>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
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
            <a data-url="<?php echo url('user/index/logout'); ?>"   location-url="javascript:location.reload()"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
                <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
        </div>
        <?php else: ?>
        <!-- 未登入状态 -->
        <div class="lg-reg">
            <a class="unlogin"  onclick="showLogin();" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
            <span  class="unlogin-btn" style="cursor: pointer">
          <a onclick="showLogin();" style="color:#fff;">登录</a><a onclick="showReg();"  style="color:#fff;">注册</a></span></div>
        <?php endif; ?>

    </div>
  </div>
</div>


<div class="main layui-clear  ">

<script src="/kyw/public//js/gt.js" type="text/javascript"></script>

  <div class="fly-panel fly-panel-user" pad20>
    <div class="layui-tab layui-tab-brief" lay-filter="user">
      <ul class="layui-tab-title">
        <li class="layui-this">找回密码</li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <form method="post" id="formdata">
              <div class="layui-form-item">
                <label for="L_user" class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_user" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="usermail" required lay-verify="required|emails" autocomplete="off" class="layui-input">
                </div>
              </div>
              <?php if($fpyzm==1): ?>
              <div class="layui-form-item "  >
                <div id="fp-captcha" ></div>
                <p id="wait" class="show">正在加载验证码......</p>
                <p id="notice" class="hide">请先完成验证</p>
              </div>
              <?php endif; ?>
              <div class="layui-form-item">
                <button class="layui-btn" alert="1" data-id="<?php echo $fpyzm; ?>" id="fp-btn" >提交</button>
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
layui.use('form',function(){
  var form = layui.form
  ,jq = layui.jquery;

  form.verify({
  emails: function(value){
	  var res = !!value.match(/^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i);
      if(!res){
        return '邮箱格式不正确';
      }
    }
 
  });
    // 125457957
    // var regmail=/^[a-z0-9A-Z]+([-_.a-z0-9A-Z])*@([a-z0-9A-Z]+[-.])+.[a-zA-Z]{2,4}$/i;
    // if (!regmail.test(jq(usermail).val())){
    //     $jq('#R_email').css('border','1px red solid');
    //     layer.msg('邮箱格式不正确', {
    //         title: '提示'
    //         //不自动关闭
    //         , time: 1000
    //         , icon: 5
    //         ,offset: ['100px', '50px']
    //     });
    // }
    var handlerEmbed = function (captchaObj) {
        var f=1;
        jq('#fp-btn').click(function (e) {
            var id=jq(this).data('id');
            if (id==1){
                var validate = captchaObj.getValidate();

                if (!validate) {
                    jq("#notice")[0].className = "show";
                    setTimeout(function () {
                        jq("#notice")[0].className = "hide";
                    }, 2000);
                    e.preventDefault();
                }else{
                    jq.ajax({
                        url:"<?php echo Url('admin/geetest/geetest_check'); ?>",
                        type:'post',
                        dataType:'json',
                        data:{
                            geetest_challenge: validate.geetest_challenge,
                            geetest_validate: validate.geetest_validate,
                            geetest_seccode: validate.geetest_seccode,
                        },
                        success:function (data) {
                            // console.log(data)
                            // loading = layer.llioad(2, {
                            //     shade: [0.2,'#000']
                            // });
                            loading = layer.load(2, {
                                shade: [0.2,'#000']
                            });
                            var param =jq('#formdata').serialize();

                            jq.post('<?php echo url("user/index/forget"); ?>',param,function(data){
                                if(data.code == 200){
                                   if (data.ise==1){

                                       layer.close(loading);
                                       layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                                       });
                                   } else{
                                       location.href="<?php echo url("user/index/reset_noemail"); ?>?userid="+data.id
                                   }
                                }else{
                                    layer.close(loading);
                                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                                    // jq('#captcha').attr('src',"<?php echo url('login/captcha'); ?>?"+Math.random());
                                }
                            });
                            return false;
                        }
                    })
                }
            }else{
                loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
            var param =jq('#formdata').serialize();

                jq.post('<?php echo url("user/index/forget"); ?>',param,function(data){
                    if(data.code == 200){
                        if (data.ise==1){

                            layer.close(loading);
                            layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                            });
                        } else{
                            location.href="<?php echo url("user/index/reset_noemail"); ?>?userid="+data.id
                        }
                    }else{
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                        // jq('#captcha').attr('src',"<?php echo url('login/captcha'); ?>?"+Math.random());
                    }
                });
            }
            return false;
        });
        if (jq('#fp-btn').data('id')==1){

            // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
            captchaObj.appendTo("#fp-captcha");
            captchaObj.onReady(function () {
                jq("#wait")[0].className = "hide";
            });
            // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
        }
    };
    var url="<?php echo Url('admin/geetest/geetest_show_verify'); ?>?d="+(new Date()).getTime();


    jq.ajax({
        // 获取id，challenge，success（是否启用failback）

        url:url, // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success ,// 表示用户后台检测极验服务器是否宕机，一般不需要关注
                width:'300px',
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        },

    });
})
</script>
<script>
    layui.config({
        base: '/kyw/public//js/'
    }).extend({
        socket: 'socket',
    });
    layui.use(['layim', 'jquery', 'socket'], function (layim, socket) {


    })
</script>
</body>
</html>