<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\phpStudy\WWW\kyw/application/admin\view\course_index.html";i:1548845740;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>后台管理</title>
		<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="/kyw/public/css/main.css"  media="all"  />
	
    
<link rel="stylesheet" href="/kyw/public/css/form.css">

   
    <!--[if lt IE 9]>
    <script src="/kyw/static/css/html5shiv.min.js"></script>
    <script src="/kyw/static/css/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/kyw/public/plugins/layui/layui.js"></script>
</head>
<body>

    <!--主体-->
    <div style="margin-bottom:36px;">
      

<div class="layui-tab layui-tab-brief">
    <ul class="layui-tab-title">
        <li class="layui-this">课程</li>
        <li>课程类别</li>
    </ul>


    <div class="layui-form form-container layui-tab-content">

        <div class="layui-tab-item layui-show">
            <div class="layui-box-searchber">
                <a href="<?php echo url('admin/Course/add'); ?>" class="layui-btn layui-btn-small">
                    <i class="layui-icon">&#xe608;</i>添加课程</a>
                <form class=" layui-form-pane" action="<?php echo url('admin/course/index'); ?>" method="get">
                    <div class="layui-inline">
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" value="<?php echo session('coursekeyword'); ?>" placeholder="请输入关键词"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn  layui-btn-small">搜索</button>
                    </div>
                </form>
            </div>
            <hr>

            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th width="5%" align="center">ID</th>
                    <th width="20%" align="center">课程名称</th>
                    <th width="25%" align="center">课程图片</th>
                    <th width="10%" align="center">是否显示</th>
                    <th width="10%" align="center">是否精选</th>
                    <th width="10%" align="center">所属类别</th>
                    <th width="10%" align="center">添加时间</th>
                    <th width="10%" align="center">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td align="center"><?php echo $vo['id']; ?></td>
                    <td style="padding-left: 20px;"><a target="_blank"
                                                       href=" <?php echo routerurl('index/course/detail',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a>
                    </td>
                    <td align="center"><?php if($vo['pic'] != ''): ?><img style="border: 1px solid #CDCDCD;padding: 3px;border-radius: 2px;"
                                                                              src="/kyw<?php echo $vo['pic']; ?>" height="25 " width="60"><?php else: ?>暂无图片<?php endif; ?></td>
                    <td align="center">
                        <input type="checkbox" name="show" lay-skin="switch" lay-text="显示|隐藏" lay-filter="switchopen"
                               value="<?php echo $vo['id']; ?>" <?php echo $vo['show']==1 ? 'checked' : ''; ?>/>

                    </td>
                    <td align="center">
                        <input type="checkbox" name="show" lay-skin="switch" lay-text="精选|精选" lay-filter="switchchoice"
                               value="<?php echo $vo['id']; ?>" <?php echo $vo['choice']==1 ? 'checked' : ''; ?>/>

                    </td>
                    <td align="center"><a target="_blank" href=" "><?php echo $vo['typename']; ?></a>
                    </td>
                    <td align="center"><?php echo date("Y-m-d",$vo['time']); ?></td>
                    <td align="center"><a class="layui-btn layui-btn-normal layui-btn-mini"
                                          href="<?php echo url('course/edit',array('id'=>$vo['id'])); ?>">修改</a>
                        <a class="elementdel layui-btn layui-btn-danger layui-btn-mini" href="javascript:;"
                           data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/course/delete',array('id'=>$vo['id'])); ?>" title="删除">删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <div class="layui-tab-item">
            <div class="layui-box-searchber">
                <a href="<?php echo url('admin/CourseType/add'); ?>" class="layui-btn layui-btn-small">
                    <i class="layui-icon">&#xe608;</i>添加类别</a>
            </div>
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th width="10%" align="center">ID</th>
                    <th width="30%" align="center">类别名称</th>
                    <th width="30%" align="center">添加时间</th>
                    <th width="30%" align="center">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td align="center"><?php echo $vo['id']; ?></td>
                    <td style="padding-left: 20px;"><a target="_blank" href="  "><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' --';} endif; ?> <?php echo $vo['name']; ?></a></td>
                    <td align="center"><?php echo date("Y-m-d",$vo['time']); ?></td>
                    <td align="center"><a class="layui-btn layui-btn-normal layui-btn-mini"
                                          href="<?php echo url('CourseType/edit',array('id'=>$vo['id'])); ?>">修改</a>
                        <a class="elementdel layui-btn layui-btn-danger layui-btn-mini" href="javascript:;"
                           data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/CourseType/delete',array('id'=>$vo['id'])); ?>"
                           title="删除">删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>


    </div>
</div>


</div>

 
<div class="btable-paged">
    <div class="layui-main">
    <?php echo $course->render(); ?>
    </div>
</div>


<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>

<!--页面JS脚本-->


<script>
    layui.use('form',function(){
        var form = layui.form
            , jq = layui.jquery;
        var status = 0;

        form.on('switch(switchopen)', function (data) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
            if (data.elem.checked) {
                status = 1;
            } else {
                status = 0;
            }
            var url = "<?php echo url('admin/course/toggle'); ?>?id=" + data.value + '&status=' + status + '&name=show';
            console.log(url)

            jq.get(url, function (data) {

                if (data.code == 200) {
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                        //  location.reload();
                    });
                } else {
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                }
            });
            return false;
        });

        form.on('switch(switchchoice)', function (data) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
            if (data.elem.checked) {
                status = 1;
            } else {
                status = 0;
            }
            var url = "<?php echo url('admin/course/toggle'); ?>?id=" + data.value + '&status=' + status + '&name=choice';


            jq.get(url, function (data) {

                if (data.code == 200) {
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 1, time: 1000}, function () {
                        //  location.reload();
                    });
                } else {
                    layer.close(loading);
                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                }
            });
            return false;
        });


    })
    layui.use(['element','jquery'], function(data) {
        var element = layui.element
            ,$ = layui.jquery;//导航的hover效果、二级菜单等功能，需要依赖element模块

    })
</script>

</body>
</html>