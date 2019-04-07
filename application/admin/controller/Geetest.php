<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/29
 * Time: 17:02
 */

namespace app\admin\controller;

use geetest\GeetestLib;
use think\Config;
use think\Controller;
use think\Session;
class Geetest extends  Controller
{

    protected  $config=[];

    function    _initialize()
    {
        parent::_initialize();
        $this->config=Config::get('geetest');
        $this->data= array(
            "user_id" => "user", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "127.0.0.1" # 请在此处传输用户请求验证时所携带的IP
        );
    }

    function geetest_show_verify()
{
    $gtSdk=new   GeetestLib( $this->config['geetest_id'],$this->config['geetest_key']);

    $status=$gtSdk->pre_process($this->data,1);
    Session::set('gtserver',$status);
    Session::set('user_id',$this->data['user_id']);
    echo $gtSdk->get_response_str();
}

function  geetest_check(){
    $gtSdk=new   GeetestLib( $this->config['geetest_id'],$this->config['geetest_key']);

    if (Session::get('gtserver')==1) {   //服务器正常
        $result = $gtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $this->data);
        if ($result) {
            echo '{"status":"success"}';
        } else {
            echo '{"status":"fail"}';
        }
    } else {  //服务器宕机,走failback模式
        if ($gtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
            echo '{"status":"success"}';
        } else {
            echo '{"status":"fail"}';
        }
    }

}
}