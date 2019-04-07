<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\phpStudy\WWW\kyw/application/admin\view\index_home.html";i:1545206436;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      

	<div class="tpt—index fly-panel fly-panel-user">
<blockquote style="padding: 10px;border-left: 5px solid #009688;" class="layui-elem-quote">欢迎考研网后台管理系统，<span style="color:#FF5722;"></span></blockquote>

<blockquote style="padding: 10px;border-left: 5px solid #009688;" class="layui-elem-quote">系统信息：</blockquote>
<table width="100%">
<tr><td width="110px">程序版本</td><td>考研网1.0  </td></tr>
<tr><td>服务器类型</td><td><?php echo php_uname('s'); ?></td></tr>
<tr><td>PHP版本</td><td><?php echo PHP_VERSION; ?></td></tr>
<tr><td>Zend版本</td><td><?php echo Zend_Version(); ?></td></tr>
<tr><td>服务器解译引擎</td><td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td></tr>
<tr><td>服务器语言</td><td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></td></tr>
<tr><td>服务器Web端口</td><td><?php echo $_SERVER['SERVER_PORT']; ?></td></tr>
</table>
<table width="100%">
</table>
</div>
    
</div>

 

<script>

</script>

<!--页面JS脚本-->

    <script>
    layui.use(['layer','jquery'],function(){
    	  var jq = layui.jquery;
    	  
    	  
    	  jq('#update').click(function(){
    		  
    		  var url=jq(this).data('url');
    		    jq.getJSON(url,function(data){
    		    	  loading = layer.load(2, {
    		    	      shade: [0.2,'#000']
    		    	    });
    		    	
    		      if(data.code == 200){
    		        layer.close(loading);
    		        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
    		          
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