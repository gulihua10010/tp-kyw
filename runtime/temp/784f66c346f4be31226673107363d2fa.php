<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"E:\phpStudy\WWW\kyw/application/admin\view\admin_user_edit.html";i:1545907304;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1545906008;}*/ ?>
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
                <form class="layui-form form-container" data-url="<?php echo url('admin/admin_user/update'); ?>"  localtion-url="<?php echo url('admin_user/index'); ?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" value="<?php echo $admin_user['username']; ?>" required  lay-verify="required" placeholder="请输入用户名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-inline">
                            <input type="password" name="password" value="" placeholder="（选填）如不修改则留空" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">重复密码</label>
                        <div class="layui-input-inline">
                            <input type="password" name="confirm_password" value="" placeholder="（选填）如不修改则留空" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="启用" <?php if($admin_user['status']==1): ?> checked="checked"<?php endif; ?>>
                            <input type="radio" name="status" value="0" title="禁用" <?php if($admin_user['status']==0): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $admin_user['id']; ?>">
                    <div class="btable-paged" >
				<div class="layui-main">
                    <div class="formbtngroup">
<button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">更新</button>
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