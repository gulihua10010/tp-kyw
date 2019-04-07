<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"E:\phpStudy\WWW\kyw/application/admin\view\comment_index.html";i:1548837214;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      

<div class="admin-main layui-form">
<div class="layui-field-box">
<div class="layui-box-searchber">
				<button class="layui-btn layui-btn-small" data-url="<?php echo url('admin/comment/alldelete'); ?>"  lay-submit lay-filter="alldelete">删除选中</button>
</div>
                <hr>
  	<table class="layui-table admin-table">
     	<thead> <tr>
	    <th width="5%" align="center"><input type="checkbox" name="checkAll" lay-filter="checkAll"></th>
		<th width="5%" align="center">ID</th>
        <th width="30%" align="center">评论内容</th>
        <th width="10%" align="center">评论类别</th>
		<th width="20%" align="center">所属帖子/文章/课程</th>
		<th width="10%" align="center">所属会员</th>
		<th width="10%" align="center">评论时间</th>
        <th width="10%" align="center">基本操作</th>
      </tr>	</thead>
						<tbody id="content">
						<!--1 bbs 6课程 4视频 7文章 8 资料-->
      <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	  <tr>
	    <td align="center"><input type="checkbox" name="ids[<?php echo $vo['id']; ?>]" lay-filter="checkOne" value="<?php echo $vo['id']; ?>"></td>
		<td align="center"><?php echo $vo['id']; ?></td>
        <td style="padding-left: 20px;">
			<?php if($vo['type'] == 1): ?>
			<a target="_blank" href="<?php echo routerurl('bbs/index/thread',array('id'=>$vo['fid'])); ?>"><?php echo mb_substr(strip_tags($vo['content']), 0, 35, 'utf-8');?>...</a></td>
	  	  <?php elseif($vo['type'] == 6): ?>
		  <a target="_blank" href="<?php echo routerurl('index/course/detail',array('id'=>$vo['fid'])); ?>"><?php echo mb_substr(strip_tags($vo['content']), 0, 35, 'utf-8');?>...</a></td>

		  <?php elseif($vo['type'] == 4): ?>
		  <a target="_blank" ><?php echo mb_substr(strip_tags($vo['content']), 0, 35, 'utf-8');?>...</a></td>

		  <?php elseif($vo['type'] == 7): ?>
		  <a target="_blank" href="<?php echo routerurl('index/article/detail',array('id'=>$vo['fid'])); ?>"><?php echo mb_substr(strip_tags($vo['content']), 0, 35, 'utf-8');?>...</a></td>
		  <?php elseif($vo['type'] == 8): ?>
		  <a target="_blank" href="<?php echo routerurl('index/resource/detail',array('id'=>$vo['fid'])); ?>"><?php echo mb_substr(strip_tags($vo['content']), 0, 35, 'utf-8');?>...</a></td>

		  <?php endif; ?>
		  <td style="padding-left: 20px;">
			  <?php if($vo['type'] == 1): ?>
			   帖子</td>
		  <?php elseif($vo['type'] == 6): ?>
		 课程</td>

		  <?php elseif($vo['type'] == 4): ?>
		  课程视频</td>

		  <?php elseif($vo['type'] == 7): ?>
		 文章 </td>
		  <?php elseif($vo['type'] == 8): ?>
		  资料</td>

		  <?php endif; ?>
		  <td style="padding-left: 20px;">
			  <?php if($vo['type'] == 1): ?>
			  <a target="_blank" href="<?php echo routerurl('bbs/index/thread',array('id'=>$vo['fid'])); ?>"> <?php echo getforumbyid($vo['fid']); ?></a></td>
		  <?php elseif($vo['type'] == 6): ?>
		  <a target="_blank" href="<?php echo routerurl('index/course/detail',array('id'=>$vo['fid'])); ?>"><?php echo getcoursebyid($vo['fid']); ?> </a></td>

		  <?php elseif($vo['type'] == 4): ?>
		  <a target="_blank"  ><?php echo getvideobyid($vo['fid']); ?> </a></td>

		  <?php elseif($vo['type'] == 7): ?>
		  <a target="_blank" href="<?php echo routerurl('index/article/detail',array('id'=>$vo['fid'])); ?>"> <?php echo getartbyid($vo['fid']); ?></a></td>
		  <?php elseif($vo['type'] == 8): ?>
		  <a target="_blank" href="<?php echo routerurl('index/resource/detail',array('id'=>$vo['fid'])); ?>"> <?php echo getresbyid($vo['fid']); ?></a></td>

		  <?php endif; ?>
		<td align="center"><a target="_blank" href="<?php echo routerurl('user/home',array('id'=>$vo['uid'])); ?>"><?php echo $vo['username']; ?></a></td>
		<td align="center"><?php echo friendlyDate($vo['time']); ?></td>
        <td align="center"> 
        <a class="elementdel layui-btn layui-btn-danger layui-btn-mini" href="javascript:;" data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/comment/delete',array('id'=>$vo['id'])); ?>"   title="删除" >删除</a>
      
        </td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
					</table>
				</div>
		
			
		</div>
 
</div>

 
<div class="btable-paged" >
<div class="layui-main">
<?php echo $tptc->render(); ?>
</div>
</div>
   

<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>
 
<!--页面JS脚本-->

</body>
</html>