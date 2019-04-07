<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"E:\phpStudy\WWW\kyw/application/admin\view\nav_edit.html";i:1548850626;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
    <div class="layui-tab layui-tab-brief">

        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" id="layui-form" method="post">
                <div class="layui-form-item">
                        <label class="layui-form-label">导航名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" value="<?php echo $nav['name']; ?>" required  lay-verify="required" placeholder="请输入导航名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">别名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="alias" value="<?php echo $nav['alias']; ?>" placeholder="（选填）请输入导航别名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">父导航</label>
                        <div class="layui-input-inline">
                            <select id="pid" name="pid" style="width: 200px;height: 30px; font-size: 15px;border-radius: 3px;border: 1px #eee solid;text-align: center">
                                <option style="color: black;background-color: whitesmoke;line-height: 20px" value="0" <?php if(0  == $nav['pid']): ?>selected<?php endif; ?>>顶部导航</option>
                                <?php if(is_array($navss) || $navss instanceof \think\Collection || $navss instanceof \think\Paginator): $i = 0; $__LIST__ = $navss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option style="color: black;background-color: whitesmoke;line-height: 20px" value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $nav['pid']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                  <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">链接</label>
                          <div>
                            <div class="layui-input-inline">
                            <input type="text" name="link" value="<?php echo $nav['link']; ?>" placeholder="（选填）请输入导航链接" class="layui-input">
                        </div>
                          </div>
                        <div class="label-tint">带参数的本地连接用半角逗号隔开,如版块id为1，则访问版块输入index/view,id,1</div> 
                    </div>
                     <div class="layui-form-item">
                        <label class="layui-form-label">链接属性</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="sid" value="1" title="内部" <?php if($nav['sid']==1): ?> checked="checked"<?php endif; ?>>
                            <input type="radio" name="sid" value="0" title="外部" <?php if($nav['sid']==0): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">图标</label>
                        <div class="layui-input-inline">
                            <input type="text" name="icon" value="<?php echo $nav['icon']; ?>" placeholder="（选填）如：fa fa-home" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="status" value="1" title="显示" <?php if($nav['status']==1): ?> checked="checked"<?php endif; ?>>
                            <input type="radio" name="status" value="0" title="隐藏" <?php if($nav['status']==0): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">打开方式</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="target" value="_self" title="默认" <?php if($nav['target']=='_self'): ?> checked="checked"<?php endif; ?>>
                            <input type="radio" name="target" value="_blank" title="新窗口" <?php if($nav['target']=='_blank'): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </div> <input type='hidden' name='id' value='<?php echo $nav['id']; ?>'>
                     <input type='hidden' name='type' value='<?php echo $type; ?>'>    <input type='hidden' name='oldpid' value='<?php echo $nav['pid']; ?>'>
                    <div class="btable-paged"  style="position: absolute;left:  430px" >
                        <button  class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">修改</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

 

<script>

</script>

<script src="/kyw/public/js/common.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element'], function () {
        var form = layui.form
            , jq = layui.jquery;
        form.on('submit', function(data){
                var formdata = jq('#layui-form').serialize();
                ajaxform(formdata,"<?php echo url('admin/nav/update'); ?>",jq,function (res) {
                    var indexs = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(indexs);
                });
                return false;
        })

    });
</script>

</body>
</html>