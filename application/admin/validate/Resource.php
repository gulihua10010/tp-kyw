<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/27
 * Time: 23:30
 */

namespace app\admin\validate;


use think\Validate;

class Resource extends  Validate
{
    protected $rule = [
        'name'         => 'require',
        'data'         => 'require',
        'tid'         => 'require',
    ];

    protected $message = [
        'name.require'         => '请输入资料名',
        'data.require'         => '请上传文件',
        'tid.require'         => '资源类别不能为空',
    ];

}