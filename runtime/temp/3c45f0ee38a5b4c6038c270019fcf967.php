<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\phpStudy\WWW\kyw/application/admin\view\school_magor.html";i:1548309164;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>后台管理</title>
		<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="/kyw/public/css/main.css"  media="all"  />
	
    
<link rel="stylesheet" href="/kyw/public/css/form.css">
<link rel="stylesheet" href="/kyw/public/css/select2.min.css">

   
    <!--[if lt IE 9]>
    <script src="/kyw/static/css/html5shiv.min.js"></script>
    <script src="/kyw/static/css/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/kyw/public/plugins/layui/layui.js"></script>
</head>
<body>

    <!--主体-->
    <div style="margin-bottom:36px;">
      

<style>
    .mg{
        margin-left: 400px;
    }
</style>
<div class="layui-tab-brief">
    <form method="post">
        <input type="hidden" name="sid"  value="<?php echo $sid; ?>">
        <?php if(($arr == '' || $arr == null)): ?>
        <div class="layui-form-item" style="width: 700px">
            <label class="layui-form-label">学校专业</label>

            <div class="layui-input-inline">
                <select class="singleSelect magors" name="magors-000" style="width: 250px;height: 40px;" >
                    <option value="0"></option>
                    <?php if(is_array($magors) || $magors instanceof \think\Collection || $magors instanceof \think\Paginator): $i = 0; $__LIST__ = $magors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>
                    </option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>

            <div class="mg">
                <input type="text" class="layui-input layui-input-inline yx" placeholder="请输入专业所属院系" required  name="yx-000" >
                <button type="button" class="layui-btn add">添加专业</button>
            </div>

        </div>
        <?php endif; if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?>
        <div class="layui-form-item" style="width: 700px">
            <label class="layui-form-label">学校专业</label>

            <div class="layui-input-inline">
                <select class="singleSelect magors" name="magors-<?php echo $a['id']; ?>" style="width: 250px;height: 40px;" >
                    <?php if(is_array($magors) || $magors instanceof \think\Collection || $magors instanceof \think\Paginator): $i = 0; $__LIST__ = $magors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"  <?php if($a['mid'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?>
                    </option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>

            <div class="mg">
            <input type="text" class="layui-input layui-input-inline yx" placeholder="请输入专业所属院系" required  name="yx-<?php echo $a['id']; ?>"  value="<?php echo $a['colllege']; ?>">
            <button type="button" class="layui-btn add">添加专业</button>
                <button type="button" class="layui-btn del layui-btn-danger" style="position: relative;left: 300px;margin-top: -50px" >删除</button>

            </div>

        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        <button type="button" style="position: fixed; right: 20px;bottom: 20px "
                class="layui-btn layui-btn-small sureadd">确定添加
        </button>
    </form>


</div>



</div>

 

<script>

</script>

<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/select2.min.js"></script>
<script src="/kyw/public/js/common.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element'], function () {
        var form = layui.form
            , $ = layui.jquery
            , element = layui.element
        //刷新界面 所有元素
        form.render();
        $(document).ready(function() {
            $('.singleSelect').select2();

        });

        $('form').on('click','.del',function () {
           $(this).parent().parent().remove();
        })

        $('form').on('click','.add',function () {
            var  id =getRandom();
            var html='    <div class="layui-form-item" style="width: 700px">\n' +
                '            <label class="layui-form-label">学校专业</label>\n' +
                '            <div class="layui-input-inline">\n' +
                '                <select class="singleSelect magors" style="width: 250px;height: 40px;" name="magors-'+id+'">\n' +
                '                    <option value="0"></option>\n' +
                '                    <?php if(is_array($magors) || $magors instanceof \think\Collection || $magors instanceof \think\Paginator): $i = 0; $__LIST__ = $magors;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>\n' +
                '                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?>\n' +
                '                    </option>\n' +
                '                    <?php endforeach; endif; else: echo "" ;endif; ?>\n' +
                '                </select>\n' +
                '            </div>\n' +
                '            <div class="mg">\n' +
                '            <input type="text" class="layui-input layui-input-inline yx" name="yx-'+id+'" placeholder="请输入专业所属院系" required>\n' +
                '            <button type="button" class="layui-btn del layui-btn-danger" >删除</button>\n' +
                '            </div>\n' +
                '\n' +
                '        </div>';
            $('form').append(html);
        })
        $('.sureadd').click(function () {
            var f=true;
            $('.magors').each(function (i) {
                if ($(this).val()=='0'){
                    layer.msg('专业不能为空', {
                        title: '提示'
                        //不自动关闭
                        , time: 1000
                        , icon: 5
                    });
                    $(this).css('border '," red 1px solid");
                     f=false;
                }

            });
            $('.yx').each(function (i) {
                if ($(this).val()==''){
                    layer.msg('院系不能为空', {
                        title: '提示'
                        //不自动关闭
                        , time: 1000
                        , icon: 5
                    });
                    $('.yx').eq(i).css('border '," red 1px solid")
                    f=false;
                }
            })
            if (!f){
                return false;
            }
        // <ul>
        //     <li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>
        //     <li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>
        //     <li> <span>专业:111 &nbsp;  &nbsp;所在院系:222 </span></li>
        //     </ul>
                var formdata=$('form').serialize();
            ajaxform(formdata, " <?php echo url('admin/school/savemargors'); ?> ", $, function (res) {
                var data=res.data;
                var html=' <ul>';
                for(var item in data){
                    html+="<li> <span>专业:"+data[item].mname+"</span>所在院系:"+data[item].colllege+"</span></li>";
                }
                html+=" </ul>";
                //xs-bolck
                parent.$('.xs-bolck').show();
                parent.$('.xs-bolck .layui-input-block').html(html)

                parent.$(".layui-layer-close1").trigger('click');
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);

            })
            return false;

        })

    });

</script>

</body>
</html>