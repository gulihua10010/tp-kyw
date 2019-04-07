<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"E:\phpStudy\WWW\kyw/application/admin\view\user_add.html";i:1548926410;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>后台管理</title>
		<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="/kyw/public/css/main.css"  media="all"  />
	
    
   
    <!--[if lt IE 9]>
    <script src="/kyw/static/css/html5shiv.min.js"></script>
    <script src="/kyw/static/css/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/kyw/public/plugins/layui/layui.js"></script>
</head>
<body>

    <!--主体-->
    <div style="margin-bottom:36px;">
      


    <!--tab标签-->
    <div class="layui-tab-brief">
 
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container"  data-url="<?php echo url('admin/user/save'); ?>"  localtion-url="<?php echo url('user/index'); ?>" >
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" value="" required lay-verify="required" placeholder="请输入用户名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-inline">
                            <input type="password" name="password" value="" required lay-verify="required" placeholder="请输入密码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">重复密码</label>
                        <div class="layui-input-inline">
                            <input type="password" name="confirm_password" value="" required lay-verify="required" placeholder="请再次输入密码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机</label>
                        <div class="layui-input-inline">
                            <input type="text" name="mobile" value="" placeholder="（选填）请输入手机" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱</label>
                        <div class="layui-input-inline">
                            <input type="text" name="usermail" value="" required lay-verify="required"  placeholder="请输入邮箱" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="启用" checked="checked">
                            <input type="radio" name="status" value="0" title="禁用">
                            <input type="radio" name="status" value="2" title="禁言">
                        </div>
                    </div>
                    <div class="btable-paged" >
				<div class="layui-main">
                    <div class="formbtngroup">
<button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">添加</button>
<button onclick="history.go(-1);" class="layui-btn layui-btn-primary layui-btn-small">返回</button>
</div>
</div>
        </div>
                    
                </form>
            </div>
        </div>
    </div>


</div>

 

<script>

</script>

<script type="text/javascript" src="/kyw/public/js/formadd.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element'], function () {
        var form = layui.form;

        //刷新界面 所有元素

        form.render();
    });
</script>

</body>
</html>