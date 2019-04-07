<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/27
 * Time: 23:30
 */

namespace app\admin\validate;


use think\Validate;

class Magor extends  Validate
{
    protected $rule = [
        'name'         => 'require',
        'info'         => 'require',
        'code'         => 'require',
        'subject'         => 'require',
        'type'         => 'require',
    ];

    protected $message = [
        'name.require'         => '请输入专业名',
        'cid.require'         => '请输入介绍信息',
        'code.require'         => '请填写专业代码',
        'subject.require'         => '请选择学科',
        'type.require'         => '请选择专业类型',
    ];

}