<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"E:\phpStudy\WWW\kyw/application/admin\view\course_type_edit.html";i:1547192838;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1547195920;}*/ ?>
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
            <form class="layui-form form-container" data-url="<?php echo url('admin/CourseType/update'); ?>"
                  localtion-url="<?php echo url('Course/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">课程类别名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input" value="<?php echo $type['name']; ?>">
                    </div>
                </div>

                <div class="layui-form-item" style="width: 300px;">
                    <label class="layui-form-label">所属父类别</label>
                    <div class="layui-input-block">
                        <select name="pid" id="pid">
                            <option value="0">顶级类别</option>
                            <?php if(is_array($ts) || $ts instanceof \think\Collection || $ts instanceof \think\Paginator): $i = 0; $__LIST__ = $ts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" <?php if(($type['id'] == $vo['id']||$vo['ischild'])==1||$vo['level'] > 1): ?>disabled <?php endif; if($type['pid'] == $vo['id']): ?> selected<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>


                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" placeholder="请输入内容" class="layui-textarea"><?php echo $type['desc']; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $type['id']; ?>">
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">保存</button>
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