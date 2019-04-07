<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"E:\phpStudy\WWW\kyw/application/user\view\index_message.html";i:1548594930;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1548817152;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1548836794;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548815724;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>用户设置|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>
  
  
  <meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
  <meta name="description" content="<?php echo $site_config['seo_description']; ?>">
      
    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">

    
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
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
            <a data-url="<?php echo url('user/index/logout'); ?>"    href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
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


<div class="main layui-clear  ">

<style >
    .user-set{
        background-color: rgb(251,251,251)!important;
    }
    .user-set li a{
        color: #0C0C0C !important;
    }
    .tab-this a{
        background-color: rgb(23,179,241 ) !important;;
    }
    .tab-this a>i{
        color: white !important;
    }
    .user-set li a:hover{
        background-color: rgba(23,179,241 ,0.7) !important;;
    }

    .panel-user{
        padding: 0 20px!important;
    }
    ul,li{
        list-style: none;
    }
    .ask-btns{
        display: block;
        margin-left: 570px;
        width: 250px;
    }
    blockquote+p{
        padding: 10px  auto;
        margin: 5px auto;
        display: block;
        height: 50px;
    }

</style>
<div class="fly-user-main">
    <ul class="layui-nav layui-nav-tree layui-inline user-set"  lay-filter="user"  >
        <li class="layui-nav-item">
            <a href="<?php echo url('index/home',array('id'=>$uid)); ?>">
                &nbsp;<i class="iconfont">&#xe609;</i>
                我的主页
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('index/topic'); ?>">
                &nbsp;<i class=" iconfont">&#xe62d;</i>
                我的帖子
            </a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('index/comment'); ?>">
                &nbsp;<i class="iconfont">&#xe644;</i>
                我的回复
            </a>
        </li>
        <li class="layui-nav-item  tab-this">
            <a href="<?php echo url('index/message'); ?> " style="color: white !important;">
                &nbsp;<i class="iconfont">&#xe61b;</i>
                我的通知
            </a>
        </li>
        <li class="layui-nav-item  " >
            <a href="<?php echo url('index/set'); ?>"  >
               &nbsp;<i class="iconfont">&#xe65f;</i>
                基本设置
            </a>
        </li>

    </ul>
    <script>

layui.use(['jquery'],function(){
  var jq = layui.jquery;
var n=1;
  jq('.site-tree-mobile').click(function(){
	  
	  if( n==2){
		  jq('.layui-nav').animate({left: '-300px'}, "fast");
		 jq(this).find('.layui-icon').html('&#xe602;');
		  n=1;
	  }else{
		  n=2;
		  jq('.layui-nav').animate({left: '0px'}, "fast");
		  jq(this).find('.layui-icon').html('&#xe603;');
	  }
	 

	  
  });
})
  </script>
  <div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
  </div>
  <div class="site-mobile-shade"></div>

  <div class="fly-panel fly-panel-user  panel-user"  >
	  <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
	   
	    <button class="layui-btn layui-btn-danger" id="LAY_delallmsg"  data-url="<?php echo url('index/delallmessage'); ?>" >清空全部消息</button>
	  
	    <div  id="LAY_minemsg" style="margin-top: 10px;">
       
       
       <?php if(empty($tptc) || (($tptc instanceof \think\Collection || $tptc instanceof \think\Paginator ) && $tptc->isEmpty())): ?>
        <div class="fly-none">您暂时没有最新消息</div>
       <?php else: ?>
               <ul class="mine-msg">
          
          
          
           <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type'] == 1): ?>
          <li class="messagelist">
            <blockquote class="layui-elem-quote">
              <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><cite><?php echo $vo['username']; ?></cite></a>回复了您的帖子<a target="_blank" href="<?php echo url('bbs/index/thread',array('id'=>$vo['content'])); ?>"><cite><?php echo getforumbyid($vo['content']); ?></cite></a>
            </blockquote>
            <p><span><?php echo friendlyDate($vo['time']); ?></span><a href="javascript:;" data-url="<?php echo url('index/delmessage',array('id'=>$vo['id'])); ?>" class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
            <?php elseif($vo['type'] == 2): ?>
            <li class="messagelist">
            <blockquote class="layui-elem-quote">
              <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><cite><?php echo $vo['username']; ?></cite></a>回复了帖子<a target="_blank" href="<?php echo url('bbs/index/thread',array('id'=>$vo['content'])); ?>"><cite><?php echo getforumbyid($vo['content']); ?></cite></a>中你的评论
            </blockquote>
            <p><span><?php echo friendlyDate($vo['time']); ?></span>
                <a href="javascript:;" data-url="<?php echo url('index/delmessage',array('id'=>$vo['id'])); ?>"
                   class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
        <?php elseif($vo['type'] == 3): ?>
         <li class="messagelist">
            <blockquote class="layui-elem-quote">
                <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><cite><?php echo $vo['username']; ?></cite></a>回答了您的提问<a target="_blank" href="<?php echo url('index/course/qadetail',array('aid'=>$vo['content'])); ?>"><cite><?php echo getaskbyid($vo['content']); ?></cite></a>
               </blockquote>
              <p><span><?php echo friendlyDate($vo['time']); ?>  </span>
                  <a href="javascript:;" data-url="<?php echo url('index/delmessage',array('id'=>$vo['id'])); ?>" class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a>
  </p>
         </li>
             <?php elseif($vo['type'] == 7): ?>
             <li class="messagelist">
                  <blockquote class="layui-elem-quote">
                        <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><cite><?php echo $vo['username']; ?></cite></a>回复了文章<a target="_blank" href="<?php echo url('index/article/detail',array('aid'=>$vo['content'])); ?>"><cite><?php echo getartbyid($vo['content']); ?></cite></a>
                  </blockquote>
                   <p><span><?php echo friendlyDate($vo['time']); ?>  </span>
                         <a href="javascript:;" data-url="<?php echo url('index/delmessage',array('id'=>$vo['id'])); ?>" class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a>
                    </p>
                   </li>
                   <?php elseif($vo['type'] == 8): ?>
                   <li class="messagelist">
                       <blockquote class="layui-elem-quote">
                           <a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><cite><?php echo $vo['username']; ?></cite></a>回复了资源<a target="_blank" href="<?php echo url('index/resource/detail',array('aid'=>$vo['content'])); ?>"><cite><?php echo getresbyid($vo['content']); ?></cite></a>
                       </blockquote>
                       <p><span><?php echo friendlyDate($vo['time']); ?>  </span>
                           <a href="javascript:;" data-url="<?php echo url('index/delmessage',array('id'=>$vo['id'])); ?>" class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a>
                       </p>
                   </li>
          <?php else: ?>
           <li class="messagelist">
            <blockquote class="layui-elem-quote">
              系统消息：<?php echo htmlspecialchars_decode($vo['content']); ?>
            </blockquote>
            <p><span><?php echo friendlyDate($vo['time']); ?></span><a href="javascript:;"   data-url="<?php echo url('index/delsysmessage',array('id'=>$vo['id'])); ?>" class=" elementdel layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
           <?php endif; endforeach; endif; else: echo "" ;endif; ?>
          
          
        </ul>
        <div class="pages cl">
          
          <?php echo $tptc->render(); ?></div>
<?php endif; ?>
       
      </div>
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

<script>
layui.use(['layer','jquery','form'],function(){
  var layer = layui.layer
  , form = layui.form
  ,jq = layui.jquery;
  
  jq('#LAY_delallmsg').click(function(){
		var url=  jq(this).data('url');
		
	if(	jq('.messagelist').length>0){
		layer.confirm('你确定要删除所有消息吗?', {icon: 3, title:'删除提示'}, function(index){
			 loading = layer.load(2, {
			      shade: [0.2,'#000']
			    });
			    jq.getJSON(url,function(data){
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
		});
	}else{
		 layer.msg('您无任何消息可删除', {icon: 2, anim: 6, time: 1000});
	}
	  });

  jq('.elementdel').click(function(){
	  
	//  var id= jq(this).data('id');
	  var url= jq(this).data('url');

 
  //alert(locationurl);
 // alert(window.location.href);
  layer.confirm('你确定要删除该条消息吗?', {icon: 3, title:'删除提示'}, function(index){
		    loading = layer.load(2, {
			      shade: [0.2,'#000']
			    });
		   
			  
			    jq.getJSON(url,function(data){
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
		}); 

	  });
  });
  
  </script>

</body>
</html>