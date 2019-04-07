<?php
namespace app\admin\validate;

use think\Validate;

class Nav extends Validate
{
    protected $rule = [
        'name' => 'require',
    ];

    protected $message = [
        'name.require' => '请输入导航名称',
    ];
}