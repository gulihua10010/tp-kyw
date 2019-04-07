<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"E:\phpStudy\WWW\kyw/application/index\view\index_home.html";i:1546876026;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1547374844;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1547275694;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1547187444;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title><?php echo $m['username']; ?>的主页|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>


<meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
<meta name="description" content="<?php echo $site_config['seo_description']; ?>">

    <link rel="shortcut icon" href="/kyw/public//images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public//plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public//css/globals.css">

    
<script src="/kyw/public//plugins/layui/layui.js"></script>
<script src="/kyw/public//js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div class="header">
    <div class="header-top">
        <div class="content-index clearfix">
            <div class="fl">
                <a href="http://<?php echo $web_url; ?>/admin.php" target="_blank" style="color: white;line-height: 30px">后台登录</a>
            </div>
            <div class="fr header-top-right">
                <a href="javascript:void(0);" onclick="showLogin();">登录</a>
                <a href="javascript:void(0);" onclick="showRegister();">注册</a>
            </div>
        </div>
    </div>
    <div class="header-bootom content-index clearfix">
        <div class="fl">
            <?php if($site_config['logo'] != ''): ?>
            <img src="/kyw<?php echo $site_config['logo']; ?>" class="logo fl">
            <?php endif; ?>
        </div>
        <div class="fr">
            <div class="search-box fl">
                <div class="select-list search-select fl">
                    <span id="commonSearch">课程</span>
                    <ul class="sub-ul" id="commonSearchType">
                        <li><a href="javascript:void(0);" >课程</a></li>
                        <li><a href="javascript:void(0);"  >资料</a></li>
                    </ul>
                </div>
                <div class="fl search-input-box">
                    <input type="text" name="commonSearchInput" id="commonSearchInput" placeholder="学院信息" class="search-input fl">
                </div>
                <input type="button" name="" id="" value="" class="search-ic fl">
            </div>
        </div>
    </div>
</div>

<div class="main layui-clear">

<?php if($m['photowall'] != ''): ?>
<style>
    .photowall-info {
        z-index: 1;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        box-sizing: border-box;
        width: 100%;
        height: 136px;
        position: relative;
        top: 22px;
        /* Safari for macOS & iOS */
        -webkit-backdrop-filter: blur(5px);
        /* Google Chrome */
        backdrop-filter: blur(5px);
        padding: 0;
    }

    .photowall-info::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0px;
        bottom: 0px;
        top: 0;
        z-index: -1;
        /*-1 可以当背景*/
        -webkit-filter: blur(20px);
        filter: blur(20px);
        margin: -30px; /*消除边缘透明*/
        background: url(<?php echo getheadurl($m['photowall']); ?>) center bottom;
        background-size: cover;
        /*平铺*/
        background-attachment: fixed;
    }

    .photowall-info h1, .photowall-info p, .photowall-info span, .photowall-info i {
        color: white;
    }
    .home-zan{
        position: absolute;
        right: 30px;
        top:50px;
        background:rgba(255,255,255,0.5);
        padding: 8px;
        border-radius: 6px;
        cursor: pointer;
    }
    .zanok i,.zanok em{
        color: red;
    }
</style>
<?php else: ?>
    <style>
        .fly-home{
            background-color: rgba(250,250,250,1);
        }
    .photowall-info {
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
    box-sizing: border-box;
    width: 100%;
    height: 136px;
    position: relative;
    background-color: rgba(0,0,0,0.3);
    top: 22px;
    /* Safari for macOS & iOS */
    padding: 0;
    }

    .photowall-info h1, .photowall-info p, .photowall-info span, .photowall-info i {
    color: white;
    }
    .home-zan{
    position: absolute;
    right: 30px;
    top:50px;
    background:rgba(255,255,255,0.5);
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
    }
    .zanok i,.zanok em{
    color: red;
    }
    </style>
<?php endif; ?>
<div class="fly-home" <?php if($m['photowall'] != ''): ?>
     style="background:url(<?php echo getheadurl($m['photowall']); ?>) no-repeat ;background-size: cover;  " <?php endif; ?>>
<img src="<?php echo getheadurl($m['userhead']); ?>" alt="<?php echo $m['username']; ?>">
    <div class="photowall-info">
        <h1>
            <?php echo $m['username']; if($m['sex'] == 1): ?> <i class="iconfont " style="color: #25a3dd;">&#xe648;</i><?php else: ?> <i
                class="iconfont" style="color: #da88f9">&#xe606;</i><?php endif; ?>
        </h1>
        <p class="fly-home-info">
            <i class="iconfont " title="积分">&#xe687;</i><span style="color: #FF7200;"><?php echo $m['point']; ?></span>
            <i class="iconfont ">&#xe60d;</i><span><?php echo friendlyDate($m['regtime']); ?> 加入</span>
            <i class="iconfont">&#xe61a;</i><span><?php if($m['userhome'] != ''): ?><?php echo $m['userhome']; else: ?>中国<?php endif; ?></span>
        </p>
        <p class="fly-home-sign"><?php if($m['description'] != ''): ?>（<?php echo $m['description']; ?>）<?php else: ?>（这个人懒得留下签名）<?php endif; ?></p>
        <span class="home-zan <?php if($iszan == 1): ?>zanok<?php endif; ?>" data-id="<?php echo $m['id']; ?>" type="zan"><i class="iconfont"><?php if($iszan == 1): ?>&#xe611;<?php else: ?>&#xe605;<?php endif; ?></i>&nbsp;<em><?php echo $m['zan']; ?></em> </span>
    </div>
</div>
<div class="main fly-home-main">
    <div class="layui-inline fly-home-jie">
        <div class="fly-panel">
            <h3 class="fly-panel-title"><?php echo $m['username']; ?> 最近的帖子</h3>
            <ul class="jie-row">
                <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <a href="<?php echo url('bbs/index/thread',array('id'=>$vo['id'])); ?>" class="jie-title"><?php echo $vo['title']; ?></a>
                    <i></i>
                    <em><?php echo friendlyDate($vo['time']); ?></em>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <div class="layui-inline fly-home-da">
        <div class="fly-panel">
            <h3 class="fly-panel-title"><?php echo $m['username']; ?> 最近的评论</h3>
            <ul class="home-jieda">
                <?php if(is_array($tpte) || $tpte instanceof \think\Collection || $tpte instanceof \think\Paginator): $i = 0; $__LIST__ = $tpte;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <p>
                        <span><?php echo friendlyDate($vo['time']); ?></span>
                        在<a href="<?php echo url('bbs/index/thread',array('id'=>$vo['fid'])); ?>"><?php echo $vo['title']; ?></a>中回复：
                    </p>
                    <div class="home-dacontent">
                        <?php echo msubstr(clearcontent($vo['content']),0,50); ?>...

                    </div>

                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
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
    <div class="content-index clearfix">

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
</div>    
 
<script src="/kyw/public//js/home.js"></script>


<!--页面JS脚本-->

<script>

    layui.use(['form',   'element'],function() {

        var form = layui.form
            , element = layui.element
            , jq = layui.jquery;
        jq('span[type=zan]').click(function(){
            var idnum=jq(this).data('id');
            var obj=jq(this);
            jq.post('<?php echo url("index/user/zan"); ?>',{'id':idnum},function(data){
                if(data.code == 200){
                    jq(obj).addClass('zanok');
                    var intnum=parseInt(jq(obj).find('em').html());
                    jq(obj).find('em').html(intnum+1);
                    jq(obj).find('i').html('&#xe611;');
                    layer.msg(data.msg, {icon: 1, time: 1000}, function(){

                    });
                }else{

                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
                }
            });



        });


    });
</script>



</body>
</html>