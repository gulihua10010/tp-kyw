<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\phpStudy\WWW\kyw/application/admin\view\school_index.html";i:1548845898;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      

<div class="admin-main">
    <div class="layui-field-box layui-form">

        <div class="layui-box-searchber">
            <a href="<?php echo url('admin/school/add'); ?>" class="layui-btn layui-btn-small" id="add">
                <i class="layui-icon">&#xe608;</i> 添加学校
            </a>
            <form class=" layui-form-pane" action="<?php echo url('admin/school/index'); ?>" method="get">
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input type="text" name="keyword" value="<?php echo session('schoolkeyword'); ?>" placeholder="请输入关键词"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn  layui-btn-small">搜索</button>
                </div>
            </form>
        </div>
        <table class="layui-table admin-table">
            <thead>
            <tr>
                <th width="5%" align="center">ID</th>
                <th width="15%" align="center">学校名称</th>
                <th width="15%" align="center">学校省份</th>
                <th width="15%" align="center">学校属性</th>
                <th width="15%" align="center">学校类别</th>
                <th width="15%" align="center">学校隶属</th>
                <th width="10%" align="center">添加时间</th>
                <th width="10%" align="center">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($schools) || $schools instanceof \think\Collection || $schools instanceof \think\Paginator): $i = 0; $__LIST__ = $schools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td align="center"><?php echo $vo['id']; ?></td>
                <td style="padding-left: 20px;"><a target="_blank"
                                                   href=" <?php echo routerurl('index/school/detail',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?></a>
                </td>
                <td align="center">
                    <a target="_blank"  ><?php echo $vo['provinceName']; ?></a>
                </td>
                <td align="center">
                    <a target="_blank" ><?php echo $vo['prop']; ?></a>
                </td>
                <td align="center"><a target="_blank"  ><?php echo $vo['type']; ?></a>
                </td>
                <td align="center">
                    <a target="_blank"  ><?php echo $vo['belong']; ?></a>
                </td>
                <td align="center"><?php echo date("Y-m-d",$vo['time']); ?></td>
                <td align="center"><a class="layui-btn layui-btn-normal layui-btn-mini"
                                      href="<?php echo url('school/edit',array('id'=>$vo['id'])); ?>">修改</a>
                    <a class="elementdel layui-btn layui-btn-danger layui-btn-mini" href="javascript:;"
                       data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/school/delete',array('id'=>$vo['id'])); ?>"
                       title="删除">删除</a>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>

 
<div class="btable-paged" style="position: relative;right: 30%">
    <div class="layui-main">
        <?php echo $schools->render(); ?>
    </div>
</div>


<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>

<!--页面JS脚本-->


<script>
    layui.use('form', function () {
        var form = layui.form
            , jq = layui.jquery;

    })
    layui.use(['element', 'jquery'], function (data) {
        var element = layui.element
            , $ = layui.jquery;//导航的hover效果、二级菜单等功能，需要依赖element模块

    })
</script>

</body>
</html>