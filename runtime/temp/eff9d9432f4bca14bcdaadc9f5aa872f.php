<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\phpStudy\WWW\kyw/application/admin\view\resource_add.html";i:1548559406;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
            <form class="layui-form form-container"     id="layui-form"
                  localtion-url="<?php echo url('admin/resource/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">资源名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">资源类别</label>
                    <div class="layui-input-block">
                        <?php if($types ==  null): ?>
                         <a style="color: red">请先添加类别</a>
                        <?php else: ?>
                        <select name="tid" id="tid">
                            <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">需要积分</label>
                    <div class="layui-input-block">
                        <input type="number" name="point"   placeholder="请填写整数" autocomplete="off"
                               class="layui-input">
                    </div>
                    <div class="label-tint">不填为系统设置的默认积分值</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">资料文件</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="data" name="dd">
                            <i class="layui-icon">&#xe67c;</i>上传资料
                        </button>
                        <input type="text" name="data" class="layui-input"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                    <div class="label-tint">上传资料为zip或rar压缩文件、word、pdf文档(压缩文件如果有密码在描述里说明)</div>
                </div>
                <div class="layui-form-item"  id="uploading-data" style="position: relative ;display: none" >
                    <label class="layui-form-label">上传进度</label>
                        <div class="layui-progress" lay-showpercent="true" lay-filter="process"
                             style="  width: 60%;position: absolute;left: 110px;top:16px" >
                            <div class="layui-progress-bar layui-bg-green" lay-percent="0%"></div>
                        </div>


                </div>
               <!--S-->
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" placeholder="关键词请用|隔开" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="des" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd"  <?php if($types ==  null): ?> disabled <?php endif; ?>>添加</button>
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

<script src="/kyw/public/js/common.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element
        //刷新界面 所有元素
        form.render();
        upload.render({
            url: '<?php echo url("admin/upload/upfile"); ?>'
            , elem: '#data'
            ,accept:'file'
            , exts: 'zip|doc|pdf|rar|docx|txt|'
            , progress: function (e, percent) {
                element.progress('process', percent + "%");

            }
            , before: function (input) {
                $('#uploading-data').css('display','block')
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                $('input[name=data]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
                // $('#uploaded-image').attr('src',getRootPath_web()+res.path);
            }, error: function () {
                layer.close(loading);
                layer.msg('上传出错：1', {
                    title: '提示'
                    //不自动关闭
                    , time: 1000
                    , icon: 5
                    , offset: '400px'
                });
            }
        });
//resource resourcw  rescourcw
//resourcw rescourcw
        form.on('submit', function(data){
            var formdata=$('#layui-form').serialize();
            ajaxform(formdata," <?php echo url('admin/resource/save'); ?> ",$,function () {
                window.location.href="<?php echo url('admin/resource/index'); ?>";
            })
            return false;
        });
    });


</script>

</body>
</html>