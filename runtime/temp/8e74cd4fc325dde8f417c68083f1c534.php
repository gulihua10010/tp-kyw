<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"E:\phpStudy\WWW\kyw/application/admin\view\course_videocollect.html";i:1548505352;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
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
      


<style>
    .addone,.addsub,.addvideo,.delone,.delsub{margin:0;padding:0;width:50px;height:50px;border:0;border-radius:30px;color:#fff;cursor:pointer}
    .addone i,.addsub i,.addvideo i,.delone i,.delsub i{color:#fff;font-size:20px}
    .fl{float:left}
    .h60{height:60px}
    .addone,.addsub{background-color:#009688}
    .addvideo{background-color:#12ffe7}
    .addone:hover,.addsub:hover{background-color:#33aba0}
    .delone,.delsub{background-color:red}
    .delone:hover,.delsub:hover{background-color:#ff2100}
    .ml50{margin-left:50px}
    .ml110{margin-left:110px}
    .mt20{margin-top:20px}


</style>
<form class="layui-form form-container" id="layui-form" method="post">
    <!--asdfsdf-->
    <div class=" layui-form-item addcourse">
        <?php if(($arr==null || $arr=='')): ?>
        <div class="video-collect">
            <div class="h60">
                <label class="layui-form-label">1: </label>
                <input type="text" name="title1" class="layui-input"
                       style=" width: 300px;display: inline-block; " placeholder="输入标题一"
                       lay-verify="required"  />
                <button type="button" class="addone" data-id="1">
                    <i class="iconfont">&#xe728;</i>
                </button>
                <button type="button" class="addsub" data-id="1">
                    <i>+sub</i>
                </button>
            </div>
        </div>
        <?php endif; if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="video-collect">
            <div class="h60">
                <label class="layui-form-label onelabel"> </label>
                <input type="text" name="title1<?php echo $vo['id']; ?>" class="layui-input"
                       style=" width: 300px;display: inline-block; " placeholder="输入标题一"
                       lay-verify="required" value="<?php echo $vo['name']; ?>"/>
                <button type="button" class="addone" data-id="$vo.id}">
                    <i class="iconfont">&#xe728;</i>
                </button>
                <button type="button" class="addsub" data-id="$vo.id}">
                    <i>+sub</i>
                </button>
                <button type="button" class="delone">
                <i class="iconfont">&#xe656;</i>
                </button>
            </div>
            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <div class="video-collect2 ml50">
                <div class="h60 ">
                    <label class="layui-form-label subtitle"> </label>
                    <input type="text" name="title2<?php echo $v['id']; ?>" class="layui-input"  value="<?php echo $vo['name']; ?>"
                           style=" width: 300px;display: inline-block; " lay-verify="required"/>
                    <button type="button"  id="btn<?php echo $v['id']; ?>" class="addvideo">
                        <i class="iconfont">&#xe629;</i>
                    </button>
                    <!--<button type="button" class="addsub">-->
                        <!--<i class="iconfont">&#xe728;</i>-->
                    <!--</button>-->
                    <button type="button" class="delsub">
                        <i class="iconfont">&#xe656;</i>
                    </button>
                </div>
                <label class="layui-form-label">地址</label>
                <input type="text" class="layui-input ml110 path"  style="width: 300px;" name="path<?php echo $v['id']; ?>"
                       value='<?php if($v['video']  == ''): ?>暂无视频<?php else: ?> <?php echo $v['video']; endif; ?>'>
                <label class="layui-form-label mt20">时长</label>
                <input type="text" class="layui-input ml110 mt20 dur" style="width: 300px; " name="duration<?php echo $v['id']; ?>"
               value=  '<?php if($v['duration']  == ''): ?>0<?php else: ?> <?php echo $v['duration']; endif; ?>'>
                <div class="layui-form-item pro"   style="display: none">
                    <label class="layui-form-label">上传进度</label>
                    <div class="layui-progress" lay-showpercent="true" lay-filter="process"
                         style="  width: 500px;position: relative;left: 110px;top:16px">
                        <div class="layui-progress-bar layui-bg-green" lay-percent="0%"></div>
                    </div>
                </div>
                <div class="layui-form-item pre" <?php if($v['video']  == ''): ?>style="display: none"<?php endif; ?>>
                    <label class="layui-form-label">视频预览</label>
                    <video  class="videoing"  src="/kyw<?php echo $v['video']; ?>" controls="controls" width=300 height=200>
                        <source>
                    </video>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <input type="hidden" name="first-video-pic" value="0">
    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
    <div class="btable-paged" style="position: relative;left: 500px">
        <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">确定</button>
        </button>
    </div>

</form>
<!--<form method="post" enctype="multipart/form-data" action="<?php echo url('admin/upload/upfile'); ?>">-->
    <!--<input type="file" name="file">-->
    <!--<input type="submit" value="submit">-->

<!--</form>-->

</div>

 

<script>

</script>

<script src="/kyw/public/js/common.js"></script>
<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>

<!--页面JS脚本-->

<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {

        var form = layui.form
            , $ = layui.jquery
            , upload = layui.upload
            , element = layui.element;
        var x = 1, y =  99999999,z=1,flag=false;
        freshid();

        form.on('submit', function (data) {
            var formdata =$('#layui-form').serialize();
            ajaxform(formdata, " <?php echo url('admin/course/save_videocollect'); ?> ", $, function (res) {
                var data=res.data;
                var html=' ';
                for(var item in data){
                    html+="<div> <span>"+data[item].name+"</span>";
                    var subhtml='';
                    for (var sub in data[item].child){
                      if (data[item].child[sub].video==''){
                          subhtml+=' <div class="dt"> <span><i class="iconfont">&#xe62a;</i>'+data[item].child[sub].name+'</span> <span class="duration">时长'+data[item].child[sub].duration+'</span></div>';

                      } else{
                          subhtml+=' <div class="dt">'+data[item].child[sub].name+'</span></div>';

                      }
                    }
                    html+=subhtml+'</div>';
                }
                parent.$('#course-video').html(html);;
                if (res.pic!=0){
                    parent.$('#pre-image').css('display','block');
                    parent.$('#uploaded-image').attr('src',getRootPath_web()+res.pic)
                    parent.$('input[name=pic]').val(res.pic);
                }
                parent.$(".layui-layer-close1").trigger('click');
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            })
            return false;
        });
       $('.video-collect2').each(function (i) {
           var elebtn=$(this).find('.addvideo');
           var eleinput=$(this).find('.path');
           var elepro=$(this).find('.pro');
           var elepre=$(this).find('.pre');
           var elevideo=$(this).find('.videoing');
           var duration=$(this).find('.dur');
           var videoid=elevideo[0];
           uploadVideo(elebtn, eleinput, elepro, elepre, elevideo, duration,videoid);
       })
        function uploadVideo(elebtn, eleinput, elepro, elepre, elevideo, duration,videoid) {
            upload.render({
                url: '<?php echo url("admin/upload/upvideo"); ?>'
                , accept: 'video' //视频
                , elem: elebtn
                , exts: 'mp4|rm|rmvb|mpeg|mov|mtv|dat|wmv|avi| 3gp|amv'
                , auto: true
                , progress: function (e, percent) {
                    element.progress('process', percent + "%");
                }
                , before: function (input) {
                    elepro.css('display', 'block')
                    loading = layer.load(2, {
                        shade: [0.2, '#000']
                    });
                }
                , done: function (res) {
                    var entity = {};// 传输数据的实体变量
                    var flag = false;// 标识，用来判断是否选择文件，选择的文件大小是否大于零
                    var coversflag = false;// 这个可能没用，但是不想删除。
                    layer.close(loading);
                    eleinput.val(res.path);
                    elepre.css('display', 'block');
                    eleinput.attr('type', 'text');
                    duration.attr('type', 'text');
                    $('.paths').css('display','block');
                    $('.dur').css('display','block');
                    elevideo.attr('src', getRootPath_web() + res.path);
                    var a = document.getElementById(videoid)||videoid;
                    layer.msg(res.msg, {icon: 1, time: 1000});


                    //获取第一帧
                    var timesRun = 0;
                    var timer = setInterval(function () {
                        timesRun += 1;
                        if (timesRun === 1) {
                            clearInterval(timer);
                        }
                        entity.contentLen = parseInt(a.duration);// 获取视频时长，如果不使用定时器，获取时长可能是NAN，所以必须定时器
                          console.log( (a.duration));

                        var dur=parseInt(a.duration);
                        duration.val(converTime(dur));
                        if (false==flag) {
// 视频缩略图-先获取video对象-用canvas画图，返回imageSrc，返回的是base64编码-然后解码，生成二进制blob文件，提交二进制文件到后台。如果这里不使用定时器，也获取不到图片。
                            var video = document.getElementById(videoid)||videoid;;
                            var canvas = document.createElement('canvas');
                            var ctx = canvas.getContext('2d');
                            var imgHeight = video.videoHeight;
                            var imgWidth = video.videoWidth;
                            ctx.drawImage(video, 0, 0, imgWidth, imgHeight);
                            var imgSrc = canvas.toDataURL('image/png');
                            var binary = atob(imgSrc.split(',')[1]);
                            var array = [];
                            for (var i = 0; i < binary.length; i += 1) {
                                array.push(binary.charCodeAt(i));
                            }
                            var blob = new Blob([new Uint8Array(array)], {type: 'image/png'});
                            var u = URL.createObjectURL(blob);
                            var formData = new FormData();
                            formData.append('file', blob);

                            $.ajax({
                                url: '<?php echo url("admin/Upload/upblob"); ?>',
                                crossDomain: true,
                                data: formData,
                                dataType: 'json',
                                type: 'POST',
                                contentType: false,
                                processData: false,
                                success: function (res) {  ;
                                flag=true;
                                    $('input[name=first-video-pic]').val(res.path)
                                }
                            });

                        }
                    }, 1000);


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
        }

        $('.addcourse').on('click', '.addone', function () {
            z =getRandom();
            var onelevel = " <div class=\"video-collect\"> <div class=\"h60 \" >\n" +
                "                        <label class=\"layui-form-label onelabel\"></label>\n" +
                "                       <input type=\"text\" name='title1"+z+"'  placeholder=\"输入标题一\" class=\"layui-input\"\n" +
                "                               style=\" width: 300px;display: inline-block; \" lay-verify=\"required\"/>\n" +
                "                        <button type=\"button\" class=\"addone\"  >\n" +
                "                            <i class=\"iconfont\">&#xe728;</i>\n" +
                "                        </button>\n" +
                "                        <button type=\"button\" class=\"addsub  \"   >\n" +
                "                            <i >+sub</i>\n" +
                "                        </button>\n" +
                "                        <button type=\"button\" class=\"delone\"  >\n" +
                "                            <i class=\"iconfont\">&#xe656;</i>\n" +
                "                        </button> \n" +
                "                   </div>    </div>";
            $('.video-collect:last-child').after(onelevel);
            freshid();

        })

        $('.addcourse').on('click', '.delone', function () {
            $(this).parent().parent().remove();
            freshid();
            x = $('.video-collect').length;
        });

        $('.addcourse').on('click', '.delsub', function () {
            $(this).parent().parent().remove();
            // $('.video-collect').each(function (i) {
            //     $(this).find('.onelabel').text(i + 1 + ":");
            //     $(this).find('.addsub').attr('data-id', i + 1);
            //     var tt = $(this).find('.addsub').attr('data-id');
            //     $(this).find('.video-collect2').each(function (i) {
            //         $(this).find('.subtitle').text(tt + "." + (i + 1) + ":");
            //     })
            // })
            freshid();

        });
        $('.addcourse').on('click', '.addsub', function () {
            var btn = 'btn' + y;
            var input = 'input' + y;
            var pro = 'pro' + y;
            var pre = 'pre' + y;
            var video = 'video' + y;
            var title = 'title' + y;
            var duration = 'duration' + y;
            y++;
            z =getRandom();
            var dd=$('input[name=first-video-pic]').val()
            var twolevel = "  <div class=\"video-collect2 ml50\"> <div class=\"h60\" >\n" +
                "                        <label class=\"layui-form-label  subtitle\"> </label> \n" +
                "                         <input type=\"text\"  name='title2"+z+"'  placeholder=\"输入标题二\" class=\"layui-input\"\n" +
                "                               style=\" width: 300px;display: inline-block; \" lay-verify=\"required\"/>\n" +
                "                        <button type=\"button\" class=\"addvideo\" id='" + btn + "'  >\n" +
                "                            <i class=\"iconfont\">&#xe629;</i>\n" +
                "                        </button>\n" +
                "                        <button type=\"button\" class=\"delsub\"  >\n" +
                "                            <i class=\"iconfont\">&#xe656;</i>\n" +
                "                        </button> \n" +
                "                    </div>  <label class=\"layui-form-label paths\"  style=\"display: none\">地址</label>\n" +
                "             <input type=\"hidden\"  name='path"+z+"'  class=\"layui-input ml110\" style=\"width: 300px;\" id='"+input+"'>\n" +
                "                <label class=\"layui-form-label mt20 dur \" style=\"display: none\">时长</label>\n" +
                "            <input type=\"hidden\"  name='duration"+z+"'  id='"+duration+"' class=\"layui-input ml110 mt20\" style=\"width: 300px; \">" +
                "       <div class=\"layui-form-item  pro-upload\"  id='" + pro + "'  style=\"display: none\">\n" +
                "                                <label class=\"layui-form-label\">上传进度</label>\n" +
                "                                <div class=\"layui-progress\"  lay-showpercent=\"true\" lay-filter=\"process\"\n" +
                "                                     style=\"  width: 500px;position: relative;left: 110px;top:16px\" >\n" +
                "                                    <div class=\"layui-progress-bar layui-bg-green\" lay-percent=\"0%\"></div>\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "                            <div class=\"layui-form-item pre-video\"  id='" + pre + "'   style=\"display: none\">\n" +
                "                                <label class=\"layui-form-label\">视频预览</label>\n" +
                "                                <video  id='" + video + "' controls=\"controls\" width=300 height=200>\n" +
                "                                    <source  >\n" +
                "                                </video>\n" +
                "                            </div></div>";
            // style="display: none"
            $(this).parent().parent().append(twolevel);
            freshid();
            $app = $(this).parent().parent().find('.video-collect2:last-child');
            uploadVideo("#" + btn, $app.find("#" + input), $app.find("#" + pro), $app.find("#" + pre), $app.find("#" + video),$app.find("#" + duration), video)

        });
    });

function freshid() {
    $('.video-collect').each(function (i) {
        $(this).find('.onelabel').text(i + 1 + ":");
        $(this).find('.video-collect2').each(function (j) {
            $(this).find('.subtitle').text((i+1) + "." + (j + 1) + ":");

        })
    })
}
</script>

</body>
</html>