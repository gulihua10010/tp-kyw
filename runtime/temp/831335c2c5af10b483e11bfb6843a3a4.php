<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\phpStudy\WWW\kyw/application/admin\view\course_add.html";i:1548679506;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
<style>
    #course-video{
        margin-left: 100px;
    }
    #course-video>div span{
        font-size: 20px;
        color: #191919;
    }
    #course-video .dt span{
        color: #777;
    }
    #course-video .dt i{
        margin: 5px;
    }
    #course-video .dt{
        margin: 10px 30px;
    }
    .duration{
        margin-left: 100px;
    }
</style>
<div class="layui-tab-brief">
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form form-container" id="layui-form"
                  localtion-url="<?php echo url('admin/course/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">课程名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">课程类别</label>
                    <div class="layui-input-block">
                        <?php if($types == null): ?>
                        <a style="color: red">请先添加类别</a>
                        <?php else: ?>
                        <select name="cid" id="cid">
                            <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"<?php if($vo['level'] == 1): ?> disabled<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">需要积分</label>
                    <div class="layui-input-block">
                        <input type="number" name="point" placeholder="请填写整数" autocomplete="off"
                               class="layui-input">
                    </div>
                    <div class="label-tint">不填为系统设置的默认积分值;积分乃是观看此课程的每个视频需要的积分</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">课程视频</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="addvideo"> 管理视频集
                        </button>
                    </div>
                </div>
                <div id="course-video">
                  <!--<dd>-->
                     <!--<span>19考研真题解析与20届复习指导</span>-->
                    <!--<dt> <span><i class="iconfont">&#xe629;</i>1.1 19考研政治真题解析（出题规律、解题思路）</span> <span class="duration">时长</span></dt>-->
                    <!--<dt><span> <i class="iconfont">&#xe629;</i>1.1 19考研政治真题解析（出题规律、解题思路）</span> <span class="duration">时长</span></dt>-->
                  <!--</dd>-->
                    <!--<dd>-->
                        <!--<span><span>19考研真题解析与20届复习指导</span>-->
                    <!--<dt> <span><i class="iconfont">&#xe629;</i>1.1 19考研政治真题解析（出题规律、解题思路）</span><span class="duration">时长</span> </dt>-->
                    <!--</dd>-->


                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">课程图片</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="image">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" name="pic" class="layui-input"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                    <div class="label-tint">默认为视频第一帧图片，也可以自己上传</div>
                </div>
                <div class="layui-form-item" id="pre-image" style="display: none">
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-image" width="300">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" placeholder="关键词请用|隔开" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">讲师</label>
                    <div class="layui-input-block">
                        <input type="text" name="teacher" placeholder="" autocomplete="off"
                               class="layui-input" lay-verify="required">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" id="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">课程介绍</label>
                    <div class="layui-input-block">
                        <textarea id="introduce" name="introduce"></textarea>
                    </div>
                </div>

                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd"
                                    <?php if($types ==  null): ?> disabled <?php endif; ?>>添加</button>
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
<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/jquery-form.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>

<!--页面JS脚本-->


<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element;
        futext('#introduce');
        //刷新界面 所有元素
        form.render();
        $('#addvideo').click(function () {
            var index = layer.open({
                title: ['管理视频集', 'font-size:16px'],
                type: 2,
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮,
                closeBtn: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['820px', '500px'], //宽高
                    content:  "<?php echo url('admin/course/videocollect'); ?>?cid=-1" ,
                success:function(){
                    $('#addvideo').attr('disabled','disabled' )
                },
                end:function(){
                    $('#addvideo').removeAttr('disabled')
                    // location.reload();
                }
            })
        });

        upload.render({
            url: '<?php echo url("upload/upimage"); ?>'
            , elem: '#image'
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
                $("#pre-image").css('display', 'block');
                $('#uploaded-image').attr('src', getRootPath_web() + res.path);
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


        form.on('submit', function (data) {
            var formdata = {
                'data': JSON.stringify({
                    'name': $('input[name=name]').val()
                    , 'point': $('input[name=point]').val()
                    , 'keywords': $('input[name=keywords]').val()
                    , 'pic': $('input[name=pic]').val()
                    , 'teacher': $('input[name=teacher]').val()
                    , 'desc': $('#desd').val()
                    , 'cid': $('#cid').val()
                    , 'introduce': tinyMCE.activeEditor.getContent()
                })
            }
            ajaxform(formdata, " <?php echo url('admin/course/save'); ?> ", $, function () {
                window.location.href = "<?php echo url('admin/course/index'); ?>";
            })
            return false;
        });
    });


</script>

</body>
</html>