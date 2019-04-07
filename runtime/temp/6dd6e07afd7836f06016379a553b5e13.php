<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"E:\phpStudy\WWW\kyw/application/bbs\view\forum_edit.html";i:1548746388;s:56:"E:\phpStudy\WWW\kyw\application\bbs\view\index_base.html";i:1548473392;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_header.html";i:1547802200;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_footer.html";i:1547380684;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>编辑帖子|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <!--<link rel="stylesheet" href="/kyw/public/plugins/layui/css/modules/layer/default/layer.css">-->
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    

<script src="/kyw/public//js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public//js/jquery-form.js"></script>
<style type="text/css">
.tpt_sels a{padding-right:15px;position:relative}
.tpt_sels a{padding:0 20px 0 8px;color:#3B6268;background:#FFFFBA;border:1px #F8E06E solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
.tpt_pres a.selected{padding:0 8px;color:#3B6268;background:#FFFFBA;border:1px #F8E06E solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
.tpt_pres a{padding:0 8px;color:#fff;background:#5AC7A9;border:1px #5AC7A9 solid;margin-right:5px;margin-bottom:5px;font-size:14px;height:26px;line-height:26px;display:block;float:left}
.tpt_sels a em{width: 12px;height: 12px;font-style: normal;display: block;position: absolute;top: 7px;right: 4px;z-index: 2;background: url(/kyw/public//images/sx.png) no-repeat 0 0;}
.cl{zoom:1}
.cl:after{content:'\20';display:block;height:0;clear:both;visibility:hidden}
</style>
           
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
    <h2 class="page-title">修改帖子</h2>
    
    <!-- <div class="fly-none">并无权限</div> -->

    <div class="layui-form layui-form-pane">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $tptc['id']; ?>">
		<div class="layui-form-item">
          <div class="layui-inline">
            <label class="layui-form-label">板块</label>
            <div class="layui-input-block">
              <select name="tid" id="tid">
			  <?php if(is_array($tptcs) || $tptcs instanceof \think\Collection || $tptcs instanceof \think\Paginator): $i = 0; $__LIST__ = $tptcs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <option <?php if($tptc['tid'] == $vo['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
              <?php endforeach; endif; else: echo "" ;endif; ?>
			  </select>
            </div>
          </div>
        </div>
		<div class="layui-form-item">
          <label for="L_title" class="layui-form-label">标题</label>
          <div class="layui-input-block">
            <input type="text" name="title" id="L_title" value="<?php echo $tptc['title']; ?>" required lay-verify="required|titlea|titleb" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item layui-form-text">
          <div class="layui-input-block">
            <textarea id="textarea" name="content" style="height:400px;width: 100%;"><?php echo $tptc['content']; ?></textarea>
          </div>
          <label   class="layui-form-label" style="top: -2px;">内容</label>
        </div>
		<div class="tpt_item">
		<input type="hidden" name="keywords" value="<?php echo $tptc['keywords']; ?>">
		<div id="tpt_sel" class="tpt_sels" style="margin-top: 20px;">
			<span style="margin-bottom: 5px;float: left;">
			<?php if($tptc['keywords'] != ''): $arr=explode(',', $tptc['keywords']);foreach ($arr as $k=>$v){echo "<a href='javascript:;'>$v<em></em></a>";}endif; ?>
			</span>
			<div class="layui-form-item" style="margin-bottom: 10px;">
				<label class="layui-form-label">标签</label>
				<div class="layui-input-block">
					<input id="tpt_input" type="text" value="" autocomplete="off" class="layui-input" style="width: 400px;float: left;margin-right: 20px;">
					<button class="layui-btn" id="tpt_btn" type="button" style="background: #FF5722;">添加标签</button>
				</div>
			</div>
		</div>
		<div id="tpt_pre" class="tpt_pres cl" style="margin-bottom: 15px;">
			<?php if(is_array($tagss) || $tagss instanceof \think\Collection || $tagss instanceof \think\Paginator): $i = 0; $__LIST__ = $tagss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;if($tag != ''): ?><a href="javascript:;"><?php echo $tag; ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</div>
	    </div>
          <div class="layui-form-item">
              <label class="layui-form-label">帖子附件</label>
              <div class="layui-input-inline">
                  <button type="button" class="layui-btn" id="data" name="dd">
                      <i class="layui-icon">&#xe67c;</i>上传附件
                  </button>
                  <input type="text" name="data" class="layui-input"
                         style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required" value="<?php echo $tptc['file']; ?>">
              </div>

          </div>
          <div class="label-tint"><span style="color: #ffcc6f">上传资料为zip或rar压缩文件、word、pdf文档(压缩文件如果有密码在帖子里说明)</span> </div>

          <div class="layui-form-item"  id="uploading-data" style="position: relative ;display: none" >
              <label class="layui-form-label">上传进度</label>
              <div class="layui-progress" lay-showpercent="true" lay-filter="process"
                   style="  width: 60%;position: absolute;left: 110px;top:16px" >
                  <div class="layui-progress-bar layui-bg-green" lay-percent="0%"></div>
              </div>
          </div>
        <div class="layui-form-item">
          <button class="layui-btn" lay-submit="" lay-filter="forum_edit" style="background-color: rgb(23,179,241); border-radius: 5px">立即更新</button>
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

<script type="text/javascript" src="/kyw/public//plugins/tinymce/tinymce.min.js"></script>
<script src="/kyw/public//js/common.js"></script>
<script type="text/javascript">
$(function() {
	$('#tpt_input').keydown(function(e) {
		if (e.which === 13) {
			$("#tpt_btn").click();
			e.preventDefault();
			return false;
		}
	});
	$("#tpt_sel").on('click', 'a>em', function() {
		var name = "keywords";
		var tag = $(this).parent().text();
		$(this).parent().remove();
		var tags = new Array();
		$("#tpt_sel").find('a').each(function() {
			tags.push($(this).text());
		});
		$("input[name=" + name + "]").val(tags.join(","));
		$("#tpt_pre a:contains('" + tag + "')").removeClass("selected");
	});
	$("#tpt_btn").click(function() {
		var name = "keywords";
		var tags = $.trim($("input[name=" + name + "]").val());
		if (tags !== "") {
			tags = tags.split(",");
		} else {
			tags = new Array();
		}
		var tag = $.trim($("#tpt_input").val());
		if (tag !== '' && $.inArray(tag, tags) === -1) {
			tags.push(tag);
			$("#tpt_pre a:contains('" + tag + "')").addClass("selected");
		}
		$("#tpt_sel").children('span').empty();
		$.each(tags, function(k, v) {
			$("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
		});
		$("input[name=" + name + "]").val(tags.join(","));
		$("#tpt_input").val('');
	});
	$("#tpt_pre").on('click', 'a:not(.selected)', function() {
		var name = "keywords";
		var tags = $.trim($("input[name=" + name + "]").val());
		if (tags !== "") {
			tags = tags.split(",");
		} else {
			tags = new Array();
		}
		var tag = $.trim($(this).text());
		if (tag !== '' && $.inArray(tag, tags) === -1) {
			tags.push(tag);
		}
		$("#tpt_sel").children('span').empty();
		$.each(tags, function(k, v) {
			$("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
		});
		$("input[name=" + name + "]").val(tags.join(","));
		$(this).addClass('selected');
	});
});
</script>
<script type="text/javascript">
    futext('#textarea')


</script>
<script>
    layui.use(['layer', 'form', 'element', 'upload'], function(){
        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element
  form.verify({
	  titlea: function(value){
      if(value.length < 5){
        return '标题必须大于5位';
      }
    }
	,titleb: function(value){
      if(value.length > 32){
        return '标题必须小于32位';
      }
    }
  });
        upload.render({
            url: '<?php echo url("admin/upload/upfile"); ?>'
            , elem: '#data'
            ,accept:'file'
            , exts: 'zip|doc|pdf|rar|docx|txt|'
            , progress: function (e, percent) {
                element.progress('process', percent + "%");

            }
            , before: function (input) {
                $('#uploading-data').css('display','block')
                loading = layer.load(2, {
                    shade: [0.2, '#000']
                });
            }
            , done: function (res) {
                layer.close(loading);
                $('input[name=data]').val(res.path);
                layer.msg(res.msg, {icon: 1, time: 1000});
                // $('#uploaded-image').attr('src',getRootPath_web()+res.path);
            }, error: function () {
                layer.close(loading);
                layer.msg('上传出错：1', {
                    title: '提示'
                    //不自动关闭
                    , time: 1000
                    , icon: 5
                    , offset: '400px'
                });
            }
        });
    form.on('submit(forum_edit)', function(data){
        loading = layer.load(2, {
            shade: [0.2,'#000']
        });

        var formdata = {
            'data': JSON.stringify({
                'title': $('input[name=title]').val()
                , 'keywords': $('input[name=keywords]').val()
                , 'tid': $('#tid').val()
                , 'content': tinyMCE.activeEditor.getContent()
                , 'file':  $('input[name=data]').val()

            })
        }
        ajaxform(formdata,'<?php echo url("forum/edit",array("id"=>$tptc['id'])); ?>',$,function () {
            location.href = '<?php echo url("user/index/topic"); ?>';
        })
        return false;
    });


})
</script>

</body>
</html>