<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"E:\phpStudy\WWW\kyw/application/admin\view\forum_index.html";i:1548846054;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
				<button class="layui-btn layui-btn-small" data-url="<?php echo url('admin/forum/alldelete'); ?>"  lay-submit lay-filter="alldelete">删除选中</button>



                <form class=" layui-form-pane" action="<?php echo url('admin/forum/index'); ?>" method="get"  >
                    <div class="layui-inline">
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" value="<?php echo session('forumkeyword'); ?>" placeholder="请输入关键词" class="layui-input">
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
	    <th width="5%" align="center"><input type="checkbox"  name="checkAll" lay-filter="checkAll"></th>
		<th width="5%" align="center">ID</th>
        <th width="30%" align="center">帖子标题</th>
		<th width="10%" align="center">是否显示</th>
		<th width="10%" align="center">是否顶置</th>
		<th width="10%" align="center">是否精选</th>
		<th width="10%" align="center">所属栏目</th>
		<th width="10%" align="center">添加时间</th>
        <th width="10%" align="center">操作</th>
      </tr>
      	</thead>
						<tbody id="content">
      <?php if(is_array($forum_list) || $forum_list instanceof \think\Collection || $forum_list instanceof \think\Paginator): $i = 0; $__LIST__ = $forum_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
	  <tr>
	    <td align="center"><input type="checkbox"  name="ids[<?php echo $vo['id']; ?>]" lay-filter="checkOne" value="<?php echo $vo['id']; ?>"></td>
		<td align="center"><?php echo $vo['id']; ?></td>
        <td style="padding-left: 20px;"><a target="_blank" href=" <?php echo routerurl('bbs/index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a></td>
		<td align="center">
		<input type="checkbox" name="show" lay-skin="switch" lay-text="显示|隐藏" lay-filter="switchopen"  value="<?php echo $vo['id']; ?>" <?php echo $vo['open']==1 ? 'checked' : ''; ?>>
		
		</a>
		</td>
		<td align="center">
		<input type="checkbox" name="show" lay-skin="switch" lay-text="置顶|置顶" lay-filter="switchsettop"  value="<?php echo $vo['id']; ?>" <?php echo $vo['settop']==1 ? 'checked' : ''; ?>>
	
	
		</a>
		</td>
		<td align="center">
		<input type="checkbox" name="show" lay-skin="switch" lay-text="精选|精选" lay-filter="switchchoice"  value="<?php echo $vo['id']; ?>" <?php echo $vo['choice']==1 ? 'checked' : ''; ?>>
		
	
		</a>
		</td>
		<td align="center"><a target="_blank" href="<?php echo routerurl('index/view',array('id'=>$vo['cid'])); ?>"><?php echo $vo['name']; ?></a></td>
		<td align="center"><?php echo friendlyDate($vo['time']); ?></td>
        <td align="center"><a class="layui-btn layui-btn-normal layui-btn-mini" href="<?php echo url('forum/edit',array('id'=>$vo['id'])); ?>">修改</a> 
        <a class="elementdel layui-btn layui-btn-danger layui-btn-mini" href="javascript:;" data-id="<?php echo $vo['id']; ?>" data-url="<?php echo url('admin/forum/delete',array('id'=>$vo['id'])); ?>"   title="删除" >删除</a>
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
<?php echo $forum_list->render(); ?>
</div>
</div>
   

<script>

</script>

<script type="text/javascript" src="/kyw/public/js/delelement.js"></script>
 
<!--页面JS脚本-->


<script>
layui.use('form',function(){
  var form = layui.form ;
   var jq = layui.jquery;
  var status=0;
  form.on('switch(switchopen)', function(data){
 	  loading = layer.load(2, {
 	      shade: [0.2,'#000']
 	    });
 	    if(data.elem.checked){
 	    	status=1;
 	    }else{
 	    	status=0;
 	    }
 	    var url="<?php echo url('admin/forum/toggle'); ?>?id="+data.value+'&status='+status+'&name=open' ;
 	   
 	    
 	    jq.get(url,function(data){
 	    	
 	      if(data.code == 200){
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
 	        //  location.reload();
 	        });
 	      }else{
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
 	      }
 	    });
 	    return false;
 	  });

  form.on('switch(switchchoice)', function(data){
 	  loading = layer.load(2, {
 	      shade: [0.2,'#000']
 	    });
 	    if(data.elem.checked){
 	    	status=1;
 	    }else{
 	    	status=0;
 	    }
 	    var url="<?php echo url('admin/forum/toggle'); ?>?id="+data.value+'&status='+status+'&name=choice' ;
 	   
 	    
 	    jq.get(url,function(data){
 	    	
 	      if(data.code == 200){
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
 	        //  location.reload();
 	        });
 	      }else{
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
 	      }
 	    });
 	    return false;
 	  });
  form.on('switch(switchsettop)', function(data){
 	  loading = layer.load(2, {
 	      shade: [0.2,'#000']
 	    });
 	    if(data.elem.checked){
 	    	status=1;
 	    }else{
 	    	status=0;
 	    }
 	    var url="<?php echo url('admin/forum/toggle'); ?>?id="+data.value+'&status='+status+'&name=settop' ;
 	   
 	    
 	    jq.get(url,function(data){
 	    	
 	      if(data.code == 200){
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
 	        //  location.reload();
 	        });
 	      }else{
 	        layer.close(loading);
 	        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
 	      }
 	    });
 	    return false;
 	  });

 


})
</script>
   
</body>
</html>