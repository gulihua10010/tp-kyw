<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"E:\phpStudy\WWW\kyw/application/admin\view\usergrade_index.html";i:1495897930;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      

<div class="admin-main">
<div class="layui-field-box layui-form">
				<a href="<?php echo url('admin/usergrade/add'); ?>" class="layui-btn layui-btn-small" id="add">
					<i class="layui-icon">&#xe608;</i> 添加会员等级
				</a>
				<table class="layui-table admin-table">
				<thead>
                    <tr>
                        <th style="width: 30px;">ID</th>
                        <th>名称</th>
                        <th>积分</th>
                       
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($auth_group_list) || $auth_group_list instanceof \think\Collection || $auth_group_list instanceof \think\Paginator): if( count($auth_group_list)==0 ) : echo "" ;else: foreach($auth_group_list as $key=>$vo): ?>
                    <tr>
                        <td><?php echo $vo['id']; ?></td>
                        <td><?php echo $vo['name']; ?></td>
                        <td><?php echo $vo['score']; ?></td>
                       
                        <td>
                           
                            <a href="<?php echo url('admin/usergrade/edit',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                            <a href="javascript:;" data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/usergrade/delete',array('id'=>$vo['id'])); ?>" data-opt="del"  class="elementdel layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
	</div>
		
			
		</div>				

</div>

 

<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>
 
<!--页面JS脚本-->

</body>
</html>