<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"E:\phpStudy\WWW\kyw/application/bbs\view\comment_edit.html";i:1548504166;s:56:"E:\phpStudy\WWW\kyw\application\bbs\view\index_base.html";i:1548473392;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_header.html";i:1547802200;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_footer.html";i:1547380684;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>修改评论|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <!--<link rel="stylesheet" href="/kyw/public/plugins/layui/css/modules/layer/default/layer.css">-->
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    
   
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <!--<script src="/kyw/public/plugins/layui/lay/modules/layer.js"></script>-->
    <script src="/kyw/public/js/common.js"></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav">
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <a class="nav-this" href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" title="<?php echo $vo['alias']; ?>"  >
          <i class="iconfont  "><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?>
      </a>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

    <div class="nav-user">

  <?php if(\think\Session::get('userid') != ''): ?>
     <!-- 登入后的状态 -->
      <a class="avatar" href="<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>">
        <img src="/kyw<?php echo \think\Session::get('userhead'); ?>">
        <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
        <i style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
      </a>
      <div class="nav">
        <a href="<?php echo url('user/index/set'); ?>"   style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
        <a data-url="<?php echo url('user/index/logout'); ?>" location-url="<?php echo url('user/index/login'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
            <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
      </div>
    <?php else: ?>
        <!-- 未登入状态 -->
        <a class="unlogin"  onclick="showLogin();" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
        <span  class="unlogin-btn" style="cursor: pointer">
          <a onclick="showLogin();" style="color:#fff;">登录</a><a onclick="showReg();"  style="color:#fff;">注册</a></span>
        <?php endif; ?>
    </div>
  </div>
</div>


<div class="main layui-clear">

<div class="main layui-clear">
  <div class="fly-panel" pad20>
    <h2 class="page-title">修改评论</h2>
    <div class="layui-form layui-form-pane">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $tptc['id']; ?>">
		
		<div class="layui-form-item">
          <label for="L_title" class="layui-form-label">所属帖子</label>
          <div class="layui-input-block">
            <input type="text"  id="L_title" value="<?php echo $tptc['title']; ?>" autocomplete="off" class="layui-input" disabled>
          </div>
        </div>
        <div class="layui-form-item layui-form-text">
          <div class="layui-input-block">
            <textarea id="textarea" name="content" lay-verify="layedit" style="height:400px;width: 100%;"><?php echo $tptc['content']; ?></textarea>
          </div>
          <label  class="layui-form-label" style="top: -2px;">内容</label>
        </div>
        <div class="layui-form-item">
          <button class="layui-btn" lay-submit="" lay-filter="comment_edit">立即发布</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if(session('userid') > 0): ?>
        <a href="<?php echo url('forum/add'); ?>" class="site-tree-mobile-edit layui-hide">
    <i class="iconfont icon-fabu"></i>
  </a>
  <?php endif; ?>
</div>

				
    
<div class="footer">
  <p>

  </p>
  <p>
  <?php if($site_config['site_icp'] != ''): ?>
  ICP备案号:<?php echo $site_config['site_icp']; endif; ?>
  
  </p>
    <p>
  <?php if($site_config['site_copyright'] != ''): ?>
 版权信息:<?php echo $site_config['site_copyright']; endif; ?>
  
  </p>
    <p>
  <?php if($site_config['site_tongji'] != ''): ?>
 <?php echo $site_config['site_tongji']; endif; ?>
  
  </p>
</div>


<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

<script type="text/javascript" src="/kyw/public//js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/kyw/public//plugins/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
   
</script>
<script>
layui.use('form', function(){
  var form = layui.form
  ,jq = layui.jquery;
    futext('#textarea');

  form.on('submit(comment_edit)', function(data){
    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
      var activeEditor = tinymce.activeEditor;
      var editBody = activeEditor.getBody();
      activeEditor.selection.select(editBody);
      var text = activeEditor.selection.getContent({'format': 'text'});
      if (text.trim()==''){
          layer.close(loading);
          layer.msg('请输入必填项！', {icon: 2, time: 1000});
          return false;
      }
    var param={'content': tinyMCE.activeEditor.getContent()};
      jq.post('<?php echo url("comment/edit",array("id"=>$tptc['id'])); ?>',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.href = '<?php echo url("user/index/comment"); ?>';
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