<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2018/12/27
 * Time: 23:30
 */

namespace app\admin\validate;


use think\Validate;

class Article extends  Validate
{
    protected $rule = [
        'title'         => 'require',
        'author'         => 'require',
        'content'         => 'require',
        'infoid'         => 'require|number',
        'pic'         => 'require',
    ];

    protected $message = [
        'title.require'         => '请输入标题',
        'author.require'         => '请输入作者',
        'pic.require'         => '请选择缩略图',
        'content.require'         => '请输入文章内容',
        'infoid.require'         => '请选择文章类别',
        'infoid.numbet'         => '文章类别必须为数字',
    ];

}