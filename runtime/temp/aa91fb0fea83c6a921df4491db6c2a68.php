<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"E:\phpStudy\WWW\kyw/application/index\view\user_login.html";i:1546872798;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1547374844;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1547275694;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1547187444;}*/ ?>
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

    
<script src="/kyw/public//plugins/layui/layui.js"></script>
<script src="/kyw/public//js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div class="header">
    <div class="header-top">
        <div class="content-index clearfix">
            <div class="fl">
                <a href="http://<?php echo $web_url; ?>/admin.php" target="_blank" style="color: white;line-height: 30px">后台登录</a>
            </div>
            <div class="fr header-top-right">
                <a href="javascript:void(0);" onclick="showLogin();">登录</a>
                <a href="javascript:void(0);" onclick="showRegister();">注册</a>
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
                    <span id="commonSearch">课程</span>
                    <ul class="sub-ul" id="commonSearchType">
                        <li><a href="javascript:void(0);" >课程</a></li>
                        <li><a href="javascript:void(0);"  >资料</a></li>
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

<div class="main layui-clear">


  <div class="fly-panel fly-panel-user" pad20>
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title">
        <li class="layui-this">登录</li>
        <li><a href="<?php echo url('index/user/reg'); ?>">注册</a></li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <form method="post">
              <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">用户名</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_username" name="username" required lay-verify="required" placeholder="请输入用户名或者邮箱" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required lay-verify="required|pass" autocomplete="off" class="layui-input">
                </div>
              </div>

              <div class="layui-form-item">
                <button class="layui-btn" lay-filter="login_index" lay-submit style="background-color: rgb(23,179,241); border-radius: 5px">立即登录</button>
                <span style="padding-left:20px;">
                  <a href='<?php echo url("index/user/forget"); ?>'>忘记密码？</a>
                </span>
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


<!--页面JS脚本-->

<script>

layui.use('form',function(){
  var form = layui.form
  ,jq = layui.jquery;

    form.verify({
        emailss: function(value){
            if(value.length > 32){
                return '邮箱必须小于32位';
            }
        }
        ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        ,content: function(value){
            layedit.sync(editIndex);
        }
    });
  form.on('submit(login_index)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    var param = data.field;
    jq.post('<?php echo url("index/user/login"); ?>',param,function(data){

      if(data.code === 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
            var url='<?php echo url("index/user/home",array("id"=>1111)); ?>';
            url=url.replace(/1111/,data.id);
          location.href = url;
        });
      }else{

          layer.close(loading);
          layer.msg(data.msg, {icon: 2, time: 1000}, function(){

              location.href =url;
          });
      }
    });
    return false;
  });

})
</script>
</body>
</html>