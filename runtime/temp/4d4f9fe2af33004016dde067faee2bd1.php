<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:57:"E:\phpStudy\WWW\kyw/application/user\view\index_test.html";i:1549252284;s:57:"E:\phpStudy\WWW\kyw\application\user\view\index_base.html";i:1549256860;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_header.html";i:1549177024;s:59:"E:\phpStudy\WWW\kyw\application\user\view\index_footer.html";i:1548923454;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title> </title>


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


<div class="site-demo-button">
    <button class="layui-btn site-demo-layim" data-type="chat">自定义会话</button>
    <button class="layui-btn site-demo-layim" data-type="message">接受好友的消息</button>
    <button class="layui-btn site-demo-layim" data-type="messageAudio">接受音频消息</button>
    <button class="layui-btn site-demo-layim" data-type="messageVideo">接受视频消息</button>
    <button class="layui-btn site-demo-layim" data-type="messageTemp">接受临时会话消息</button>

    <br>

    <button class="layui-btn site-demo-layim" data-type="add">申请好友</button>
    <button class="layui-btn site-demo-layim" data-type="addqun">申请加群</button>
    <button class="layui-btn site-demo-layim" data-type="addFriend">同意好友</button>
    <button class="layui-btn site-demo-layim" data-type="addGroup">增加群组到主面板</button>
    <button class="layui-btn site-demo-layim" data-type="removeFriend">删除主面板好友</button>
    <button class="layui-btn site-demo-layim" data-type="removeGroup">删除主面板群组</button>

    <br>
    <button class="layui-btn site-demo-layim" data-type="setGray">置灰离线好友</button>
    <button class="layui-btn site-demo-layim" data-type="unGray">取消好友置灰</button>
    <a href="http://layim.layui.com/kefu.html" class="layui-btn site-demo-layim" target="_blank">客服模式</a>
    <button class="layui-btn site-demo-layim" data-type="mobile">移动端版本</button>
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

<script>
    layui.use('layim', function(){
        var layim = layui.layim;

        //演示自动回复
        var autoReplay = [
            '您好，我现在有事不在，一会再和您联系。',
            '你没发错吧？face[微笑] ',
            '洗澡中，请勿打扰，偷窥请购票，个体四十，团体八折，订票电话：一般人我不告诉他！face[哈哈] ',
            '你好，我是主人的美女秘书，有什么事就跟我说吧，等他回来我会转告他的。face[心] face[心] face[心] ',
            'face[威武] face[威武] face[威武] face[威武] ',
            '<（@￣︶￣@）>',
            '你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复。',
            'face[黑线]  你慢慢说，别急……',
            '(*^__^*) face[嘻嘻] ，是贤心吗？'
        ];

        //基础配置
        layim.config({
            //初始化接口
            init: {
                url:  ''
                ,data: {}
            }


            ,uploadImage: {
                url: '' //（返回的数据格式见下文）
                ,type: '' //默认post
            }
            ,uploadFile: {
                url: '' //（返回的数据格式见下文）
                ,type: '' //默认post
            }

            ,isAudio: false //开启聊天工具栏音频
            ,isVideo: false //开启聊天工具栏视频



             ,brief: true //是否简约模式（若开启则不显示主面板）

            //,title: 'WebIM' //自定义主面板最小化时的标题
            //,right: '100px' //主面板相对浏览器右侧距离
            //,minRight: '90px' //聊天面板最小化时相对浏览器右侧距离
            ,initSkin: '3.jpg' //1-5 设置初始背景
            //,skin: ['aaa.jpg'] //新增皮肤
            //,isfriend: false //是否开启好友
            //,isgroup: false //是否开启群组
            //,min: true //是否始终最小化主面板，默认false
            //,notice: true //是否开启桌面消息提醒，默认false
            //,voice: false //声音提醒，默认开启，声音文件为：default.mp3


        });
         //监听在线状态的切换事件
        layim.on('online', function(status){
            layer.msg(status);
        });



        //监听layim建立就绪
        layim.on('ready', function(res){
            //console.log(res.mine);
            layim.msgbox(5); //模拟消息盒子有新消息，实际使用时，一般是动态获得
        });
        //监听发送消息
        layim.on('sendMessage', function(data){
            var To = data.to;
            //console.log(data);

            // if(To.type === 'friend'){
            //     layim.setChatStatus('<span style="color:#FF5722;">对方正在输入。。。</span>');
            // }


        });
        //监听查看群员
        layim.on('members', function(data){
            //console.log(data);
        });

        //监听聊天窗口的切换
        layim.on('chatChange', function(res){
            var type = res.data.type;
            console.log(res.data.id)
            if(type === 'friend'){
                //模拟标注好友状态
                //layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
            } else if(type === 'group'){
                //模拟系统消息
                layim.getMessage({
                    system: true
                    ,id: res.data.id
                    ,type: "group"
                    ,content: '模拟群员'+(Math.random()*100|0) + '加入群聊'
                });
            }
        });


        //面板外的操作
        var $ = layui.jquery, active = {
            chat: function(){
                //自定义会话
                layim.chat({
                    name: '小闲'
                    ,type: 'friend'
                    ,avatar: '//tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg'
                    ,id: 1008612
                });
            }
            ,message: function(){
                //制造好友消息
                layim.getMessage({
                    username: "贤心"
                    ,avatar: "//tp1.sinaimg.cn/1571889140/180/40030060651/1"
                    ,id: "100001"
                    ,type: "friend"
                    ,content: "嗨，你好！欢迎体验LayIM。演示标记："+ new Date().getTime()
                    ,timestamp: new Date().getTime()
                });
            }
            ,messageAudio: function(){
                //接受音频消息
                layim.getMessage({
                    username: "林心如"
                    ,avatar: "//tp3.sinaimg.cn/1223762662/180/5741707953/0"
                    ,id: "76543"
                    ,type: "friend"
                    ,content: "audio[http://gddx.sc.chinaz.com/Files/DownLoad/sound1/201510/6473.mp3]"
                    ,timestamp: new Date().getTime()
                });
            }
            ,messageVideo: function(){
                //接受视频消息
                layim.getMessage({
                    username: "林心如"
                    ,avatar: "//tp3.sinaimg.cn/1223762662/180/5741707953/0"
                    ,id: "76543"
                    ,type: "friend"
                    ,content: "video[http://www.w3school.com.cn//i/movie.ogg]"
                    ,timestamp: new Date().getTime()
                });
            }
            ,messageTemp: function(){
                //接受临时会话消息
                layim.getMessage({
                    username: "小酱"
                    ,avatar: "//tva1.sinaimg.cn/crop.7.0.736.736.50/bd986d61jw8f5x8bqtp00j20ku0kgabx.jpg"
                    ,id: "198909151014"
                    ,type: "friend"
                    ,content: "临时："+ new Date().getTime()
                });
            }
            ,add: function(){
                //实际使用时数据由动态获得
                layim.add({
                    type: 'friend'
                    ,username: '麻花疼'
                    ,avatar: '//tva1.sinaimg.cn/crop.0.0.720.720.180/005JKVuPjw8ers4osyzhaj30k00k075e.jpg'
                    ,submit: function(group, remark, index){
                        layer.msg('好友申请已发送，请等待对方确认', {
                            icon: 1
                            ,shade: 0.5
                        }, function(){
                            layer.close(index);
                        });

                        //通知对方
                        /*
                        $.post('/im-applyFriend/', {
                          uid: info.uid
                          ,from_group: group
                          ,remark: remark
                        }, function(res){
                          if(res.status != 0){
                            return layer.msg(res.msg);
                          }
                          layer.msg('好友申请已发送，请等待对方确认', {
                            icon: 1
                            ,shade: 0.5
                          }, function(){
                            layer.close(index);
                          });
                        });
                        */
                    }
                });
            }
            ,addqun: function(){
                layim.add({
                    type: 'group'
                    ,username: 'LayIM会员群'
                    ,avatar: '//tva2.sinaimg.cn/crop.0.0.180.180.50/6ddfa27bjw1e8qgp5bmzyj2050050aa8.jpg'
                    ,submit: function(group, remark, index){
                        layer.msg('申请已发送，请等待管理员确认', {
                            icon: 1
                            ,shade: 0.5
                        }, function(){
                            layer.close(index);
                        });

                        //通知对方
                        /*
                        $.post('/im-applyGroup/', {
                          uid: info.uid
                          ,from_group: group
                          ,remark: remark
                        }, function(res){

                        });
                        */
                    }
                });
            }
            ,addFriend: function(){
                var user = {
                    type: 'friend'
                    ,id: 1234560
                    ,username: '李彦宏' //好友昵称，若申请加群，参数为：groupname
                    ,avatar: '//tva4.sinaimg.cn/crop.0.0.996.996.180/8b2b4e23jw8f14vkwwrmjj20ro0rpjsq.jpg' //头像
                    ,sign: '全球最大的中文搜索引擎'
                }
                layim.setFriendGroup({
                    type: user.type
                    ,username: user.username
                    ,avatar: user.avatar
                    ,group: layim.cache().friend //获取好友列表数据
                    ,submit: function(group, index){
                        //一般在此执行Ajax和WS，以通知对方已经同意申请
                        //……

                        //同意后，将好友追加到主面板
                        layim.addList({
                            type: user.type
                            ,username: user.username
                            ,avatar: user.avatar
                            ,groupid: group //所在的分组id
                            ,id: user.id //好友ID
                            ,sign: user.sign //好友签名
                        });

                        layer.close(index);
                    }
                });
            }


        };
        $('.site-demo-layim').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>



<script>


</script>
</body>
</html>