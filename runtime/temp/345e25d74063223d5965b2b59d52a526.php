<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"E:\phpStudy\WWW\kyw/application/admin\view\info_edit.html";i:1546523022;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1545906008;}*/ ?>
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
            <form class="layui-form form-container" data-url="<?php echo url('admin/info/update'); ?>"
                  localtion-url="<?php echo url('Article/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">资讯类别名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容" value="<?php echo $info['name']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>



                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" placeholder="请输入内容" class="layui-textarea"><?php echo $info['desc']; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id"   value="<?php echo $info['id']; ?>" >
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">更新</button>
                            <button onclick="history.go(-1);" class="layui-btn layui-btn-primary layui-btn-small">返回
                            </button>
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
    layui.use(['form', 'upload'], function () {
        var form = layui.form
            , jq = layui.jquery;


    });
    layui.use(['element', 'jquery'], function (data) {
        var element = layui.element
            , $ = layui.jquery;//导航的hover效果、二级菜单等功能，需要依赖element模块


    })
</script>

</body>
</html>