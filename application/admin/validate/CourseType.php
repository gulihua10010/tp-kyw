<?php
namespace app\admin\validate;

use think\Validate;

class CourseType extends Validate
{
    protected $rule = [
        'name' => 'require',
        'pid'  => 'require',
    ];

    protected $message = [
        'name.require' => '请输入类别',
        'pid.require'  => '请选择上级类别',
    ];
}