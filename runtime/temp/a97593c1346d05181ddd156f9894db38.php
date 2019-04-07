<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:58:"E:\phpStudy\WWW\kyw/application/bbs\view\index_thread.html";i:1548939516;s:56:"E:\phpStudy\WWW\kyw\application\bbs\view\index_base.html";i:1548851774;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_header.html";i:1548855238;s:57:"E:\phpStudy\WWW\kyw\application\bbs\view\index_right.html";i:1547377358;s:58:"E:\phpStudy\WWW\kyw\application\bbs\view\index_footer.html";i:1548923454;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title><?php echo strip_tags($t['title']); ?>|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <!--<link rel="stylesheet" href="/kyw/public/plugins/layui/css/modules/layer/default/layer.css">-->
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    
<style type="text/css">
 ul li {
     list-style: none;
 }
.pagination {margin: 0 0 20px 0;}
i{font-style: italic;}
</style>
        
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <!--<script src="/kyw/public/plugins/layui/lay/modules/layer.js"></script>-->
    <script src="/kyw/public/js/common.js"></script>
    <script src="/kyw/public/js/gt.js"></script>
</head>
<body>
<div class="header">
  <div class="main">
    <a  class="main-title" href="<?php echo url('index/index'); ?>" title="<?php echo $site_config['site_title']; ?>"><?php echo $site_config['site_title']; ?></a>
    <div class="nav-bbs">
        <ul>
    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <li   >
         <span><a  href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><i class="iconfont"><?php echo $vo['icon']; ?></i><?php echo $vo['name']; ?></a></span>
          <ul>
              <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
              <li> <span><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></span></li>
              <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
      </li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
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
        <a data-url="<?php echo url('user/index/logout'); ?>"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
            <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
      </div>
    <?php else: ?>
        <!-- 未登入状态 -->
        <div class="lg-reg">
        <a class="unlogin"  onclick="showLogin();" ><i  style=" font-size: 26px;" class="iconfont  ">&#xe678;</i></a>
        <span  class="unlogin-btn" style="cursor: pointer">
          <a onclick="showLogin();" style="color:#fff;">登录</a><a onclick="showReg();"  style="color:#fff;">注册</a></span></div>
        <?php endif; ?>
    </div>
  </div>
</div>


<div class="main layui-clear">

<script src="/kyw/public//js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public//js/jquery-form.js"></script>
<div class="main layui-clear">
  <div class="wrap">
    <div class="content detail">
	  <div class="fly-panel detail-box">
        <h1><?php echo $t['title']; ?></h1>
        <div class="fly-tip fly-detail-hint">
         <?php if($t['uid'] == session('userid')): ?> <span><a style="color:#fff;" href="<?php echo url('forum/edit',array('id'=>$t['id'])); ?>" target="_blank">编辑</a></span><?php endif; ?>
		  <span><a style="color:#fff;" class="jie-user" href="<?php echo url('index/view',array('id'=>$t['cid'])); ?>"><?php echo $t['name']; ?></a></span>
		  <?php if($t['settop'] == 1): ?><span style="margin-right: 4px;" class="fly-tip-stick">置顶</span><?php endif; if($t['choice'] == 1): ?><span class="fly-tip-jing">精帖</span><?php endif; ?>
          <div class="fly-list-hint">
              <i class="iconfont" title="回答">&#xe6b7;</i>  <?php echo $t['reply']; ?>
              <i class="iconfont" title="人气">&#xe6a5;</i><?php echo $t['view']; ?>
          </div>
        </div>
		<div class="detail-about">
		<a class="jie-user" href="<?php echo url('user/index/home',array('id'=>$t['userid'])); ?>">
            <img src="<?php echo getheadurl($t['userhead']); ?>" alt="<?php echo $t['username']; ?>">
            <cite id="zuozhename" data-id="<?php echo $t['userid']; ?>">
             <?php echo $t['username']; ?>
              <em><?php echo friendlyDate($t['time']); ?></em>
            </cite>
          </a>
          <div class="detail-hits">
            <span class="margin-left:10px;" style="color:#FF5722"><?php echo getgradenamebyid($t['point'],$t['userid']); ?></span>
			<span class="" style="color:#009688"><?php echo $site_config['point_name']; ?>：<?php echo $t['point']; ?></span>
          </div>
        </div>
        <div class="detail-body photos" style="margin-bottom: 20px;">
          <div class="  " style="border: 0px solid #e6e6e6;">
		  <div class=" " style="padding: 0;margin-top: 0;">
		  <?php echo clearHTMLhead($content); ?>
		   </div>
           </div>
           <div class="fly-tip fly-detail-hint">
		  <?php if($t['keywords'] != ''): if(is_array($keywordarr) || $keywordarr instanceof \think\Collection || $keywordarr instanceof \think\Paginator): $i = 0; $__LIST__ = $keywordarr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		  <a href="<?php echo url('index/search'); ?>?ks=<?php echo urlencode($vo); ?>" blank="_blank">
		 <span class="fly-tip-jing" style="background:#c2c2c2;border-radius:2px;padding:3px 6px;margin-right:10px;">
		 <?php echo $vo; ?>

		 </span> </a>
         <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
            <?php if($file != null): ?>
            <div class="forum-files">
                <span class="res-download">
                <span style="color: #1bc7f1">下载:
                <svg class="icon" aria-hidden="true">
                       <use xlink:href="<?php echo getExtIcon($file['ext']); ?>"></use>
                 </svg> <?php echo $file['name']; ?></span><input type="hidden" id="isdownload" value="<?php echo $isdownload; ?>"></span>
              (  <span>文件大小:<?php echo format_bytes($file['size']); ?></span>
                <span>下载积分:<?php echo $point_download; ?></span>)
            </div>
            <?php endif; ?>
        </div>
      </div>
        <div class="comment-list">
            <?php if(($tptc==null)): ?>
            暂无评论！
            <?php endif; if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="comment-unit">
                <div class="comment-info">
                     <a target="_blank"  href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"><img src="/kyw<?php echo $vo['userhead']; ?>"
                               width="30"  alt="<?php echo $vo['username']; ?>"/> <span><?php echo $vo['username']; ?></span></a> <span><?php echo friendlyDate($vo['time']); ?></span>
                </div>
                <div class="comment-con">
                    <span><?php echo clearHTMLhead($vo['content']); ?></span>
                </div>
                <div class="comment-op">
                     <span <?php   if(in_array($vo['id'],$iszans))echo 'style="color:red"'; ?>  data-id="<?php echo $vo['id']; ?>" type="zan">
                         <i class="iconfont">&#xe611;</i>&nbsp;<span><?php echo $vo['praise']; ?></span>
                      </span>
                    <span type="reply"  data-id="<?php echo $vo['id']; ?>"  data-name="<?php echo $vo['username']; ?>"><i class="iconfont  ">&#xe644;</i>&nbsp;回复</span>
                    <?php if($vo['userid'] == session('userid')): ?>
                    <div class=" comm-edit">
                        <span type="edit"><a style="color:#999" href="<?php echo url('comment/edit',array('id'=>$vo['id'])); ?>" target="_blank">编辑</a></span>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="reply-comment">
                    <?php if(is_array($vo['reply']) || $vo['reply'] instanceof \think\Collection || $vo['reply'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['reply'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$reply): $mod = ($i % 2 );++$i;?>
                    <div class="comment-unit">
                        <div class="comment-info">
                        <a target="_blank"  href="<?php echo url('user/index/home',array('id'=>$reply['rinfo']['id'])); ?>"><img
                                src="/kyw<?php echo $reply['rinfo']['userhead']; ?>" width="30"></a><span>
                            <a target="_blank"   href="<?php echo url('user/index/home',array('id'=>$reply['rinfo']['id'])); ?>">
                                <?php echo $reply['rinfo']['username']; ?></a>&nbsp;回复&nbsp;<a target="_blank" href="<?php echo url('user/index/home',array('id'=>$reply['pinfo']['id'])); ?>">
                            <?php echo $reply['pinfo']['username']; ?></a></span><span><?php echo friendlyDate($reply['time']); ?></span>

                        </div>
                        <div class="comment-con">
                        <span><?php echo clearHTMLhead($reply['content']); ?>
                        </span>
                        </div>
                        <div class="comment-op">
                            <span <?php   if(in_array($reply['id'],$iszans))echo 'style="color:red"'; ?> data-id="<?php echo $reply['id']; ?>" type="zan">
                              <i class="iconfont">&#xe611;</i>&nbsp;<span><?php echo $reply['praise']; ?></span>
                             </span>

                            <span type="reply"  data-id="<?php echo $reply['id']; ?>"  data-name="<?php echo $reply['rinfo']['username']; ?>"><i class="iconfont  ">&#xe644;</i>&nbsp;回复</span>
                        <?php if($reply['rinfo']['id'] == session('userid')): ?>
                        <div class=" comm-edit">
                            <span type="edit"><a style="color:#999" href="<?php echo url('comment/edit',array('id'=>$vo['id'])); ?>" target="_blank">编辑</a></span>
                        </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
      <div class="fly-panel detail-box">
        <a name="comment"></a>
		<div id="pinglun" class="layui-form layui-form-pane">
          <form>
            <div class="layui-form-item layui-form-text">
              <div class="layui-input-block"  id="reply">
              <span id="huifu"></span>
                 <textarea id="textarea" name="content" style="height:150px;width: 100%;"  ></textarea>
              <input type="hidden" name="tid" value="0" id="tid" />
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn" lay-submit="" lay-filter="comment_add" style="background-color: rgb(23,179,241); border-radius: 5px">提交评论</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<div class="edge">
    <div class="fly-panel leifeng-rank"> 
      <h3 class="fly-panel-title">近一月发帖榜 - TOP 12</h3>
      <dl>
      
       <?php if(is_array($tptm) || $tptm instanceof \think\Collection || $tptm instanceof \think\Paginator): $i = 0; $__LIST__ = $tptm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <dd>
          <a href="<?php echo url('user/index/home',array('id'=>$vo['id'])); ?>">
            <img src="<?php echo getheadurl($vo['userhead']); ?>">
            <cite><?php echo $vo['username']; ?></cite>
            <i><?php echo $vo['forumnum']; ?>帖子</i>
          </a>
        </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </dl>
    </div>
    	<div class="fly-panel fly-link leifeng-rank" style="padding-bottom: 0;"> 
      <h3 class="fly-panel-title">版块列表</h3>
      <ul>
	    <?php if(is_array($tpto) || $tpto instanceof \think\Collection || $tpto instanceof \think\Paginator): $i = 0; $__LIST__ = $tpto;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li><a href="<?php echo url('bbs/index/view',array('id'=>$vo['id'])); ?>"><?php echo $vo['name']; ?>(<?php echo $vo['count']; ?>)</a></li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">最近热帖</dt>
       <?php if(is_array($tptf) || $tptf instanceof \think\Collection || $tptf instanceof \think\Paginator): $i = 0; $__LIST__ = $tptf;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <dd>
        <a href="<?php echo url('bbs/index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
        <span><i class="iconfont" style="color: rgb(255,165,0)"> &#xe6a5;</i> <?php echo $vo['view']; ?></span>
      </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </dl>
    
    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">精选帖子</dt>
      <?php if(is_array($tpte) || $tpte instanceof \think\Collection || $tpte instanceof \think\Paginator): $i = 0; $__LIST__ = $tpte;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <dd>
        <a href="<?php echo url('index/thread',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
        <span><i class="iconfont">&#xe62c;</i> <?php echo $vo['view']; ?></span>
      </dd>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </dl>

  </div>
</div>

<?php if(session('userid') > 0): ?>
        <a href="<?php echo url('forum/add'); ?>" class="site-tree-mobile-edit layui-hide">
    <i class="iconfont icon-fabu"></i>
  </a>
  <?php endif; ?>
</div>

				
<div class="footer">
    <div class="content-index clearfix">
        <div class="footnav">
            <ul>
                <?php if(is_array($footnav) || $footnav instanceof \think\Collection || $footnav instanceof \think\Paginator): $i = 0; $__LIST__ = $footnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><?php echo $vo['name']; ?></a>
                    <ul>
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>
        <span>
            <?php if($site_config['site_icp'] != ''): ?>
            ICP备案号:<?php echo $site_config['site_icp']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_copyright'] != ''): ?>
            版权信息:<?php echo $site_config['site_copyright']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_tongji'] != ''): ?>
            <?php echo $site_config['site_tongji']; endif; ?>

        </span>


    </div>
</div>    
 

<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

<script type="text/javascript" src="/kyw/public//plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/kyw/public//js/iconfont.js"></script>

<script src="/kyw/public//js/common.js"></script>
<script type="text/javascript">
     futext('#textarea');
    
</script>
<script>

layui.use('form', function(){
  var form = layui.form
  ,jq = layui.jquery;
  jq('span[type=zan]').click(function(){
var idnum=jq(this).data('id');
var obj=jq(this);
jq.post('<?php echo url("comment/zan"); ?>',{'id':idnum},function(data){
    if(data.code == 200){
    	 jq(obj).css('color','red');
   	  var intnum=parseInt(jq(obj).find('span').html());
   	  jq(obj).find('span').html(intnum+1);
      layer.msg(data.msg, {icon: 1, time: 1000}, function(){
    	 
      });
    }else{
     
      layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
    }
  });

	  });
  jq('span[type=reply]').click(function(){
      jq("html,body").animate({scrollTop:jq ("#reply").offset().top},1000);
	  var idnum=jq(this).data('id');
	 var htmlname='@'+ jq(this).attr('data-name');
	   jq('#tid').val(idnum);
	   jq('#huifu').html('<i style="color:#F7B824">'+htmlname+'</i>');

 });
    jq('.res-download').click(function () {
        var isd=jq('#isdownload').val();
        if (isd==1||isd=='1'){
            layer.confirm('此资源下载过了，可以直接下载！', {
                btn: ['确定','取消'] //按钮
            }, function(){
                var downloadEle=document.createElement('a');
                downloadEle.setAttribute('href','/kyw<?php echo $file['savepath']; ?>' );
                downloadEle.setAttribute('download','<?php echo $file['name']; ?>'+"_"+Date.now()+"_"+getRandom()+".<?php echo $file['ext']; ?>" );
                downloadEle.click();
                layer.closeAll()
            }, function(){
                layer.closeAll()
            });
        } else{
            layer.confirm('下载此资源需要消耗<?php echo $point_download; ?>积分，确定下载?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                ajaxform({'point':'<?php echo $point_download; ?>'}," <?php echo url('bbs/index/download',['id'=>$t['id']]); ?> ",jq,function (res) {
                    var downloadEle=document.createElement('a');
                    downloadEle.setAttribute('href','/kyw<?php echo $file['savepath']; ?>' );
                    downloadEle.setAttribute('download','<?php echo $file['name']; ?>'+"_"+Date.now()+"_"+getRandom()+".<?php echo $file['ext']; ?>" );
                    downloadEle.click();
                    layer.closeAll()
                });
            }, function(){
                layer.closeAll()
            });
        }

    })

  form.on('submit(comment_add)', function(data){
      var activeEditor = tinymce.activeEditor;
      var editBody = activeEditor.getBody();
      activeEditor.selection.select(editBody);
      var text = activeEditor.selection.getContent({'format': 'text'});
      if (text.trim()==''){
          layer.msg('请输入必填项！', {icon: 2, time: 1000});
          return false;
      }

    loading = layer.load(2, {
      shade: [0.2,'#000']
    });
    var param = {
        'data': JSON.stringify({
            'content': tinyMCE.activeEditor.getContent()
            , 'tid': jq('input[name=tid]').val()

        })
  }
    jq.post('<?php echo url("comment/add",array("id"=>$t['id'])); ?>',param,function(data){
      if(data.code == 200){
        layer.close(loading);
        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
          location.reload();
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
<script>
    console.log('%c 考研网','color:#1BC7F1;font-size:30px;font-weight: bold ');


</script>