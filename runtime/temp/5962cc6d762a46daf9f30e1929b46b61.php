<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\phpStudy\WWW\kyw/application/admin\view\forum_edit.html";i:1546780912;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
            <form >
                <div class="layui-form-item" style="width: 300px;">
                    <label class="layui-form-label">所在板块</label>
                    <div class="layui-input-block">
                        <select name="tid" id="tid">
                            <?php if(is_array($tptcs) || $tptcs instanceof \think\Collection || $tptcs instanceof \think\Paginator): $i = 0; $__LIST__ = $tptcs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option {if condition="$slide_category['tid'] eq $vo['id']" }selected="selected" {
                            /if} value="<?php echo $vo['id']; ?>"><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?><?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="<?php echo $slide_category['title']; ?>" required
                               lay-verify="required|titlea|titleb"
                               placeholder="必填内容" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">内容</label>
                    <div class="layui-input-block">
      <textarea id="textarea" name="content" style="height:300px;width: 100%;">
      <?php echo $slide_category['content']; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $slide_category['id']; ?>">
                <div class="btable-paged">
                    <div class="layui-main">
                        <div class="formbtngroup">
                            <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="forumadd">更新</button>
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
<script type="text/javascript" src="/kyw/public/js/formadd.js"></script>
<script src="/kyw/public/js/common.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

    layui.use('form', function () {
        var form = layui.form
            , $ = layui.jquery;
        form.verify({
            titlea: function (value) {
                if (value.length < 5) {
                    return '标题必须大于5位';
                }
            }
            , titleb: function (value) {
                if (value.length > 32) {
                    return '标题必须小于32位';
                }
            }
        });
        form.on('submit(forumadd)', function () {
            var formdata = {
                'data': JSON.stringify({
                    'title': $('input[name=title]').val()
                    , 'tid': $('#tid').val()
                    , 'id': $('input[name=id]').val()
                    , 'content': tinyMCE.activeEditor.getContent()
                })
            }
            ajaxform(formdata, " <?php echo url('admin/forum/update'); ?>", $, function () {
                location.href="<?php echo url('admin/forum/index'); ?>"
            })
            return false;
        });
    });

    tinymce.init({
        selector: "#textarea",
        max_height: 550,
        height: 550,
        convert_urls: false,
        branding: false,
        plugins: [
            "advlist  autolink   link image lists charmap print preview hr anchor pagebreak spellchecker   bbcode",
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
        content_css: "__PUBLIC__/css/tinymce.css",
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
                url: '<?php echo url("admin/Upload/upblob"); ?>',
                crossDomain: true,
                data: formData,
                dataType: 'json',
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (res) {
                    success(getRootPath_web() + res.path);
                }
            });
        }
    });


</script>

<!--页面JS脚本-->

</body>
</html>