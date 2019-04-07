<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/27
 * Time: 23:30
 */

namespace app\admin\validate;


use think\Validate;

class Course extends  Validate
{
    protected $rule = [
        'name'         => 'require',
        'cid'         => 'require',
        'pic'            => 'require',
        'teacher'            => 'require',
    ];

    protected $message = [
        'name.require'         => '请输入课程名',
        'cid.require'         => '请选择类别',
        'pic.require'         => '请上传类别',
        'teacher.require'         => '请选择讲师',
    ];

}