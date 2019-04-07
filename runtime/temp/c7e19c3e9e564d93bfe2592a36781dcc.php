<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:65:"E:\phpStudy\WWW\kyw/application/admin\view\magor_subject_add.html";i:1548165924;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/kyw/public/css/formSelects-v4.css"/>
<div class="layui-tab-brief">
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form method="post">

                <div class="layui-form-item">
                    <label class="layui-form-label">学科名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>



                <div class="layui-form-item">
                    <label class="layui-form-label">学科描述</label>
                    <div class="layui-input-block">
                        <textarea id="desc" name="desc" cols="50" rows="10"></textarea>
                    </div>
                </div>

                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">添加</button>
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

<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/jquery-form.js"></script>
<script src="/kyw/public/js/common.js"></script>
<script src="/kyw/public/js/formSelects-v4.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element

        //刷新界面 所有元素
        form.render();
        form.on('submit', function (data) {


                var formdata = {
                    'data': JSON.stringify({
                         'name': $('input[name=name]').val()
                        , 'desc': $('#desc').val()
                    })
                }
                ajaxform(formdata, " <?php echo url('admin/magorSubject/save'); ?> ", $, function () {
                    window.location.href="<?php echo url('admin/magor/index'); ?> ";
                })

            return false;
        });

    });


</script>

</body>
</html>