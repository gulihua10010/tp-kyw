<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\phpStudy\WWW\kyw/application/user\view\index_login.html";i:1549177362;}*/ ?>
<script src="/kyw/public/plugins/layui/layui.js"></script>
<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/gt.js" type="text/javascript"></script>
<script src="/kyw/public/js/common.js" type="text/javascript"></script>

<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
<style>
    .show {
        display: block
    }

    .hide {
        display: none
    }
.login-reg{
    width: 310px;
}
    input{
        width: 200px;
    }
</style>
<div class="layui-tab login-reg">
    <ul class="layui-tab-title">
        <li class="layui-this">登录</li>
        <li>注册</li>
    </ul>
    <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
        <div class="layui-tab-item  login layui-show">

            <div class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="L_username" class="layui-form-label">用户名</label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_username" name="username" required lay-verify="required"
                               placeholder="请输入用户名或者邮箱" autocomplete="off" class="layui-input" style="  width: 200px;">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="pass" required lay-verify="required|pass" style="  width: 200px;"
                               autocomplete="off" class="layui-input">
                    </div>
                </div>
                <?php if($lgyzm==1): ?>
                <div class="layui-form-item "  >
                    <div id="lg-captcha" ></div>
                    <p id="lg-wait" class="show">正在加载验证码......</p>
                    <p id="lg-notice" class="hide">请先完成验证</p>
                </div>
                <?php endif; ?>
                <div class="layui-form-item" style='margin-left: 60px'>
                    <button class="layui-btn" style="background-color: rgb(23,179,241); border-radius: 5px;position: fixed;right: 20px;bottom: 20px"  data-id="<?php echo $lgyzm; ?>" id='lg-btn'>
                        立即登录
                    </button>
                    <span style="float: right">
                    <a href='<?php echo url("user/index/forget"); ?>' target='_blank'>忘记密码？</a>
                     </span>
                </div>

            </div>


        </div>
        <div class="layui-tab-item reg ">
            <div class="layui-form layui-form-pane">
                <div class="layui-form layui-form-pane">
                    <div class="layui-form-item">
                        <label for="R_email" class="layui-form-label">邮箱</label>
                        <div class="layui-input-inline">
                            <input type="text" id="R_email" name="usermail" required lay-verify="required" placeholder="将会成为您唯一的登入名" style="  width: 200px;"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="R_username" class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" id="R_username" name="username" required lay-verify="required" placeholder="不少于6个字符与数字组成" style="  width: 200px;"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="R_pass" class="layui-form-label">密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="R_pass" name="password" required lay-verify="required" placeholder="6到16个字符" style="  width: 200px;"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="R_repass" class="layui-form-label">确认密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="R_repass" name="confirm_password" required style="  width: 200px;"
                                   lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <?php if($regyzm==1): ?>
                    <div class="layui-form-item "  >
                        <div id="reg-captcha" ></div>
                        <p id="reg-wait" class="show">正在加载验证码......</p>
                        <p id="reg-notice" class="hide">请先完成验证</p>
                    </div>
                    <?php endif; ?>
                    <div class="layui-form-item " style='float: right;margin-right: 30px'>
                        <button class="layui-btn " style="background-color: rgb(23,179,241); border-radius: 5px;position: fixed;right: 20px;bottom: 20px " id='reg-btn'
                                data-id="<?php echo $regyzm; ?>"  >立即注册
                        </button>
                        <button  id="ddd" >dd</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    layui.use(['form', 'element'], function () {
        var form = layui.form
            , jq = layui.jquery
            , element = layui.element;
        form.verify({
            emailss: function (value) {
                if (value.length > 32) {
                    return '邮箱必须小于32位';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , content: function (value) {
                layedit.sync(editIndex);
            }
        });
        var handlerlg = function (captchaObj) {
            var f=1;
            jq('#lg-btn').click(function (e) {
                var id=jq(this).data('id');
                if (id==1){
                    var validate = captchaObj.getValidate();

                    if (!validate) {
                        jq("#lg-notice")[0].className = "show";
                        setTimeout(function () {
                            jq("#lg-notice")[0].className = "hide";
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
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                logins(index);
                                    // console.log(index)
                                parent.layer.close(index); //再执行关闭


                            }
                        })
                    }
                }else{
                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    //
                    logins(index);
                    // if (res){
                    //     var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    //     console.log(index)
                    //     parent.layer.close(index); //再执行关闭
                    // }
                }


                return false;
            });
            if (jq('#lg-btn').data('id')==1){

                // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
                captchaObj.appendTo("#lg-captcha");
                captchaObj.onReady(function () {
                    jq("#lg-wait")[0].className = "hide";
                });
                // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
            }
        };


        var handlerreg = function (captchaObj) {
            var f=1;
            jq('#reg-btn').click(function (e) {
                var id=jq(this).data('id');
                if (id==1){
                    var validate = captchaObj.getValidate();

                    if (!validate) {
                        jq("#reg-notice")[0].className = "show";
                        setTimeout(function () {
                            jq("#reg-notice")[0].className = "hide";
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
                                reg()
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                console.log(index)
                                parent.layer.close(index); //再执行关闭
                            }
                        })
                    }
                }else{
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    reg(index);

                    // console.log(index)
                    // parent.layer.close(index); //再执行关闭


                }


                return false;
            });
            if (jq('#reg-btn').data('id')==1){

                // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
                captchaObj.appendTo("#reg-captcha");
                captchaObj.onReady(function () {
                    jq("#reg-wait")[0].className = "hide";
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
                    width:'300px',
                    // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                }, handlerlg);
            },

        });
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
                    width:'260px',
                    // 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
                }, handlerreg);
            },

        });
    })

    function  regs() {
        $('.login-reg').find('li:first-child').removeClass('layui-this');
        $('.login-reg').find('li:nth-child(2)').addClass('layui-this');
        $('.login-reg').find('.login').removeClass('layui-show');
        $('.login-reg').find('.reg').addClass('layui-show');
    }
</script>