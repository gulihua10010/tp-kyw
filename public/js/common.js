/** common.js By Beginner Emain:zheng_jinfan@126.com HomePage:http://www.zhengjinfan.cn */
var $jq ;
layui.define(['layer'], function (exports) {
    "use strict";

    $jq = layui.jquery,
        layer = layui.layer;

    var common = {
        /**
         * 抛出一个异常错误信息
         * @param {String} msg
         */
        throwError: function (msg) {
            throw new Error(msg);
            return;
        },
        /**
         * 弹出一个错误提示
         * @param {String} msg
         */
        msgError: function (msg) {
            layer.msg(msg, {
                icon: 5
            });
            return;
        }
    };

    exports('common', common);
});

function getRootPath_web() {
    //获取当前网址，如： http://localhost:8083/kyw/user/login
    var curWwwPath = window.document.location.href;
    //获取主机地址之后的目录，如：kyw/user/login.php
    var pathName = window.document.location.pathname;
    var pos = curWwwPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8083
    var localhostPaht = curWwwPath.substring(0, pos);
    //获取带"/"的项目名，如：/uimcardprj
    var projectName = pathName.substring(0, pathName.substr(1).indexOf('/') + 1);

    return (localhostPaht + projectName);
}

function ajaxform(formdata, url, $, success = function (res) {
}, error = function () {
}) {
    $.ajax({
        data: formdata,
        type: 'post',
        async: true,
        dataType: 'json',
        url: url,
        beforeSend: function () {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            })
        },
        success: function (res) {
            layer.close(loading);
            if (res.code == 200) {
                layer.msg(res.msg, {icon: 1, time: 1000});
                setTimeout(function () {
                    ;
                    success(res);
                }, 1000)

            } else {
                layer.msg(res.msg, {icon: 2, time: 1000});
                error();
            }

        }, error: function (res) {
            layer.close(loading);
            layer.msg('未知错误', {icon: 2, time: 1000});
            error();
        }


    })
}

function uploadImg(upload, elem, url, success = function () {
}, error = function () {
}) {
    upload.render({
        url: url
        , elem: elem
        , exts: 'jpg|png|gif'
        , before: function (input) {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            });
        }
        , done: function (res) {
            layer.close(loading);
            success(res);
        }, error: function () {
            error();
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


function converTime(sec) {
    var sec = parseInt(sec);
    if (sec < 60) {
        return sec + '秒';
    }
    var min = parseInt(sec / 60);
    sec = sec % 60;
    if (min < 60) {
        return min + '分' + sec + '秒';
    }
    var hour = parseInt(min / 60);
    min = min % 60;
    return hour + '时' + min + '分' + sec + '秒';

}

function getRandom() {
    var random = "qwertyuioplkjhgfdsazxcvbnm1234567890";
    var s = '';
    for (var i = 0; i < 10; i++) {
        var r = Math.round(Math.random() * 36);
        s += random[r];
    }
    return s;
}
var isf=1
 // var $jq = jQuery.noConflict();
///user/index/login
function showLogin() {
    if (isf==1){
        var index = layer.open({
            title: ['登录', 'font-size:16px'],
            type: 2,
            shade: false,
            maxmin: false, //开启最大化最小化按钮,
            closeBtn: 1,
            area: ['325px', '385px'], //宽高
            zIndex:1,
            skin: 'layui-layer-rim', //加上边框
            content: [ getRootPath_web()+"/user/index/login.html" ,'no'],
            success:function(layero, index){
                isf=0;
                layer.iframeAuto(index)

            },
            end:function(layero, index){
                isf=1;
                $('.lg-reg').removeAttr('disabled')
                parent.location.reload();

            }
        })
    }

}
function showReg(l=0,r=0) {
    if (isf==1){
        layer.open({
            title: ['登录', 'font-size:16px'],
            type: 2,
            shade: false,
            maxmin: false, //开启最大化最小化按钮,
            closeBtn: 1,
            zIndex:1,

            skin: 'layui-layer-rim', //加上边框
            area: ['325px', '385px'], //宽高
            content: [ getRootPath_web()+"/user/index/login.html" ,'no'],
            success:function (layero, index) {
                isf=0;
                layer.iframeAuto(index)
                var body = layer.getChildFrame('body', index);
                var iframeWin = window[layero.find('iframe')[0]['name']];
                iframeWin.regs();

            },
            end:function () {
                isf=1;
                location.reload();
            }

        });
    }

}

function logins(index) {

    var username=$jq('#L_username').val();
    var pass= $jq('#L_pass').val();
    if (username==''||username.trim()==''){
        $jq('#L_username').css('border','1px red solid')
        layer.msg('用户名不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
            ,zIndex:3

        });
        return false;
    }
    if (pass==''||pass.trim()==''){
        $jq('#L_pass').css('border','1px red solid');
        layer.msg('密码不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    var formdata = {
        'data': JSON.stringify({
            'username': username,
            'pass': pass,
        })
    }
    ajaxform(formdata, getRootPath_web()+"/user/index/login", $jq, function () {
        parent.location.reload();
        parent.layer.close(index); //再执行关闭
    })

}
function reg(index) {
    var usermail=$jq('#R_email').val();
    var username=$jq('#R_username').val();
    var pass=$jq('#R_pass').val();
    var repass=$jq('#R_repass').val();
    var regmail=/^[a-z0-9A-Z]+([-_.a-z0-9A-Z])*@([a-z0-9A-Z]+[-.])+.[a-zA-Z]{2,4}$/i
    if (!regmail.test(usermail)){
        $jq('#R_email').css('border','1px red solid');
        layer.msg('邮箱格式不正确', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (usermail==''||usermail.trim()==''){
        $jq('#R_email').css('border','1px red solid');
        layer.msg('邮箱不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (username==''||username.trim()==''){
        $jq('#R_username').css('border','1px red solid');
        layer.msg('用户名不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (repass==''||repass.trim()==''){
        $jq('#R_repass').css('border','1px red solid');
        layer.msg('密码不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (!(/^(?![A-Z]+$)(?![a-z]+$)(?!\d+$)\S{8,}$/.test(pass))){
        layer.msg('密码必须符合由数字,大写字母,小写字母,至少其中两种组成，且长度不小于8，同时第一位不能为数字', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (repass.trim()!=pass.trim()){
        layer.msg('两次密码不一致', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    if (pass==''||pass.trim()==''){
        $jq('#R_pass').css('border','1px red solid');
        layer.msg('邮箱不能为空', {
            title: '提示'
            //不自动关闭
            , time: 1000
            , icon: 5
            ,offset: ['100px', '50px']
        });
        return false;
    }
    var formdata = {
        'data': JSON.stringify({
            // 'usernamil': usermail,
            'usermail': usermail,
            'username': username,
            'password': pass,
            'confirm_password': repass,
        })
    }
    $jq.ajax({
        data: formdata,
        type: 'post',
        async: true,
        dataType: 'json',
        url: getRootPath_web()+"/user/index/reg",
        beforeSend: function () {
            loading = layer.load(2, {
                shade: [0.2, '#000']
            })
        },
        success: function (res) {
            layer.close(loading);
            if (res.code == 200) {
                layer.msg(res.msg, {icon: 1, time: 1000});
                setTimeout(function () {
                    if (res.activeurl!==0){
                        sendMail(res)
                        parent.location.reload();
                        parent.layer.close(index); //再执行关闭
                    }else{
                        parent.location.reload();
                        parent.layer.close(index); //再执行关闭
                    }
                }, 1000)

            } else if (res.code == 500){
             var  confirm= layer.confirm(res.msg, {
                    btn: ['确定','取消'] //按钮
                }, function(){
                 sendMail(res);
             }, function(){
                 layer.close(confirm);
                });

            } else {
                layer.msg(res.msg, {icon: 2, time: 1000});

            }

        }, error: function (res) {
            layer.close(loading);
            layer.msg('未知错误', {icon: 2, time: 1000});
        }


    })


}
function  sendMail(res) {
    loading = layer.load(1, {
        content: '正在发送激活邮件...',
        shade: [0.4, '#393D49'],
        success: function (layero) {
            layero.css('padding-left', '30px');
            layero.find('.layui-layer-content').css({
                'padding-top': '40px',
                'width': '70px',
                'background-position-x': '16px'
            });
        }
    });
    var formdata = {
        'data': JSON.stringify({
            'usermail': res.usermail,
            'activeurl': res.activeurl,
        })
    }
    ajaxform(formdata, getRootPath_web()+"/user/index/send_active_code", $jq, function (data) {
        layer.closeAll();
    });
}
function  loginout() {

    $jq.get( getRootPath_web()+"/user/index/logout",function(data){

        if(data.code == 200){
            layer.msg(data.msg, {icon: 1, time: 1000}, function(){
                 location.reload();
            });
        }else{
            layer.msg(data.msg, {icon: 2, anim: 6, time: 1000});
        }
    });
}

function futext(id,power_paste="propmt") {
    tinymce.init({
        selector: id,
        max_height: 550,
        height: 250,
        convert_urls: false,
        branding: false,
        plugins: [
            "advlist  autolink   link image lists   print preview hr anchor  ",
            "searchreplace wordcount     code   insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons   textcolor paste fullpage  powerpaste toc   uploadvideo importcss textcolor colorpicker uploadimage"
        ],
        toolbar1: "undo redo | cut copy paste | bold italic underline strikethrough |" +
        " alignleft aligncenter alignright alignjustify |   formatselect fontselect fontsizeselect",
        toolbar2: " searchreplace | bullist numlist | outdent indent blockquote | link unlink   uploadimage uploadvideo code |" +
        " inserttime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript |   emoticons |  " +
        "   nonbreaking    restoredraft  |  code      ",
        menubar: false,
        toolbar_items_size: 'small',
        font_formats: "宋体=宋体;微软雅黑=微软雅黑;新宋体=新宋体;微软雅黑='微软雅黑';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';" +
        "Arial='Arial';Times New Roman='Times New Roman'",
        automatic_uploads: true,
        uploadimage_url: getRootPath_web()+"/admin.php/upload/upimage",
        uploadvideo_url: getRootPath_web()+"/admin.php/upload/upvideo",
        content_css:  getRootPath_web()+"/public/css/tinymce.css",
        textcolor_map: [
            "000000", "Black", "993300", "Burnt orange", "333300", "Dark olive", "003300", "Dark green", "003366", "Dark azure", "000080", "Navy Blue",
            "333399", "Indigo", "333333", "Very dark gray", "800000", "Maroon", "FF6600", "Orange", "808000", "Olive", "008000",
            "Green", "008080", "Teal", "0000FF", "Blue", "666699", "Grayish blue", "808080", "Gray", "FF0000", "Red", "FF9900",
            "Amber", "99CC00", "Yellow green", "339966", "Sea green", "33CCCC", "Turquoise", "3366FF", "Royal blue", "800080",
            "Purple", "999999", "Medium gray", "FF00FF", "Magenta", "FFCC00", "Gold", "FFFF00", "Yellow", "00FF00", "Lime",
            "00FFFF", "Aqua", "00CCFF", "Sky blue", "993366", "Red violet", "FFFFFF", "White", "FF99CC", "Pink", "FFCC99", "Peach",
            "FFFF99", "Light yellow", "CCFFCC", "Pale green", "CCFFFF", "Pale cyan", "99CCFF", "Light sky blue", "CC99FF", "Plum"
        ],
        language: 'zh_CN',
        powerpaste_word_import: power_paste,// 参数可以是propmt, merge, clear，效果自行切换对比
        powerpaste_html_import: power_paste,// propmt, merge, clear
        powerpaste_allow_local_images: true,
        paste_data_images: true,
        paste_merge_formats:true,
        paste_preprocess: function (plugin, args) {
            function load(src) {
                loadImageToBlob(src, function (blobFile) {
                    var x = new XMLHttpRequest();
                    x.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            data = this.responseText;
                            // console.log('response data: ' + data);
                        }
                    };
                    x.open('POST', getRootPath_web()+"/admin.php/upload/upimage");
                    x.send(blobFile);
                });
            }
        },
        images_upload_handler: function (blobInfo, success, failure) {
            var blob = blobInfo.blob();
            var formData = new FormData();
            formData.append('file', blob);
            $jq.ajax({
                url: getRootPath_web()+"/admin.php/upload/upblob",
                crossDomain: true,
                data: formData,
                dataType: 'json',
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (res) {
                    success(getRootPath_web() + res.path);
                }
            });
        }
    });
}
    function clearHtml(str) {
    str=str.replace(/<!DOCTYPE html>/g,"");
    str=str.replace(/<[/]?html>/g,"");
    str=str.replace(/<[/]?body>/g,"");
    str=str.replace(/<[/]?head>/g,"");
    return str;
    }
function clearHtmlexpImg(str) {
    str=str.replace(/<!DOCTYPE html>/g,"");
    str=str.replace(/<([^i][^>.]+)>/g,"");
    str=str.replace(/<([^i.]+)>/g,"");
    str=str.replace(/<i>/g,"");
    // str=str.replace(/<[\.]+>/g,"");

    return str;
}