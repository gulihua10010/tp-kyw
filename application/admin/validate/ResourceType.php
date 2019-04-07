<?php
namespace app\admin\validate;

use think\Validate;

class  ResourceType extends Validate
{
    protected $rule = [
        'name' => 'require',
        'tid'  => 'require',
    ];

    protected $message = [
        'name.require' => '请输入类别',
        'pid.require'  => '请选择上级类别',
        'tid.require'         => '请选择类别',
    ];
}