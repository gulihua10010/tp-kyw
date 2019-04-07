<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"E:\phpStudy\WWW\kyw/application/admin\view\course_edit.html";i:1548679582;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
            <form class="layui-form form-container"     id="layui-form"
                  localtion-url="<?php echo url('admin/course/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">课程名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input" value="<?php echo $course['name']; ?>">
                    </div>
                </div>


                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">课程类别</label>
                    <div class="layui-input-block">
                        <select name="cid" id="cid">
                            <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" <?php if($vo['level'] == 1): ?> disabled<?php endif; if($course['cid'] == $vo['id']): ?> selected<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item" style="width: 300px">
                    <label class="layui-form-label">需要积分</label>
                    <div class="layui-input-block">
                        <input type="number" name="point"   placeholder="请填写整数" autocomplete="off"
                               class="layui-input" value="<?php echo $course['point']; ?>">
                    </div>
                    <div class="label-tint">不填为系统设置的默认积分值；积分乃是观看此课程的每个视频需要的积分</div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">课程视频</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="addvideo"> 管理视频集
                        </button>
                    </div>
                </div>
                <div id="course-video">
                    <?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div>
                    <span><?php echo $vo['name']; ?></span>
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <div class="dt"> <span><i class="iconfont">&#xe62a;</i><?php echo $v['name']; ?></span> <span class="duration"><?php echo $v['duration']; ?></span></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                   <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">课程图片</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="image">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" name="pic" class="layui-input"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required" value="<?php echo $course['pic']; ?>">
                    </div>
                    <div class="label-tint">默认为视频第一帧图片，也可以自己上传</div>
                </div>
                <div class="layui-form-item" id="pre-image"  >
                    <label class="layui-form-label">图片预览</label>
                     <img id="uploaded-image"  width="300" src="/kyw<?php echo $course['pic']; ?>" >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="keywords" placeholder="关键词请用|隔开" autocomplete="off"
                               class="layui-input" value="<?php echo $course['keywords']; ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">讲师</label>
                    <div class="layui-input-block">
                        <input type="text" name="teacher" placeholder="" autocomplete="off"
                               class="layui-input" lay-verify="required" value="<?php echo $course['teacher']; ?>">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea name="desc" id="desc" placeholder="请输入内容" class="layui-textarea"><?php echo $course['desc']; ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">课程介绍</label>
                    <div class="layui-input-block">
                        <textarea id="content" name="content"><?php echo $course['introduce']; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd"  <?php if($types ==  null): ?> disabled <?php endif; ?>>更新</button>
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
            , element = layui.element
        //刷新界面 所有元素
        form.render();
        $('#course-video>div').each(function (i) {
            $(this).children('span').before('<span>'+(i+1)+':</span>');
            $(this).find('.dt').each(function (j) {
                $(this).children('span:first-child').before('<span>'+(i+1)+'.'+(i+1)+':</span>');

            })

        })
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
                content:  "<?php echo url('admin/course/videocollect'); ?>?cid=<?php echo $course['id']; ?>" ,
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
            , ext: 'jpg|png|gif'
            , before: function (input) {
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                $('input[name=pic]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
                $("#pre-image").css('display','block');
                $('#uploaded-image').attr('src',getRootPath_web()+res.path);
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
            // var formdata = {
            //     'data': JSON.stringify({
            //         'title': $('input[name=title]').val()
            //         , 'author': $('input[name=author]').val()
            //         , 'keywords': $('input[name=keywords]').val()
            //         , 'pic': $('input[name=pic]').val()
            //         , 'desc': $('#desc').val()
            //         , 'infoid': $('#infoid').val()
            //         , 'content': tinyMCE.activeEditor.getContent()
            //     })
            // }
            var formdata = {
                'data': JSON.stringify({
                    'name': $('input[name=name]').val()
                    , 'point': $('input[name=point]').val()
                    , 'keywords': $('input[name=keywords]').val()
                    , 'pic': $('input[name=pic]').val()
                    , 'teacher': $('input[name=teacher]').val()
                    , 'id': $('input[name=id]').val()
                    , 'desc': $('#desd').val()
                    , 'cid': $('#cid').val()
                    , 'introduce': tinyMCE.activeEditor.getContent()
                })
            }
            ajaxform(formdata," <?php echo url('admin/course/update'); ?> ",$,function () {
               window.location.href='<?php echo url('admin/course/index'); ?> ';
            } );
            return false;
        });
    });

    tinymce.init({
        selector: "#content",
        max_height: 550,
        height: 550,
        convert_urls: false,
        branding: false,
        plugins: [
            "advlist  autolink   link image lists charmap print preview hr anchor pagebreak spellchecker   ",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage  powerpaste toc   uploadvideo importcss textcolor colorpicker uploadimage"

        ],
        toolbar1: "undo redo | cut copy paste | bold italic underline strikethrough |" +
        " alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: " searchreplace | bullist numlist | outdent indent blockquote | link unlink anchor uploadimage uploadvideo code |" +
        " inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl |" +
        " spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft  |   code  toc  powerpaste",
        menubar: true,
        toolbar_items_size: 'small',
        code_dialog_height: 200,
        code_dialog_width: 300,
        font_formats: "宋体=宋体;微软雅黑=微软雅黑;新宋体=新宋体;微软雅黑='微软雅黑';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';" +
        "Arial='Arial';Times New Roman='Times New Roman'",
        automatic_uploads: true,
        uploadimage_url: "<?php echo Url('admin/Upload/upimage'); ?>",
        uploadvideo_url: "<?php echo Url('admin/Upload/upvideo'); ?>",
        content_css: "/kyw/public/css/tinymce.css",
        textcolor_map: [
            "000000", "Black", "993300", "Burnt orange", "333300", "Dark olive", "003300", "Dark green", "003366", "Dark azure", "000080", "Navy Blue",
            "333399", "Indigo", "333333", "Very dark gray", "800000", "Maroon", "FF6600", "Orange", "808000", "Olive", "008000",
            "Green", "008080", "Teal", "0000FF", "Blue", "666699", "Grayish blue", "808080", "Gray", "FF0000", "Red", "FF9900",
            "Amber", "99CC00", "Yellow green", "339966", "Sea green", "33CCCC", "Turquoise", "3366FF", "Royal blue", "800080",
            "Purple", "999999", "Medium gray", "FF00FF", "Magenta", "FFCC00", "Gold", "FFFF00", "Yellow", "00FF00", "Lime",
            "00FFFF", "Aqua", "00CCFF", "Sky blue", "993366", "Red violet", "FFFFFF", "White", "FF99CC", "Pink", "FFCC99", "Peach",
            "FFFF99", "Light yellow", "CCFFCC", "Pale green", "CCFFFF", "Pale cyan", "99CCFF", "Light sky blue", "CC99FF", "Plum"
        ],
        language: 'zh_CN',
        powerpaste_word_import: 'propmt',// 参数可以是propmt, merge, clear，效果自行切换对比
        powerpaste_html_import: 'propmt',// propmt, merge, clear
        powerpaste_allow_local_images: true,
        paste_data_images: true,
        paste_preprocess: function (plugin, args) {
            function load(src) {
                loadImageToBlob(src, function (blobFile) {
                    var x = new XMLHttpRequest();
                    x.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            data = this.responseText;
                            // console.log('response data: ' + data);
                        }
                    };
                    x.open('POST', '<?php echo Url("admin/Upload/upimage"); ?>');
                    x.send(blobFile);
                });
            }
        },
        images_upload_handler: function (blobInfo, success, failure) {
            var blob = blobInfo.blob();
            var formData = new FormData();
            formData.append('file', blob);
            $.ajax({
                url:  '<?php echo url("admin/Upload/upblob"); ?>',
                crossDomain: true,
                data: formData,
                dataType: 'json',
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (res) {
                    success(getRootPath_web()+res.path);
                }
            });
        }

    });


</script>

</body>
</html>