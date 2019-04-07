<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\phpStudy\WWW\kyw/application/admin\view\magor_edit.html";i:1548300292;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
            <form class="layui-form form-container" id="layui-form"
                  localtion-url="<?php echo url('admin/magor/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">专业名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容" value="<?php echo $magor['name']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item" style="width: 300px;">
                    <label class="layui-form-label">所属学科</label>
                    <div class="layui-input-block">
                        <select name="sub" id="sub">
                            <option value="" ></option>
                            <?php if(is_array($subs) || $subs instanceof \think\Collection || $subs instanceof \think\Paginator): $i = 0; $__LIST__ = $subs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $magor['subject']): ?>selected <?php endif; ?>><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item" style="width: 300px;">
                    <label class="layui-form-label">专业类型</label>
                    <div class="layui-input-block">
                        <select name="type" id="type">
                            <option value="" ></option>
                            <option value="2"  <?php if($magor['type'] == 2): ?>selected <?php endif; ?>>专业硕士
                            <option value="1"  <?php if($magor['type'] == 1): ?>selected <?php endif; ?>>学术硕士
                        </select>
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px;">
                    <label class="layui-form-label">所属父专业</label>
                    <div class="layui-input-block">
                        <select name="pid" id="pid">
                            <option value="0">顶级专业</option>
                            <?php if(is_array($pm) || $pm instanceof \think\Collection || $pm instanceof \think\Paginator): $i = 0; $__LIST__ = $pm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" <?php if(($magor['id'] == $vo['id'])): ?>disabled <?php endif; if($vo['id'] == $magor['pid']): ?>selected <?php endif; ?>><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">专业代码</label>
                    <div class="layui-input-block">
                        <input type="text" name="code" required lay-verify="required" placeholder="必填内容" value="<?php echo $magor['code']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">专业介绍</label>
                    <div class="layui-input-block">
                        <textarea id="info" name="info"><?php echo $magor['info']; ?></textarea>
                    </div>
                </div>

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

<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/jquery-form.js"></script>
<script src="/kyw/public/js/common.js"></script>
<script src="/kyw/public/js/formSelects-v4.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>

<!--页面JS脚本-->

<script>


    layui.use(['layer', 'form', 'element', 'upload'], function () {
        futext('#info');

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element

        //刷新界面 所有元素
        form.render();
        form.on('submit', function (data) {
                var activeEditor = tinymce.activeEditor;
            var editBody = activeEditor.getBody();
            activeEditor.selection.select(editBody);
            var text = activeEditor.selection.getContent({'format': 'text'});
            // console.log(text);

            if (text.trim() == ''  ){
                layer.msg('请输入必填项！', {icon: 2, time: 1000});
            } else {
                var formdata = {
                    'data': JSON.stringify({
                         'name': $('input[name=name]').val()
                         ,'code': $('input[name=code]').val()
                        , 'pid': $('#pid').val()
                        , 'subject': $('#sub').val()
                        , 'id': '<?php echo $magor['id']; ?>'
                        , 'type': $('#type').val()
                        , 'info': tinyMCE.activeEditor.getContent()
                    })
                }
                console.log($('#proid').val())
                ajaxform(formdata, " <?php echo url('admin/magor/update'); ?> ", $, function () {
                    window.location.href="<?php echo url('admin/magor/index'); ?> ";

                })


            }
            return false;
        });

    });


</script>

</body>
</html>