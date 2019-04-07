<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"E:\phpStudy\WWW\kyw/application/admin\view\login_index.html";i:1548763998;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>后台管理</title>
<link rel="stylesheet" href="/kyw/public/css/admin.css">
<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
<script src="/kyw/public/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/kyw/public/js/gt.js" type="text/javascript"></script>
<script src="/kyw/public/plugins/layui/layui.js" type="text/javascript"></script>
<style>
	.show {
		display: block
	}

	.hide {
		display: none
	}

</style>
</head>
<body id="login">
<div class="login">
<h2>考研网后台管理系统登录</h2>
<form method="post" id="formdata">
<div class="layui-form-item">
<input type="text" name="username" placeholder="请输入账号" required lay-verify="required" autocomplete="off" class="layui-input">
</div>
<div class="layui-form-item">
	<input type="password" name="password" placeholder="请输入密码" required lay-verify="required" autocomplete="off" class="layui-input">
</div>
	<?php if($yzm==1): ?>
	<div class="layui-form-item "  >
		<div id="embed-captcha" ></div>
		<p id="wait" class="show">正在加载验证码......</p>
		<p id="notice" class="hide">请先完成验证</p>
	</div>
	<?php endif; ?>
<div class="layui-form-item">
<button style="padding: 0 102px;" class="layui-btn" data-id="<?php echo $yzm; ?>" id="loginbtn">立即登录</button>
</div>
</form>
<script type="text/javascript">
		if (top.location != self.location){     
			top.location=self.location;     
		}   
	</script>
<script>
layui.use('form',function(){
  var form = layui.form
  ,jq = layui.jquery;
    var handlerEmbed = function (captchaObj) {
        var f=1;
        jq('#loginbtn').click(function (e) {
            var id=jq(this).data('id');
            if (id==1){
                var validate = captchaObj.getValidate();

                if (!validate) {
                    jq("#notice")[0].className = "show";
                    setTimeout(function () {
                        jq("#notice")[0].className = "hide";
                    }, 2000);
                    e.preventDefault();
                }else{
                    jq.ajax({
                        url:"<?php echo Url('admin/geetest/geetest_check'); ?>",
                        type:'post',
                        dataType:'json',
                        data:{
                            geetest_challenge: validate.geetest_challenge,
                            geetest_validate: validate.geetest_validate,
                            geetest_seccode: validate.geetest_seccode,
                        },
                        success:function (data) {
                            // console.log(data)
                            // loading = layer.llioad(2, {
                            //     shade: [0.2,'#000']
                            // });
                            loading = layer.load(2, {
                                shade: [0.2,'#000']
                            });
                            var param = jq('#formdata').serialize();
                            jq.post('<?php echo url("login/login"); ?>',param,function(data){
                                if(data.code == 200){
                                    layer.close(loading);
                                    layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                                        location.href = '<?php echo url("index/adminindex"); ?>';
                                    });
                                }else{
                                    layer.close(loading);
                                    layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});

                                }
                            });
                        }
                    })
                }
			}else{
                loading = layer.load(2, {
                    shade: [0.2,'#000']
                });
                var param = jq('#formdata').serialize();
                jq.post('<?php echo url("login/login"); ?>',param,function(data){
                    if(data.code == 200){
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                            location.href = '<?php echo url("index/adminindex"); ?>';
                        });
                    }else{
                        layer.close(loading);
                        layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});

                    }
                });
			}


            return false;
        });
if (jq('#loginbtn').data('id')==1){

    // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
    captchaObj.appendTo("#embed-captcha");
    captchaObj.onReady(function () {
        jq("#wait")[0].className = "hide";
    });
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
}
    };
    var url="<?php echo Url('admin/geetest/geetest_show_verify'); ?>?d="+(new Date()).getTime();


    jq.ajax({
        // 获取id，challenge，success（是否启用failback）

        url:url, // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            // console.log(data);
            // 使用initGeetest接口
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                offline: !data.success ,// 表示用户后台检测极验服务器是否宕机，一般不需要关注
                width:'230px',
                // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
            }, handlerEmbed);
        },

    });


})
</script>
</div>
</body>
</html>