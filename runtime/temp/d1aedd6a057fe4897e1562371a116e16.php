<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"E:\phpStudy\WWW\kyw/application/admin\view\nav_index.html";i:1547022612;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      

<style>
    .menu>p{margin:10px 0;font-size:25px}
    .menu{width:100%}
    .menu>ul{font-size:0}
     .menu>ul li{width:110px;border:1px solid rgba(0,0,0,.1);text-align:center;font-size:1pc;line-height:45px;cursor:pointer ;overflow: hidden;position: relative;}
     .menu>ul>li{float:left;display:inline-block;background-color:hsla(0,0%,92%,.7);overflow: hidden;position: relative;}
    .menu>ul>li>ul{position:relative;right:2px;display:block;width:45px;padding:0;margin:0}
    .menu>ul>li>ul>li{background-color:hsla(0,0%,97%,.5);list-style:none}
    .menu ul >li>ul>li>div>span{display:inline-block;width:110px;height:45px;text-align:center;position: absolute;top:0;left: 0 }
    .menu ul >li>div>span{display:block;width:110px;height:45px; position: relative; top:0;  }
    .menu ul>li>div{width:110px;height:45px}
    .menu ul>li#addmenubtn:hover{background-color:#eee}
    .menu ul>li>ul>li.addtypebtn:hover{background-color:#f7f7f7}
    input.addinput{margin:30px 9pt;width:280px;height:35px}
    button.addbtn{position:absolute;right:75pt;bottom:10px;background-color:#009688}
    button.addbtncal{position:absolute;right:30px;bottom:10px}
    ul li button{z-index:11;margin:5px auto}
    .editleve2{top:-40pt;overflow:hidden;width:75pt}
    .editleve1,.editleve2{position:absolute;left:0;z-index:1;height:35pt;background-color:rgba(0,0,0,.5)}
    .editleve1{top:-100pt;width:85pt}
    .menu>ul>li>.leve1:hover .editleve1,.menu>ul>li>ul>li:hover .editleve2{top:0;z-index:1;-webkit-transition:all .5s ease;transition:all .5s ease}
    .my-skin .layui-layer-btn .layui-layer-btn0{border:1px solid red;background-color:red;color:#fff}
</style>
<link rel="stylesheet" type="text/css" href="/kyw/public/js/jquery-ui/jquery-ui.css">
<script type="text/javascript" src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/kyw/public/js/jquery-ui/jquery-ui.min.js"></script>
<div class="admin-main">
    <!--tab标签-->
    <div class="layui-field-box layui-form">
        <div class="menu">
            <div class="layui-form-item">
                <label class="layui-form-label">模式选择</label>
                <div class="layui-input-block">
                    <input type="radio" name="mode" class="modes" value="1"  lay-filter="modes" title="拖动模式" checked >
                    <input type="radio" name="mode" value="2" class="modes"   lay-filter="modes" title="编辑模式" >
                    <input type="radio" name="mode" value="3" class="modes"   lay-filter="modes" title="删除模式">
                </div>
                <div class="label-tint">拖动模式下按住元素拖动即可改变次序</div>
            </div>

            <ul class="sortable">
                <?php if(is_array($nav_list) || $nav_list instanceof \think\Collection || $nav_list instanceof \think\Paginator): if( count($nav_list)==0 ) : echo "" ;else: foreach($nav_list as $key=>$nav_list): ?>
                <li class="sorts">
                    <div  class="leve1">
                        <div class="editleve1 edit"  style="display:none; ">
                            <button class="layui-btn layui-btn-small edits" data-id="0" >编辑</button>
                            <button class="layui-btn layui-btn-small dels" style="background-color: red" >删除</button>
                            <span class="navVal navid0" style="display: none"><?php echo $nav_list['id']; ?></span>
                        </div>
                        <span><?php echo $nav_list['name']; ?></span>
                    </div>
                    <ul class="sortable1">
                        <?php if(is_array($nav_list['child']) || $nav_list['child'] instanceof \think\Collection || $nav_list['child'] instanceof \think\Paginator): if( count($nav_list['child'])==0 ) : echo "" ;else: foreach($nav_list['child'] as $key=>$submenu): ?>
                        <li class="sorts1">
                            <div class="editleve2 edit" style="display: none">
                                <button class="layui-btn layui-btn-small edits"  data-id="<?php echo $nav_list['id']; ?>" >编辑</button>
                                <button class="layui-btn layui-btn-small dels" style="background-color: red" >删除</button>
                                <span class="navVal navid2" style="display: none"><?php echo $submenu['id']; ?></span>
                                <span class="  navid1" style="display: none"><?php echo $nav_list['id']; ?></span>
                            </div>
                            <div>
                                <span><?php echo $submenu['name']; ?></span>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <li class="addbtn" data-id="<?php echo $nav_list['id']; ?>"><span style="display: none" class="typeid">1</span> <i class="layui-icon">&#xe608;</i></li>

                    </ul>

                </li>
                <?php endforeach; endif; else: echo "" ;endif; if($nav_count <= 9): ?>
                <li class="addbtn" data-id="0"><span style="display: none" class="typeid">1</span> <i class="layui-icon">&#xe608;</i></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>


</div>

 
<div class="btable-paged">
    <div class="layui-main">

    </div>
</div>


<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>
<script src="/kyw/public/js/common.js"></script>


<!--页面JS脚本-->

<script>
    layui.use(['form'], function () {
        var form = layui.form
            , jq = layui.jquery;
        sort();
        form.on('radio(modes)', function(data){
            if (jq(this).val()==2) {
                $('.sortable').sortable('disable');
                $('.sortable1').sortable('disable');
                jq('.edit').css('display','block');
                jq('.dels').css('display','none');
                jq('.edits').css('display','block');
                // menuEdit();
            }else if(jq(this).val()==3){
                $('.sortable').sortable('disable')
                $('.sortable1').sortable('disable')
                jq('.edit').css('display','block');
                jq('.edits').css('display','none');
                jq('.dels').css('display','block');
                jq('.dels').css('margin','5px 22px');
            }else{
                jq('.edit').css('display','none');
                jq('.edits').css('display','none');
                jq('.dels').css('display','none');
                $('.sortable').sortable('enable')
                $('.sortable1').sortable('enable')

            }

        });
    function sort(){
        jq('.sortable').sortable({
            cursor: 'move',
            items: '.sorts',
            update: function (event, ui) {
                var index=new Array();
                for (var i = 0; i < $('.sorts').length; i++) {
                    var indextext = $('.sorts').find('.navid0').eq(i).text();
                    // console.log("update:" + $('.sorts').children('#menuVal').eq(i).text());
                    index[i] = indextext;
                }
                var formdata={
                    'data':JSON.stringify({
                        data:index,
                        pid:0,
                    })
                }
                console.log(index)
                ajaxform(formdata,"<?php echo url('admin/nav/sort'); ?>",$)

            },
        }).disableSelection();
        jq('.sortable1').sortable({
            cursor: 'move',
            items: '.sorts1',
            update: function (event, ui) {
                var index=new Array();
                for (var i = 0; i < $(this).find('.sorts1').length; i++) {
                    var indextext = $(this).find('.navid2').eq(i).text();
                    // console.log("update:" + $('.sorts').children('#menuVal').eq(i).text());
                    index[i] = indextext;
                }

                var indextext = $(this).find('.sorts1').find('.navid1').eq(0).text();
                console.log(index)
                console.log(indextext)
                var formdata={
                    'data':JSON.stringify({
                        data:index,
                        pid:indextext
                    })
                }
                console.log(index)
                ajaxform(formdata,"<?php echo url('admin/nav/sort'); ?>",$)

            },
        }).disableSelection();
    }
        // 添加菜单
        jq('.addbtn').click(function () {
            // cosntjos
            var typeid=jq(this).children('.typeid').text();
            console.log(typeid)
            var pid=jq(this).attr('data-id');
            var index = layer.open({
                title: ['添加菜单', 'font-size:16px'],
                type: 2,
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮,
                closeBtn: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['820px', '500px'], //宽高
                content:  "<?php echo url('admin/nav/add'); ?>?pid="+pid+"&type="+typeid,
                end:function(){
                   location.reload();
                }
            })

        })
        jq('.dels').click(function () {
          var id= jq(this).parent().find('.navVal').text();
            layer.confirm('确定要删除嘛', {
                btn: ['删除','取消'], //按钮
                skin : "my-skin",
            }, function(){
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                })
                jq.get('<?php echo url("admin/nav/delete"); ?>?id='+id+'&type=1', function (data) {
                    if (data.code == 200) {
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                            location.href="<?php echo url('admin/nav/index'); ?>"
                        });
                    } else {
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                    }
                });
            }, function(){
            });
        });
// edits
        jq('.edits').click(function () {
            var id= jq(this).parent().find('.navVal').text();
            var count='<?php echo $nav_count; ?>';
            var pid=jq(this).attr('data-id');
            var index = layer.open({
                title: ['编辑菜单', 'font-size:16px'],
                type: 2,
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮,
                closeBtn: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['820px', '500px'], //宽高
                content:  "<?php echo url('admin/nav/edit'); ?>?id="+id+"&type=1",
                end:function(){
                    location.reload();
                }
            })
            // jq('#addmenubtnsure').click(function () {
            //     if (jq('.required').val() == null || jq('.required').val()==='') {
            //         jq('.required').css('border','red 1px solid');
            //         layer.msg("请输入必填项目", {icon: 2, time: 1000}, function () {
            //             //  location.reload();
            //         });
            //     } else {
            //         var formdata = $('#menuform').serialize();
            //         ajaxform(formdata,"<?php echo url('admin/nav/save'); ?>",$,function () {
            //             location.href="<?php echo url('admin/nav/index'); ?>"
            //         })
            //     }
            // })

        });
        //jq('.btable-paged').eq(1).hide();
        var status = 0;


    })
</script>

</body>
</html>