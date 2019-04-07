<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"E:\phpStudy\WWW\kyw/application/admin\view\forumcate_edit.html";i:1545907304;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1545906008;}*/ ?>
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
                <form class="layui-form form-container" data-url="<?php echo url('admin/forumcate/update'); ?>"  localtion-url="<?php echo url('forumcate/index'); ?>">
                 <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-inline">
	  <input type="text" name="sort" placeholder="仅限整数" autocomplete="off" class="layui-input" value="<?php echo $tptc['sort']; ?>">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">板块名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" value="<?php echo $tptc['name']; ?>" required lay-verify="required" placeholder="必填内容" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item" style="width: 300px;">
    <label class="layui-form-label">所属板块</label>
    <div class="layui-input-block">
      <select name="tid">
       <option value="0">顶级板块</option>
        <?php if(is_array($category_level_list) || $category_level_list instanceof \think\Collection || $category_level_list instanceof \think\Paginator): $i = 0; $__LIST__ = $category_level_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <option value="<?php echo $vo['id']; ?>" <?php if($tptc['id'] == $vo['id']): ?>disabled=""<?php endif; if($tptc['tid'] == $vo['id']): ?>selected="selected"<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">所属类型</label>
    <div class="layui-input-block">
      <input type="radio" name="type" value="1" title="帖子" <?php if($tptc['type'] == 1): ?>checked=""<?php endif; ?>>
    
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">板块图片</label>
    <div class="layui-input-block">
        <button type="button" class="layui-btn" id="image">
            <i class="layui-icon">&#xe67c;</i>上传图片
        </button>
	  <input type="text" name="pic" value="<?php echo $tptc['pic']; ?>" class="layui-input" style="position: absolute;left: 111px;top: 0px;width: 500px;">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">关键词</label>
    <div class="layui-input-block">
      <input type="text" name="keywords" value="<?php echo $tptc['keywords']; ?>" placeholder="请输入内容" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <textarea name="description" placeholder="请输入内容" class="layui-textarea"><?php echo $tptc['description']; ?></textarea>
    </div>
  </div>
                  <input type="hidden" name="id" value="<?php echo $tptc['id']; ?>">
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
  var form = layui.form
  ,jq = layui.jquery , upload = layui.upload;
        upload.render({
            url: '<?php echo url("admin/upload/upimage"); ?>'
            , elem: '#image'
            , before: function (input) {
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                jq('input[name=pic]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
            }, error: function () {
                layer.close(index);
                layer.msg('上传出错：1', {
                    title: '提示'
                    //不自动关闭
                    , time: 1000
                    , icon: 5
                    , offset: '400px'
                });
            }
        });


})
</script>

</body>
</html>