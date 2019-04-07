<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/27
 * Time: 23:30
 */

namespace app\admin\validate;


use think\Validate;

class Info extends  Validate
{
    protected $rule = [
        'name'         => 'require',
    ];

    protected $message = [
        'name.require'         => '请输入信息名',
    ];

}