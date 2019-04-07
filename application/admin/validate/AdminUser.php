<?php
namespace app\admin\validate;

use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'username'         => 'require|unique:user|min:4',
        'password'         => 'confirm:confirm_password|min:6',
        'confirm_password' => 'confirm:password',
        'status'           => 'require',
        'usermail'            => 'email|unique:user',
    ];

    protected $message = [
        'username.require'         => '请输入用户名',
    		'username.min'         => '用户名至少4位',
        'username.unique'          => '用户名已存在',
        'password.confirm'         => '两次输入密码不一致',
    		'password.length'         => '密码不小于6位',
        'confirm_password.confirm' => '两次输入密码不一致',
        'status.require'           => '请选择状态',
        'usermail.email'  => '邮箱格式错误',
        'usermail.unique'          => '邮箱已存在',
    ];
}