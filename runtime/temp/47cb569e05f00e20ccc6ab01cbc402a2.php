<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\phpStudy\WWW\kyw/application/admin\view\school_add.html";i:1548924816;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
    ul,li{
        list-style: none;
    }
</style>
<link rel="stylesheet" type="text/css" href="/kyw/public/css/formSelects-v4.css"/>
<div class="layui-tab-brief">
    <div class="layui-tab-content">
        <div class="layui-tab-item layui-show">
            <form class="layui-form form-container" id="layui-form"
                  localtion-url="<?php echo url('admin/school/index'); ?>">

                <div class="layui-form-item">
                    <label class="layui-form-label">学校名称</label>
                    <div class="layui-input-inline">
                        <input type="text" name="name" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>


                <div class="layui-form-item" style="width: 500px">
                    <label class="layui-form-label">学校省份</label>
                    <div class="layui-input-block">
                        <select id="proid">
                            <option value="" ></option>
                            <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item" style="width: 500px">
                    <label class="layui-form-label">学校类型</label>
                    <div class="layui-input-block">
                        <select name="type" id="type" xm-select="sel-type">
                            <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item" style="width: 500px">
                    <label class="layui-form-label">学校属性</label>
                    <div class="layui-input-block">
                        <select name="prop" id="prop" xm-select="sel-prop">
                            <?php if(is_array($prop) || $prop instanceof \think\Collection || $prop instanceof \think\Paginator): $i = 0; $__LIST__ = $prop;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item" style="width: 500px">
                    <label class="layui-form-label">学校隶属</label>
                    <div class="layui-input-block">
                        <select name="belong" id="belong" xm-select="sel-belong">
                            <?php if(is_array($belong) || $belong instanceof \think\Collection || $belong instanceof \think\Paginator): $i = 0; $__LIST__ = $belong;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>
                            </option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">院校代码</label>
                    <div class="layui-input-block">
                        <input type="text" name="code" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">学校邮箱</label>
                    <div class="layui-input-block">
                       <input type="text" name="email" required lay-verify="required" placeholder="必填内容"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">学校地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="address" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">学校电话</label>
                    <div class="layui-input-block">
                        <input type="text" name="tel" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">学校网址</label>
                    <div class="layui-input-block">
                        <input type="text" name="website" required lay-verify="required" placeholder="必填内容"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">学校图片</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="pic">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" name="pic" class="layui-input"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item" id="pre-pic" style="display: none">
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-pic" width="700px"  >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">校徽</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="badge">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" name="badge" class="layui-input"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item" id="pre-badge" style="display: none">
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-badge"  width="150px"   >
                </div>

                <div class="layui-form-item xs-bolck">
                    <label class="layui-form-label">学校专业</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="glzy"> 管理专业
                        </button>
                    </div>
                </div>
                <div class="layui-form-item xs-bolck" style="display: none">
                    <label class="layui-form-label">学校专业数据</label>
                    <div class="layui-input-block">
                        <!--<ul>-->
                            <!--<li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>-->
                            <!--<li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>-->
                            <!--<li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>-->
                        <!--</ul>-->
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">学校介绍</label>
                    <div class="layui-input-block">
                        <textarea id="info" name="info"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">招生简章</label>
                    <div class="layui-input-block">
                        <textarea id="rule" name="rule"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">分数线</label>
                    <div class="layui-input-block">
                        <textarea id="grade" name="grade"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">复试信息</label>
                    <div class="layui-input-block">
                        <textarea id="fushi" name="fushi"></textarea>
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
<script src="/kyw/public/js/common.js"></script>
<script src="/kyw/public/js/jquery-form.js"></script>
<script src="/kyw/public/js/formSelects-v4.js"></script>
<script type="text/javascript" src="/kyw/public/plugins/tinymce/tinymce.min.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {
        var formSelects = layui.formSelects;

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element
        futext('#info');
        futext('#rule');
        futext('#grade');
        futext('#fushi');

        //刷新界面 所有元素
        form.render();
        $('#glzy').click(function () {
            var index = layer.open({
                title: ['管理专业', 'font-size:16px'],
                type: 2,
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮,
                closeBtn: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['820px', '500px'], //宽高
                content:  "<?php echo url('admin/school/magor'); ?>?sid=-1" ,
                success:function(){
                    $('#glzy').attr('disabled','disabled' )
                },
                end:function(){
                    $('#glzy').removeAttr('disabled')
                    // location.reload();
                }
            })
        })
        form.on('submit', function (data) {
                var activeEditor0 = tinymce.editors[0];;
            var editBody0 = activeEditor0.getBody();
            activeEditor0.selection.select(editBody0);
            var text0 = activeEditor0.selection.getContent({'format': 'text'});

            var activeEditor1 = tinymce.editors[1];;
            var editBody1 = activeEditor1.getBody();
            activeEditor1.selection.select(editBody1);
            var text1 = activeEditor1.selection.getContent({'format': 'text'});

            var activeEditor2 = tinymce.editors[2];;
            var editBody2 = activeEditor2.getBody();
            activeEditor2.selection.select(editBody2);
            var text2 = activeEditor2.selection.getContent({'format': 'text'});

            var activeEditor3 = tinymce.editors[3];;
            var editBody3= activeEditor3.getBody();
            activeEditor3.selection.select(editBody3);
            var text3= activeEditor3.selection.getContent({'format': 'text'});


            // console.log(text0);
            // console.log(text1);
            // console.log(text2);
            // console.log(text3);
            var prop = formSelects.value('sel-prop', 'name');
            var type = formSelects.value('sel-type', 'name');
            var belong = formSelects.value('sel-belong', 'name');

            if (text0.trim() == '' ||text1.trim() == ''||text2.trim() == ''||text3.trim() == '' ||prop.length == 0 || type.length == 0 || belong.length == 0) {
                layer.msg('请输入必填项！', {icon: 2, time: 1000});
            } else {
                var formdata = {
                    'data': JSON.stringify({
                        'name': $('input[name=name]').val()
                        , 'prop': prop.join(',')
                        , 'type': type.join(',')
                        , 'belong': belong.join(',')
                        , 'proid': $('#proid').val()
                        , 'pic': $('input[name=pic]').val()
                        , 'badge': $('input[name=badge]').val()
                        , 'code': $('input[name=code]').val()
                        , 'website': $('input[name=website]').val()
                        , 'tel': $('input[name=tel]').val()
                        , 'address': $('input[name=address]').val()
                        , 'email': $('input[name=email]').val()
                        , 'info': tinyMCE.editors[0].getContent()
                        , 'rule': tinyMCE.editors[1].getContent()
                        , 'grade': tinyMCE.editors[2].getContent()
                        , 'fushi': tinyMCE.editors[3].getContent()
                    })
                }
                // console.log($('#proid').val());
                ajaxform(formdata, " <?php echo url('admin/school/save'); ?> ", $, function () {
                    window.location.href="<?php echo url('admin/school/index'); ?> ";

                })


            }
            return false;
        });


        upload.render({
            url: '<?php echo url("upload/upimage"); ?>'
            , elem: '#badge'
            , ext: 'jpg|png|gif'
            , before: function (input) {
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                $('input[name=badge]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
                $("#pre-badge").css('display','block');
                $('#uploaded-badge').attr('src',getRootPath_web()+res.path);
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
        upload.render({
            url: '<?php echo url("upload/upimage"); ?>'
            , elem: '#pic'
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
                $("#pre-pic").css('display','block');
                $('#uploaded-pic').attr('src',getRootPath_web()+res.path);
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

    });


</script>

</body>
</html>