<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\phpStudy\WWW\kyw/application/index\view\course_ajaxpage_asks.html";i:1549023076;}*/ ?>
<?php if(is_array($asks) || $asks instanceof \think\Collection || $asks instanceof \think\Paginator): $i = 0; $__LIST__ = $asks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="wenda-listcon mod-qa-list clearfix">
    <div class='<?php if($vo['issolve'] == 1): ?>icon-finish<?php else: ?>icon-wenda<?php endif; ?>'></div>
    <div class="headslider qa-medias l"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"
                                           class="media" target="_blank"
                                           title="<?php echo $vo['username']; ?>"><img
            src="/kyw<?php echo $vo['userhead']; ?>"
            width="40" height="40"></a></div>
    <div class="wendaslider qa-content">
        <h2 class="wendaquetitle qa-header" style="cursor: pointer;!important;">
            <div class="wendatitlecon qa-header-cnt  " ><a style=" cursor: pointer"
                                                           href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>" target="_blank"
                                                           class="qa-tit "> <?php echo $vo['title']; ?> </a></div>
        </h2>
        <div class="replycont qa-body clearfix">
            <?php if($vo['solve'] != ''): ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt" style="color: #0ae029">已采纳回答</span> / <a
                    href="<?php echo url('user/index/home',array('id'=>$vo['solve']['userid'])); ?>" target="_blank"
                    title="<?php echo $vo['solve']['username']; ?>" class="nickname"  style="color: #666;font-weight: bold;font-size: 16px"><?php echo $vo['solve']['username']; ?></a></span>
                <div class="replydet"><?php echo clearHTMLhead($vo['solve']['content']); ?></div>
            </div>
            <?php elseif($vo['new'] != ''): ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt">最新回答</span> / <a
                    href="<?php echo url('user/index/home',array('id'=>$vo['new']['userid'])); ?>" target="_blank"
                    title="<?php echo $vo['new']['username']; ?>" class="nickname" style="color: #666;font-weight: bold;font-size: 16px"><?php echo $vo['new']['username']; ?></a></span>
                <div class="replydet"><?php echo clearHTMLhead($vo['new']['content']); ?></div>
            </div>
            <?php else: ?>
            <div class="fl replydes best"><span class="replysign"><span
                    class="adopt">暂无回答</span>  </span>
                <div class="replydet"><a  target="_blank" style="color: white" href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>" class="layui-btn">我要发布</a></div>
            </div>
            <?php endif; ?>
        </div>
        <div class="replymegfooter qa-footer clearfix">
            <div class="l-box fl"><a href="<?php echo url('index/course/qadetail',array('aid'=>$vo['id'])); ?>"
                                     target="_blank" class="replynumber static-count "> <span
                    class="static-item answer">    <?php echo $vo['reply']; ?> 回答   </span>
                <span class="static-item">           </span>
            </a></div>
            <em class="r"><?php echo friendlyDate($vo['time']); ?></em> </div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>

<div class="ask-page">
<?php echo $apage; ?>
</div>
<script>
    layui.use(['layer', 'form', 'element' ], function () {

        var   jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        jq(".ask-page .pagination a").click(function(){
            var url = jq(this).attr('href');
            jq.ajax({
                'type' : 'post',
                'url'  :  url,
                'data':{'type':1,'vid':'<?php echo $vid; ?>'},
                success:function(data){
                    jq('.course_quescon').html(data);
                }
            })
            return false;
        });
  });


</script>