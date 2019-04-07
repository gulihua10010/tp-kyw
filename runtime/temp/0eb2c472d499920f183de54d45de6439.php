<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"E:\phpStudy\WWW\kyw/application/user\view\index_home.html";i:1549333228;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1549256860;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1549177024;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548923454;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title><?php echo $m['username']; ?>的主页|<?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>


<meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
<meta name="description" content="<?php echo $site_config['seo_description']; ?>">

    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
  <link rel="stylesheet" href="/kyw/public/css/bbs.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">

    
<script src="/kyw/public/plugins/layui/layui.js"></script>
    <script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
    <script src="/kyw/public/js/common.js"></script>
    <script type='text/javascript' src='/kyw/public/js/webim.config.js'></script>
    <script type='text/javascript' src='/kyw/public/js/strophe-1.2.8.min.js'></script>
    <script type='text/javascript' src='/kyw/public/js/websdk-1.4.13.js'></script>
</head>
<body data-token="<?php echo \think\Session::get('username'); ?>" data-rykey="<?php echo \think\Session::get('srkey'); ?>">
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
            <a data-url="<?php echo url('user/index/logout'); ?>"   location-url="javascript:location.reload()"  href="javascript:void(0)" class="logi_logout"  style="color:#fff;">
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
        .home-zan:hover,    .chat:hover{
            background:rgba(255,255,255,0.6);
        }
    .zanok i,.zanok em{
    color: red;
    }
        .chat{
            border: 1px #999 solid;
            position: absolute;
            right: 120px;
            top:55px;
            padding:3px 15px;
            border-radius: 10px;
            background:rgba(255,255,255,0.5);
            cursor: pointer;

        }
    </style>
<?php endif; ?>
<div class="fly-home" <?php if($m['photowall'] != ''): ?>
     style="background:url(<?php echo getheadurl($m['photowall']); ?>) no-repeat ;background-size: cover;  " <?php endif; ?>>
<img src="/kyw<?php echo $m['userhead']; ?>" alt="<?php echo $m['username']; ?>">
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
        <span class="chat">私聊</span>
        <span class="home-zan <?php if($iszan == 1): ?>zanok<?php endif; ?>" data-id="<?php echo $m['id']; ?>" type="zan"><i class="iconfont"><?php if($iszan == 1): ?>&#xe611;<?php else: ?>&#xe605;<?php endif; ?></i>&nbsp;<em><?php echo $m['zan']; ?></em> </span>
    </div>
</div>
<div class="main fly-home-main">
    <div class="layui-inline fly-home-jie">
        <div class="fly-panel">
            <h3 class="fly-panel-title"><?php echo $m['username']; ?> 最近的帖子
                <a  href="<?php echo url('user/index/myforum',array('uid'=>$m['id'])); ?>" target="_blank"  class="fr cb">查看全部</a></h3>
            <ul class="jie-row">
                <?php if(is_array($tptc) || $tptc instanceof \think\Collection || $tptc instanceof \think\Paginator): $i = 0; $__LIST__ = $tptc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <a href="<?php echo url('bbs/index/thread',array('id'=>$vo['id'])); ?>"  target="_blank" class="jie-title"><?php echo $vo['title']; ?></a>
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
                        在<a href="<?php echo url('bbs/index/thread',array('id'=>$vo['fid'])); ?>" target="_blank"><?php echo $vo['title']; ?></a>中回复：
                    </p>
                    <div class="home-dacontent">
                        <?php echo msubstr(clearcontent($vo['content']),0,50); ?>...

                    </div>

                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
     <div class="layui-inline fly-home-jie" style="margin-top: 20px">
    <div class="fly-panel">
        <h3 class="fly-panel-title"><?php echo $m['username']; ?> 最近学习过的课程
            <a  href="<?php echo url('user/index/mycourse',array('uid'=>$m['id'])); ?>" target="_blank"  class="fr cb">查看全部</a></h3>
        <ul class="jie-row">
            <?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
               在 <a href="<?php echo url('index/course/detail',array('id'=>$vo['cid'])); ?>" target="_blank"  class="jie-title cb"  ><?php echo $vo['cname']; ?></a>课程中的
                <a   class="jie-title"  style="color: #1bc7f1" href="<?php echo url('index/course/showvideo',array('vid'=>$vo['vid'],'cid'=>$vo['cid'])); ?>" ><?php echo $vo['vname']; ?></a>视频
                <i></i>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
    <div class="layui-inline fly-home-da fr"  style="margin-top: 20px">
        <div class="fly-panel">
            <h3 class="fly-panel-title"><?php echo $m['username']; ?>记的笔记
                <a  href="<?php echo url('user/index/mynote',array('uid'=>$m['id'])); ?>" target="_blank"  class="fr cb">查看全部</a></h3>
            <ul class="home-jieda">
                <?php if(is_array($note) || $note instanceof \think\Collection || $note instanceof \think\Paginator): $i = 0; $__LIST__ = $note;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <p>
                        <span><?php echo friendlyDate($vo['time']); ?></span>
                        在<a href="<?php echo url('index/course/detail',array('id'=>$vo['cid'])); ?>" target="_blank"><?php echo $vo['cname']; ?></a>中的
                        <a   class="jie-title"  style="color: #1bc7f1"    target="_blank" href="<?php echo url('index/course/showvideo',array('vid'=>$vo['vid'],'cid'=>$vo['cid'])); ?>" ><?php echo $vo['vname']; ?></a>视频
                    </p>
                    <div class="home-dacontent">
                        <?php echo isCoverImg($vo['content']); ?><?php echo msubstr(clearcontent($vo['content']),0,50); ?>..
                        <a target="_blank" href="<?php echo url('index/course/notedetail',array('nid'=>$vo['id'])); ?>"  target="_blank" class="fr" >查看详情</a>
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


<script type="text/javascript" src="/kyw/public//js/date.format.js"></script>


<!--页面JS脚本-->

<script>

    layui.use(['layim', 'jquery'], function (layim, socket) {

        var jq = layui.jquery;
        var form = layui.form ;
        var layim = layui.layim;
        var cachedata =  layui.layim.cache();

        var user=$('body').data('token');
        var rykey = $('body').data('rykey');
        layim.config({
            //初始化接口
            init: {
                //配置客户信息
                mine:{
                    //我的信息
                    // "mine": {

                    "username": "<?php echo \think\Session::get('username'); ?>" //我的昵称
                    ,"id": "<?php echo \think\Session::get('userid'); ?>" //我的ID
                    ,"status": "online" //在线状态 online：在线、hide：隐身
                    ,"remark": "<?php echo $site_config['site_title']; ?>" //我的签名
                        // "username": "<?php echo \think\Session::get('username'); ?>" //我的昵称
                        // , "id": "<?php echo \think\Session::get('username'); ?>" //我的ID
                        // , "status": "online" //在线状态 online：在线、hide：隐身
                        // , "sign": "<?php echo $site_config['site_title']; ?>" //我的签名
                        , "avatar":  "/kyw<?php echo \think\Session::get('userhead'); ?>"
                        // $Think.session.userid]
                    // }
                }
            }
            //开启客服模式
            ,brief: true

            //,title: 'WebIM' //自定义主面板最小化时的标题
            //,right: '100px' //主面板相对浏览器右侧距离
            //,minRight: '90px' //聊天面板最小化时相对浏览器右侧距离
            ,initSkin: '3.jpg' //1-5 设置初始背景
            //,skin: ['aaa.jpg'] //新增皮肤
            //,isfriend: false //是否开启好友
            //,isgroup: false //是否开启群组
            //,min: true //是否始终最小化主面板，默认false
            ,notice: true //是否开启桌面消息提醒，默认false
            ,voice: false //声音提醒，默认开启，声音文件为：default.mp3
            ,getChatLog:{
                url:'<?php echo Url("user/index/getChatLog"); ?>'
                , type: 'get' //默认post
            }
            , chatLog: layui.cache.dir + 'css/modules/layim/html/chatlog.html' //聊天记录页面地址，若不开启，剔除该项即可


        });
        layim.on('sendMessage', function(data){
            data.to.cmd = 0;
            var To = data.to;
            var id = conn.getUniqueId();
            var content = data.mine.content;
            var msg = new WebIM.message('txt', id);    // 创建文本消息

            msg.set({
                msg: data.mine.content,
                to: data.to.name,                        // 接收消息对象（用户id）
                roomType: false,
                success: function (id, serverMsgId) {
                    // console.log(data.to.name   )//发送成功则记录信息到服务器
                    // console.log(serverMsgId)//发送成功则记录信息到服务器
                    var sendData = {to:data.to.id,content:data.mine.content,sendTime: data.mine.timestamp,type:data.to.type};

                    // if (data.to.cmd && (data.to.cmd.cmdName == 'leaveGroup' || data.to.cmd.cmdName == 'joinGroup')) {
                    //     sendData.sysLog = true;
                    // }
                    jq.ajax({
                        data: sendData,
                        type: 'post',
                        async: true,
                        dataType: 'json',
                        url: '<?php echo Url("user/index/addChatLog"); ?>',

                        success: function (data) {
                            if (data.code == 0) {
                                console.log('message record fail');
                            }
                        }, error: function (res) {
                            layer.close(loading);
                            layer.msg('未知错误', {icon: 2, time: 1000});

                        }


                    })


                },
                fail: function(e){              //发送失败移除发送消息并提示发送失败
                    im.popMsg(data,'发送失败 刷新页面试试！');
                }
            });
            if (data.to.id == data.mine.id) {
                layer.msg('不能给自己发送消息');
                return;
            }
            if (data.to.cmd) {
                msg.body.ext.cmd = data.to.cmd;
            }
            msg.body.ext.username = cachedata.mine.username;
            if (data.to.type == 'group') {
                msg.setGroup('groupchat');
                msg.body.chatType = 'chatRoom';
            }else{
                msg.body.chatType = 'singleChat';
            }
            conn.send(msg.body);


        });
        jq('.chat').click(function () {
            if (user==''||rykey==''){
                layer.msg("清先登录！", {icon: 2, anim: 6, time: 1000});
            }else{
                layim.chat({
                    name: '<?php echo $m['username']; ?>'
                    ,type: 'friend'
                    ,avatar: '/kyw<?php echo $m['userhead']; ?>'
                    ,id: '<?php echo $m['id']; ?>'
                });
            }


        })


        jq('span[type=zan]').click(function(){
            var idnum=jq(this).data('id');
            var obj=jq(this);
            jq.post('<?php echo url("user/index/zan"); ?>',{'id':idnum},function(data){
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
        // console.log(new Date().toLocaleString())
        function getmsg(username,userhead,userid,content,fromid,time){


        layim.getMessage({
            username:username //消息来源用户名
            ,avatar: userhead//消息来源用户头像
            ,id: userid //消息的来源ID（如果是私聊，则是用户id，如果是群聊，则是群组id）
            ,type: "friend" //聊天窗口来源类型，从发送消息传递的to里面获取
            ,content:content //消息内容
            ,cid: 0 //消息id，可不传。除非你要对消息进行一些操作（如撤回）
            ,mine: false //是否我发送的消息，如果为true，则会显示在右方
            ,fromid:userid //消息的发送者id（比如群组中的某个消息发送者），可用于自动解决浏览器多窗口时的一些问题
            ,timestamp: time //服务端时间戳毫秒数。注意：如果你返回的是标准的 unix 时间戳，记得要 *1000
        });
    }
        var conn = new WebIM.connection({
            isMultiLoginSessions: WebIM.config.isMultiLoginSessions,
            https: typeof WebIM.config.https === 'boolean' ? WebIM.config.https : location.protocol === 'https:',
            url: WebIM.config.xmppURL,
            heartBeatWait: WebIM.config.heartBeatWait,
            autoReconnectNumMax: WebIM.config.autoReconnectNumMax,
            autoReconnectInterval: WebIM.config.autoReconnectInterval,
            apiUrl: WebIM.config.apiURL,
            isAutoLogin: true
        });
        var user=jq('body').data('token').trim();
        var rykey = jq('body').data('rykey').trim();
        var options = {
            apiUrl: WebIM.config.apiURL,
            user: user,
            pwd: rykey,
            appKey: WebIM.config.appkey
        };
        if (user!=""&&rykey!="") {

        conn.open(options);
        conn.listen({
            onOpened: function ( message ) {},      //连接成功回调
            onClosed: function ( message ) {},         //连接关闭回调
            onTextMessage: function ( message ) {           //收到文本消息
                console.log(message);
                console.log('收到'+message.from+'发送的消息：'+message.data);
                // detailMessage(message.data,message.from,'text',message.id,'');
                // showMessage();
                jq.get('<?php echo Url("user/index/getuserinfo"); ?>?uname='+message.from,function (res) {
                    if (res.code==200){
                        var datetime = new Date().getTime();
                        getmsg(message.from,'/kyw'+res.data.userhead,res.data.id,message.data,res.data.id,datetime)

                    }
                })

            },
            onEmojiMessage: function ( message ) {                              //收到表情消息
                console.log('收到'+message.from+'发送的Emoji'+':'+message.data);
                //缓存数据
                for(var i=0;i<message.data.length;i++){
                    var img = message.data[i];
                    var string;
                    if (img.type=='txt') {string = string+img.data;}
                    else{string = string+'<img class="emoji" '+'src="'+img.data +'">';}
                }
                string = string.replace('undefined','');
                console.log(string);
                detailMessage(string,message.from,'text',message.id,'');
                showMessage();
            },
            onPictureMessage: function ( message ) {            //收到图片消息
                console.log(message);
                console.log('收到'+message.from+'发送的图片'+':'+message.url);
                detailMessage(message.url,message.from,'picture',message.id,'');
                showMessage();
            },
            onCmdMessage: function ( message ) {},           //收到命令消息
            onAudioMessage: function ( message ) {},             //收到音频消息
            onLocationMessage: function ( message ) {},         //收到位置消息
            onFileMessage: function ( message ) {                   //收到文件消息
                console.log(message);
                console.log('收到'+message.from+'发送的文件'+':'+message.url);
                detailMessage(message.url,message.from,'file',message.id,message.filename);
                showMessage();
            },
            onVideoMessage: function (message) {
                var node = document.getElementById('privateVideo');
                var option = {
                    url: message.url,
                    headers: {
                        'Accept': 'audio/mp4'
                    },
                    onFileDownloadComplete: function (response) {
                        var objectURL = WebIM.utils.parseDownloadResponse.call(conn, response);
                        node.src = objectURL;
                    },
                    onFileDownloadError: function () {
                        console.log('File down load error.')
                    }
                };
                WebIM.utils.download.call(conn, option);
            },   //收到视频消息
            onPresence: function ( message ) {},       //处理“广播”或“发布-订阅”消息，如联系人订阅请求、处理群组、聊天室被踢解散等消息
            onRoster: function ( message ) {},         //处理好友申请
            onInviteMessage: function ( message ) {},  //处理群组邀请
            onOnline: function () {},                  //本机网络连接成功
            onOffline: function () {},                 //本机网络掉线
            onError: function ( message ) {},          //失败回调
            onBlacklistUpdate: function (list) {       //黑名单变动
                // 查询黑名单，将好友拉黑，将好友从黑名单移除都会回调这个函数，list则是黑名单现有的所有好友信息
                console.log(list);
            },
            onReceivedMessage: function(message){},    //收到消息送达客户端回执
            onDeliveredMessage: function(message){},   //收到消息送达服务器回执
            onReadMessage: function(message){},        //收到消息已读回执
            onCreateGroup: function(message){},        //创建群组成功回执（需调用createGroupNew）
            onMutedMessage: function(message){}        //如果用户在A群组被禁言，在A群发消息会走这个回调并且消息不会传递给群其它成员
        });
        }
//         var cache =  layui.layim.cache();
//         var local = layui.data('layim')[cache.mine.id]; //获取当前用户本地数据
//         delete local.chatlog;
//
// //向localStorage同步数据
//         layui.data('layim', {
//             key: cache.mine.id
//             ,value: local
//         });
//         console.log(parent.layui.layim.cache().mine.id)

    });
</script>



<script>


</script>
</body>
</html>