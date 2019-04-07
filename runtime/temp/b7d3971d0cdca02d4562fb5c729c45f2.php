<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\phpStudy\WWW\kyw/application/admin\view\article_edit.html";i:1548161478;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
                  localtion-url="<?php echo url('admin/course/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">文章名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="title" required lay-verify="required" placeholder="必填内容" value="<?php echo $art['title']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">文章作者</label>
                    <div class="layui-input-inline">
                        <input type="text" name="author" required lay-verify="required" placeholder="必填内容"  value="<?php echo $art['author']; ?>"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">文章类别</label>
                    <div class="layui-input-block">
                        <select name="infoid" id="infoid">
                            <?php if(is_array($infos) || $infos instanceof \think\Collection || $infos instanceof \think\Paginator): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"<?php if($vo['id'] == $art['infoid']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">文章缩略图</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="pic">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" name="pic" class="layui-input" value="<?php echo $art['pic']; ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item" id="pre-pic"  >
                    <label class="layui-form-label">图片预览</label>
                     <img id="uploaded-pic"  width="300" src="/kyw<?php echo $art['pic']; ?>">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" placeholder="关键词请用|隔开" autocomplete="off" value="<?php echo $art['keywords']; ?>"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" id="desc" placeholder="请输入内容" class="layui-textarea"><?php echo $art['desc']; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">文章内容</label>
                    <div class="layui-input-block">
                        <textarea id="content" name="content"><?php echo $art['content']; ?></textarea>
                    </div>
                </div>
                <!--<input type="hidden" name="id"   value="<?php echo $art['id']; ?>" >-->
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd"  <?php if($infos ==  null): ?> disabled <?php endif; ?>>更新</button>
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
<script src="/kyw/public/js/common.js"></script>
<script src="/kyw/public/js/jquery-form.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>

<!--页面JS脚本-->

<script>

    layui.use(['layer', 'form', 'element', 'upload'], function () {
        futext('#content')
        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element
        //刷新界面 所有元素
        form.render();
        upload.render({
            url: '<?php echo url("upload/upimage"); ?>'
            , elem: '#pic'
            , exts: 'jpg|png|gif'
            , before: function (input) {
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                $('input[name=pic]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
                $("#pre-pic").css('display','block');
                $('#uploaded-pic').attr('src',getRootPath_web()+res.path);
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

        form.on('submit', function(data){
            var formdata = {
                'data': JSON.stringify({
                    'title': $('input[name=title]').val()
                   , 'author': $('input[name=author]').val()
                   , 'keywords': $('input[name=keywords]').val()
                   , 'pic': $('input[name=pic]').val()
                   , 'desc': $('#desc').val()
                    , 'infoid': $('#infoid').val()
                    , 'id': '<?php echo $art['id']; ?>'
                    , 'content': tinyMCE.activeEditor.getContent()
                })
            }
            ajaxform(formdata," <?php echo url('admin/article/update'); ?> ",$,function () {
                window.location.href="<?php echo url('admin/article/index'); ?> ";

            });
            return false;
        });
    });



</script>

</body>
</html>