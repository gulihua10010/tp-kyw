<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\phpStudy\WWW\kyw/application/index\view\course_ajaxpage_comms.html";i:1549023076;}*/ ?>
<?php if(is_array($comms) || $comms instanceof \think\Collection || $comms instanceof \think\Paginator): $i = 0; $__LIST__ = $comms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="wenda-listcon mod-qa-list post-row clearfix" data-id="<?php echo $vo['userid']; ?>">
    <div class="headslider qa-medias fl"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>"
                                            class="media" target="_blank" title="<?php echo $vo['username']; ?>"><img
            src="/kyw<?php echo $vo['userhead']; ?>"
            width="40" height="40"></a></div>
    <div class="wendaslider qa-content">
        <div class="tit"><a href="<?php echo url('user/index/home',array('id'=>$vo['userid'])); ?>" target="_blank"><?php echo $vo['username']; ?></a>
        </div>
        <div class="cnt"><?php echo clearHTMLhead($vo['content']); ?></div>
        <div class="replymegfooter qa-footer clearfix">
            <div class="l-box fl"><a title="赞" href="javascript:(0);"
                                     class="js-pl-praise  moco-btn moco-btn-gray-l" type="4"
                                     data-id="<?php echo $vo['id']; ?>"> <i <?php if(in_array($vo['id'],$d4s))echo ('style="color:red"');  ?>
                class="iconfont">&#xe611;</i> <em><?php echo $vo['praise']; ?></em> </a>
            </div>
            <span class=" timeago"><?php echo friendlyDate($vo['time']); ?></span></div>
    </div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
<div class="comm-page">
<?php echo $cpage; ?>
</div>
<script>
    layui.use(['layer', 'form', 'element' ], function () {

        var   jq = layui.jquery
            , layer = layui.layer
            , form = layui.form;
        jq(".comm-page .pagination a").click(function(){
            var url = jq(this).attr('href');
            jq.ajax({
                'type' : 'post',
                'url'  :  url,
                'data':{'type':2,'vid':'<?php echo $vid; ?>'},
                success:function(data){
                    jq('.course_comment').html(data);
                }
            })
            return false;
        });
  });


</script>