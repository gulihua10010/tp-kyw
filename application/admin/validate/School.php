<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/28
 * Time: 17:01
 */

namespace app\admin\validate;


use think\Validate;

class School extends  Validate
{

    protected $rule = [
        'proid'  => 'require|number',
        'name' => 'require',
        'prop' => 'require',
        'type' => 'require',
        'belong' => 'require',
        'info' => 'require',
        'rule' => 'require',
        'code' => 'require',
        'grade' => 'require',
        'fushi' => 'require',
        'pic' => 'require',
        'badge' => 'require',
        'address' => 'require',
        'website' => 'require',
        'email' => 'email',
    ];

    protected $message = [
        'proid.require'  => '请选择省份',
        'name.require' => '请输入学校名称',
        'prop.require' => '请选择学校属性',
        'type.require' => '请选择学校类别',
        'belong.require' => '请选择学校隶属',
        'info.require' => '请填写信息介绍',
        'rule.require' => '请填写招生简章',
        'grade.require' => '请填写分数线',
        'fushi.require' => '请填写复试信息',
        'code.require' => '请填写院校代码',
        'address.require' => '请填写地址',
        'badge.require' => '请上传校徽',
        'website.require' => '请填写学校网址',
        'pic.require' => '请上传学校图片',
        'email.email' => '请输入正确邮箱格式',
        'proid.number'  => '只能填写数字'
    ];
}