<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"E:\phpStudy\WWW\kyw/application/admin\view\message_add.html";i:1546769538;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1545906008;}*/ ?>
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
                <form class="layui-form form-container" data-url="<?php echo url('admin/message/save'); ?>"  localtion-url="<?php echo url('message/index'); ?>" >
                    <div class="layui-form-item">
                        <label class="layui-form-label">系统公告</label>
                        <div class="layui-input-block">
                         <textarea name="content" placeholder="请输入系统公告" class="layui-textarea"></textarea>
                       
                        </div>
                    </div>
                 <input type="hidden" name="type" value="1" >
                 
                    <div class="btable-paged" >
				<div class="layui-main">
                    <div class="formbtngroup">
<button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">添加</button>
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

</body>
</html>