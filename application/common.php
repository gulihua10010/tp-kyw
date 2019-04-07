<?php

use PHPMailer\PHPMailer;
use think\captcha\Captcha;
use think\Db;
use think\Hook AS thinkHook;
use think\Request;
use think\Cache;
use think\Loader;
use think\Url;
use think\Model;


//积分 评论 方法权限 阅读次数 字段show 分页 im search  【course video user_course [评论] 】 验证码
//添加cookie
function systemSetKey($user = '')
{
    if (is_array($user) && !empty($user)) {

        cookie('sys_key', encrypt(serialize($user)), 3600);
    }
}

function catenamebyid($id)
{
    $name = Db::name('forumcate')->where('id', $id)->value('name');

    return $name;
}

/**
 * 加密函数
 * @param string $txt 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 */
function encrypt($txt, $key = '')
{
    if (empty($txt)) return $txt;
    if (empty($key)) {
        $salt = Db::name('user')->where('id', 1)->value('salt');
        $key = md5($salt);
    }
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
    $ikey = "-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
    $nh1 = rand(0, 64);
    $nh2 = rand(0, 64);
    $nh3 = rand(0, 64);
    $ch1 = $chars{$nh1};
    $ch2 = $chars{$nh2};
    $ch3 = $chars{$nh3};
    $nhnum = $nh1 + $nh2 + $nh3;
    $knum = 0;
    $i = 0;
    while (isset($key{$i})) $knum += ord($key{$i++});
    $mdKey = substr(md5(md5(md5($key . $ch1) . $ch2 . $ikey) . $ch3), $nhnum % 8, $knum % 8 + 16);
    $txt = base64_encode(time() . '_' . $txt);
    $txt = str_replace(array('+', '/', '='), array('-', '_', '.'), $txt);
    $tmp = '';
    $j = 0;
    $k = 0;
    $tlen = strlen($txt);
    $klen = strlen($mdKey);
    for ($i = 0; $i < $tlen; $i++) {
        $k = $k == $klen ? 0 : $k;
        $j = ($nhnum + strpos($chars, $txt{$i}) + ord($mdKey{$k++})) % 64;
        $tmp .= $chars{$j};
    }
    $tmplen = strlen($tmp);
    $tmp = substr_replace($tmp, $ch3, $nh2 % ++$tmplen, 0);
    $tmp = substr_replace($tmp, $ch2, $nh1 % ++$tmplen, 0);
    $tmp = substr_replace($tmp, $ch1, $knum % ++$tmplen, 0);
    return $tmp;
}

/**
 * 解密函数
 * @param string $txt 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
function decrypt($txt, $key = '', $ttl = 0)
{
    if (empty($txt)) return $txt;
    if (empty($key)) {
        $salt = Db::name('user')->where('id', 1)->value('salt');
        $key = md5($salt);
    }
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
    $ikey = "-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
    $knum = 0;
    $i = 0;
    $tlen = @strlen($txt);
    while (isset($key{$i})) $knum += ord($key{$i++});
    $ch1 = @$txt{$knum % $tlen};
    $nh1 = strpos($chars, $ch1);
    $txt = @substr_replace($txt, '', $knum % $tlen--, 1);
    $ch2 = @$txt{$nh1 % $tlen};
    $nh2 = @strpos($chars, $ch2);
    $txt = @substr_replace($txt, '', $nh1 % $tlen--, 1);
    $ch3 = @$txt{$nh2 % $tlen};
    $nh3 = @strpos($chars, $ch3);
    $txt = @substr_replace($txt, '', $nh2 % $tlen--, 1);
    $nhnum = $nh1 + $nh2 + $nh3;
    $mdKey = substr(md5(md5(md5($key . $ch1) . $ch2 . $ikey) . $ch3), $nhnum % 8, $knum % 8 + 16);
    $tmp = '';
    $j = 0;
    $k = 0;
    $tlen = @strlen($txt);
    $klen = @strlen($mdKey);
    for ($i = 0; $i < $tlen; $i++) {
        $k = $k == $klen ? 0 : $k;
        $j = strpos($chars, $txt{$i}) - $nhnum - ord($mdKey{$k++});
        while ($j < 0) $j += 64;
        $tmp .= $chars{$j};
    }
    $tmp = str_replace(array('-', '_', '.'), array('+', '/', '='), $tmp);
    $tmp = trim(base64_decode($tmp));
    if (preg_match("/\d{10}_/s", substr($tmp, 0, 11))) {
        if ($ttl > 0 && (time() - substr($tmp, 0, 11) > $ttl)) {
            $tmp = null;
        } else {
            $tmp = substr($tmp, 11);
        }
    }
    return $tmp;
}




/* *
 * MD5
 * 详细：MD5加密
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */

/**
 * 签名字符串
 * @param $prestr 需要签名的字符串
 * @param $key 私钥
 * return 签名结果
 */
function md5Sign($prestr, $key)
{
    $prestr = $prestr . $key;
    return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key)
{
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);

    if ($mysgin == $sign) {
        return true;
    } else {
        return false;
    }
}


/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstring($para)
{
    $arg = "";
    while (list ($key, $val) = each($para)) {
        $arg .= $key . "=" . $val . "&";
    }
    //去掉最后一个&字符
    $arg = substr($arg, 0, count($arg) - 2);

    //如果存在转义字符，那么去掉转义
    if (get_magic_quotes_gpc()) {
        $arg = stripslashes($arg);
    }

    return $arg;
}

/**
 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
 * @param $para 需要拼接的数组
 * return 拼接完成以后的字符串
 */
function createLinkstringUrlencode($para)
{
    $arg = "";
    while (list ($key, $val) = each($para)) {
        $arg .= $key . "=" . urlencode($val) . "&";
    }
    //去掉最后一个&字符
    $arg = substr($arg, 0, count($arg) - 2);

    //如果存在转义字符，那么去掉转义
    if (get_magic_quotes_gpc()) {
        $arg = stripslashes($arg);
    }

    return $arg;
}

/**
 * 除去数组中的空值和签名参数
 * @param $para 签名参数组
 * return 去掉空值与签名参数后的新签名参数组
 */
function paraFilter($para)
{
    $para_filter = array();
    while (list ($key, $val) = each($para)) {
        if ($key == "sign" || $key == "sign_type" || $val == "") continue;
        else    $para_filter[$key] = $para[$key];
    }
    return $para_filter;
}

/**获取扩展图标
 * @param $ext
 * @return string
 */
function getExtIcon($ext){
    $icon="";
    switch ($ext){
        case 'zip':$icon="#icon-zip";break;
        case 'rar':$icon="#icon-rar";break;
        case 'doc':
        case 'docx':$icon="#icon-doc";break;
        case 'pdf':$icon="#icon-pdf";break;
        case 'txt':$icon="#icon-TXT";break;
    }
return $icon;
}

/**
 * 对数组排序
 * @param $para 排序前的数组
 * return 排序后的数组
 */
function argSort($para)
{
    ksort($para);
    reset($para);
    return $para;
}

/**
 * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
 * 注意：服务器需要开通fopen配置
 * @param $word 要写入日志里的文本内容 默认值：空值
 */
function logResult($word = '')
{
    $fp = fopen("log.txt", "a");
    flock($fp, LOCK_EX);
    fwrite($fp, "执行日期：" . strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

/**
 * 实现多种字符编码方式
 * @param $input 需要编码的字符串
 * @param $_output_charset 输出的编码格式
 * @param $_input_charset 输入的编码格式
 * return 编码后的字符串
 */
function charsetEncode($input, $_output_charset, $_input_charset)
{
    $output = "";
    if (!isset($_output_charset)) $_output_charset = $_input_charset;
    if ($_input_charset == $_output_charset || $input == null) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
    } elseif (function_exists("iconv")) {
        $output = iconv($_input_charset, $_output_charset, $input);
    } else die("sorry, you have no libs support for charset change.");
    return $output;
}

/**
 * 实现多种字符解码方式
 * @param $input 需要解码的字符串
 * @param $_output_charset 输出的解码格式
 * @param $_input_charset 输入的解码格式
 * return 解码后的字符串
 */
function charsetDecode($input, $_input_charset, $_output_charset)
{
    $output = "";
    if (!isset($_input_charset)) $_input_charset = $_input_charset;
    if ($_input_charset == $_output_charset || $input == null) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input, $_output_charset, $_input_charset);
    } elseif (function_exists("iconv")) {
        $output = iconv($_input_charset, $_output_charset, $input);
    } else die("sorry, you have no libs support for charset changes.");
    return $output;
}

function do_post($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);

    curl_close($ch);
    return $ret;
}

function get_url_contents($url)
{
    if (ini_get("allow_url_fopen") == "1")
        return file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

/**获取积分名
 * @param $point
 * @param int $id
 * @return mixed|string
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function getgradenamebyid($point, $id = 0)
{
    if ($id == 0) {
        $name = Db::name('usergrade')->where('id', $point)->value('name');

        if (empty($name)) {
            $name = '普通会员';
        }
    } else {
        $map['score'] = array('elt', $point);

        $res = Db::name('usergrade')->where($map)->order('score desc')->limit(1)->value('id');
        $info = Db::name('user')->where('id', $id)->find();

        if (!empty($res) && $res != $info['grades']) {
            Db::name('user')->where('id', $id)->setField('gradesgrades', $res);

        }
        $name = Db::name('usergrade')->where('id', $res)->value('name');
        if (empty($name)) {
            $name = '普通会员';
        }


    }

    return $name;
}

function url($url = '', $vars = '', $suffix = true, $domain = false)
{


    if (strtolower(request()->module()) == 'index' && !config('url_route_on')) {
        Url::root(getbaseurl() . 'index.php');
    } else if (strtolower(request()->module()) == 'index' && config('url_route_on')) {
        //Url::root(getbaseurl().'/');
    }


    return Url::build($url, $vars, $suffix, $domain);
}

function routerurl($url, $arr = array())
{
    if (empty($arr)) {
        $str = url($url);
    } else {
        $str = url($url, $arr);
    }


    $str = str_replace('admin.php', 'index.php', $str);

    return $str;
}

function remove_xss($html)
{
    $html = htmlspecialchars_decode($html);
    preg_match_all("/\<([^\<]+)\>/is", $html, $ms);

    $searchs[] = '<';
    $replaces[] = '&lt;';
    $searchs[] = '>';
    $replaces[] = '&gt;';

    if ($ms[1]) {
        $allowtags = 'video|attach|img|a|font|div|table|tbody|caption|tr|td|th|br|p|b|strong|i|u|em|span|ol|ul|li|blockquote|strike|pre|code|embed';
        $ms[1] = array_unique($ms[1]);
        foreach ($ms[1] as $value) {
            $searchs[] = "&lt;" . $value . "&gt;";

            $value = str_replace('&amp;', '_uch_tmp_str_', $value);
            $value = string_htmlspecialchars($value);
            $value = str_replace('_uch_tmp_str_', '&amp;', $value);

            $value = str_replace(array('\\', '/*'), array('.', '/.'), $value);
            $skipkeys = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate',
                'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange',
                'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick',
                'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate',
                'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete',
                'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel',
                'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart',
                'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop',
                'onsubmit', 'onunload', 'javascript', 'script', 'eval', 'behaviour', 'expression');
            $skipstr = implode('|', $skipkeys);
            $value = preg_replace(array("/($skipstr)/i"), '.', $value);
            if (!preg_match("/^[\/|\s]?($allowtags)(\s+|$)/is", $value)) {
                $value = '';
            }
            $replaces[] = empty($value) ? '' : "<" . str_replace('&quot;', '"', $value) . ">";
        }
    }
    $html = str_replace($searchs, $replaces, $html);
    $html = htmlspecialchars($html);
    return $html;
}

function string_htmlspecialchars($string, $flags = null)
{
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[$key] = string_htmlspecialchars($val, $flags);
        }
    } else {
        if ($flags === null) {
            $string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
            if (strpos($string, '&amp;#') !== false) {
                $string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
            }
        } else {
            if (PHP_VERSION < '5.4.0') {
                $string = htmlspecialchars($string, $flags);
            } else {
                if (!defined('CHARSET') || (strtolower(CHARSET) == 'utf-8')) {
                    $charset = 'UTF-8';
                } else {
                    $charset = 'ISO-8859-1';
                }
                $string = htmlspecialchars($string, $flags, $charset);
            }
        }
    }

    return $string;
}

function string_remove_xss($val)
{
    $val = htmlspecialchars_decode($val);
    $val = strip_tags($val, '<img><attach><u><p><b><i><a><strike><pre><code><font><blockquote><span><ul><li><table><tbody><tr><td><ol><iframe><embed>');

    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    return $val;

    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';


    for ($i = 0; $i < strlen($search); $i++) {
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val);
        $val = preg_replace('/({0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val);
    }

    $ra1 = array('embed', 'iframe', 'frame', 'ilayer', 'layer', 'javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'object', 'frameset', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true;
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|({0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2);
            $val = preg_replace($pattern, $replacement, $val);
            if ($val_before == $val) {
                $found = false;
            }
        }
    }
    $val = htmlspecialchars($val);
    return $val;
}
//执行sql 处理表前缀
function sqlQuery($sql){

    $sql=preg_replace('/(update\s+)([\w\d_]+)/is',
        '$1 '.config(  'database.prefix').'$2 ',$sql);
    // var_dump($sql1);
    // var_dump($sql);
    preg_match_all('/from[\s\S]+?where/is',$sql,$t);
    for ($i=0;$i<sizeof($t[0]);$i++){
        $subsql=preg_replace('/(from\s+|,\s*)([\w\d_]+)/is','$1 '.config(  'database.prefix').'$2',$t[0][$i]);
        $sql=preg_replace('/'.$t[0][$i].'/is',
            $subsql,$sql);
    }
    return \think\Db::query($sql);



}
//执行sql 处理表前缀
function sqlExecute($sql)
{
    $sql = preg_replace('/(update\s+)([\w\d_]+)/is',
        '$1 ' . config('database.prefix') . '$2 ', $sql);
    // var_dump($sql1);
    // var_dump($sql);
    preg_match_all('/from[\s\S]+?where/is', $sql, $t);
    for ($i = 0; $i < sizeof($t[0]); $i++) {
        $subsql = preg_replace('/(from\s+|,\s*)([\w\d_]+)/is', '$1 ' . config('database.prefix') . '$2', $t[0][$i]);
        $sql = preg_replace('/' . $t[0][$i] . '/is',
            $subsql, $sql);
    }
}
function updategrade($data)
{
    $map['score'] = array('elt', $data['point']);

    $res = Db::name('usergrade')->where($map)->order('score desc')->limit(1)->value('id');

    if (!empty($res) && $res != $data['grades']) {
        Db::name('user')->where('id', $data['id'])->setField('grades', $res);
    }

    $data['grades'] = $res;
    return $data;
}

/**
 * @param $score积分
 * @param $uid
 * @param $controller 控制器  login登录  reg注册    resource资源下载 course课程观看  commentadd评论  forumadd发布帖子
 * forumfiledownload 帖子附件下载 forumfileupload帖子附件上传
 *
 * @param int $pointid
 * @return mixed
 * @throws \think\Exception
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function point_note($score, $uid, $controller, $pointid = 0)
{
    if ($score != 0) {

        if ($controller == 'login') {
            $time = time();
            $maptime['add_time'] = array('gt', $time - 24 * 60 * 60);
            $maptime['uid'] = $uid;
            $maptime['controller'] = 'login';
            $count = Db::name('point_note')->where($maptime)->count();
            if ($count > 0) {
                return 0;
            }
            Db::name('user')->where('id', $uid)->setInc('point', $score);

        } else if ($controller=='resource') {
            $time = time();
            $maptime['uid'] = $uid;
            $maptime['controller'] = 'resource';
            $maptime['pointid'] =$pointid;
            $count = Db::name('point_note')->where($maptime)->count();
            if ($count > 0) {
                return 0;
            }
            $user_point=  Db::name('user')->where('id', $uid)->find();
            if ($user_point['point']<$score){
                return -1;
            }
            Db::name('user')->where('id', $uid)->setDec('point', $score);

        }else if ($controller=='course') {
            $maptime['uid'] = $uid;
            $maptime['controller'] = 'course';
            $maptime['pointid'] =$pointid;
            $count = Db::name('point_note')->where($maptime)->count();
            if ($count > 0) {
                return 0;
            }
            $user_point=  Db::name('user')->where('id', $uid)->find();
            if ($user_point['point']<$score){
                return -1;
            }
            //根据用户积分提升或降低用户等级
            Db::name('user')->where('id', $uid)->setDec('point', $score);

        }else if ($controller=='forumfiledownload') {
            $maptime['uid'] = $uid;
            $maptime['controller'] = 'course';
            $maptime['pointid'] =$pointid;
            $count = Db::name('point_note')->where($maptime)->count();
            if ($count > 0) {
                return 0;
            }
            $user_point=  Db::name('user')->where('id', $uid)->find();
            if ($user_point['point']<$score){
                return -1;
            }
            //根据用户积分提升或降低用户等级
            Db::name('user')->where('id', $uid)->setDec('point', $score);

        } else{
            $maptime['uid'] = $uid;
            $maptime['controller'] = 'course';
            $maptime['pointid'] =$pointid;
            Db::name('user')->where('id', $uid)->setInc('point', $score);

        }


        $data['uid'] = $uid;
        $data['add_time'] = time();
        $data['controller'] = $controller;
        $data['score'] = $score;
        $data['pointid'] = $pointid;

        Db::name('point_note')->insert($data);
        $data = Db::name('user')->where('id', $uid)->find();
        $map['score'] = array('elt', $data['point']);
        $res = Db::name('usergrade')->where($map)->order('score desc')->limit(1)->value('id');
        if (!empty($res) && $res != $data['grades']) {
            Db::name('user')->where('id', $uid)->setField('grades', $res);
        }


    }else if ($score==0&&$controller=='course'){
        $maptime['uid'] = $uid;
        $maptime['controller'] = 'course';
        $maptime['pointid'] =$pointid;
        $count = Db::name('point_note')->where($maptime)->count();
        if ($count > 0) {
            return 0;
        }
        $user_point=  Db::name('user')->where('id', $uid)->find();
        if ($user_point<$score){
            return -1;
        }
        //根据用户积分提升或降低用户等级
        Db::name('user')->where('id', $uid)->setDec('point', $score);
        $data['uid'] = $uid;
        $data['add_time'] = time();
        $data['controller'] = $controller;
        $data['score'] = $score;
        $data['pointid'] = $pointid;

        Db::name('point_note')->insert($data);
    }


    return $score;


}

function getpoint($uid, $controller, $pointid)
{
    $map['uid'] = $uid;
    $map['pointid'] = $pointid;
    $map['controller'] = $controller;


    $res = Db::name('Point_note')->where($map)->value('score');
    return $res;
}
//
//
///**  */


/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type = 0)
{
    if ($type) {
        return ucfirst(preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        }, $name));
    } else {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
    }
}


function A($name, $layer = '', $level = 0)
{
    static $_action = array();
    $layer = $layer ?: 'controller';


    if (isset($_action[$name . $layer]))
        return $_action[$name . $layer];

    $class = parse_res_name($name, $layer);

    if (class_exists($class)) {
        $action = new $class();
        $_action[$name . $layer] = $action;


        return $action;
    } else {
        return false;
    }
}

function get_cover($cover_id, $field = null)
{
    if (empty($cover_id)) {
        return false;
    }
    $picture = Db::name('file')->find($cover_id);


    return WEB_URL . $picture[$field];
}


function int_to_string(&$data, $map = array('status' => array(1 => '正常', -1 => '删除', 0 => '禁用', 2 => '未审核', 3 => '草稿')))
{
    if ($data === false || $data === null) {
        return $data;
    }
    $data = (array)$data;
    foreach ($data as $key => $row) {
        foreach ($map as $col => $pair) {
            if (isset($row[$col]) && isset($pair[$row[$col]])) {
                $data[$key][$col . '_text'] = $pair[$row[$col]];
            }
        }
    }
    return $data;
}

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param  string $str 要分割的字符串
 * @param  string $glue 分割符
 * @return array
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function str2arr($str, $glue = ',')
{
    return explode($glue, $str);
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param  array $arr 要连接的数组
 * @param  string $glue 分割符
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function arr2str($arr, $glue = ',')
{
    return implode($glue, $arr);
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list, $field, $sortby = 'asc')
{

    if (is_array($list)) {
        $refer = array();
        $resultSet = array();

        foreach ($list as $i => $data) {


            $refer[$i] = $data[$field];

        }


        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc': // 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ($refer as $key => $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}


function userhead($userhead)
{
    if ($userhead == '') {
        return '/public/images/default.png';
    } else {
        return $userhead;
    }
}

function getheadurl($head)
{
    if (preg_match("/^(http:\/\/|https:\/\/).*$/", $head)) {
        return $head;
    } else {
        return 'http://' . $_SERVER['HTTP_HOST'] . getbaseurl() . $head;
    }
}

function getweburl($controller, $action, $name = '', $value = '')
{
    if (Cache::has('site_config')) {
        $site_config = Cache::get('site_config');
    } else {
        $site_config = Db::name('system')->field('value')->where('name', 'site_config')->find();
        $site_config = unserialize($site_config['value']);
        Cache::set('site_config', $site_config);
    }

    if ($site_config['site_wjt'] == 1) {
        if ($name != '') {
            $arr = array($name => $value);
            $url = url($controller . "/" . $action, $arr);
        } else {
            $url = url($controller . "/" . $action);
        }

    } else {
        if ($name != '') {
            $arr = array($name => $value);
            $url = url($controller . "/" . $action, $arr);
        } else {
            $url = url($controller . "/" . $action);
        }
    }

    return $url;

}
//
//function sendmail($switch)
//{
//
//    ignore_user_abort();//关闭浏览器后，继续执行php代码
//    set_time_limit(0);//程序执行时间无限制
//    $sleep_time = 5;//多长时间执行一次
//
//    while ($switch) {
//
//        $msg = date("Y-m-d H:i:s") . $switch;
//        file_put_contents("log.log", $msg, FILE_APPEND);//记录日志
//        sleep($sleep_time);//等待时间，进行下一次操作。
//    }
//    exit();
//
//}
/** 发送邮件
 * @param string $to
 * @param string $subject
 * @param string $body
 * @param string $from_name
 * @param null $attachment
 * @param string $reply_email
 * @param string $reply_name
 * @return bool|string
 * @throws \PHPMailer\Exception
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function send_code_to_email($to = '', $subject = '', $body = '', $from_name = '', $attachment = null, $reply_email = '', $reply_name = '')
{
    $config = Db::name('system')->select();
    $site_config = [];
    foreach ($config as $value) {
        $site_config[$value['name']] = $value['value'];

    }
    $frommail = 'gulihua10010@sina.com';; //发件人邮箱  gulihua
//    $frommail =  $site_config['smtp_user'];; //发件人邮箱  gulihua
    $frommailpswd = '123abc123';//123abc
//    $frommailpswd = $site_config['smtp_pwd'];//123abc
    $port = $site_config['smtp_port'];
    $host = $site_config['smtp'];//
    $mail = new PHPMailer();
    $mail->SMTPDebug = 1;
    $mail->isSMTP();// 使用SMTP服务
    $mail->CharSet = "UTF-8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
    $mail->Host = $host;// 发送方的SMTP服务器地址
    $mail->SMTPAuth = true;// 是否使用身份验证
    $mail->Username = $frommail;//// 发送方的
    $mail->Password = $frommailpswd;////客户端授权密码,而不是邮箱的登录密码，就是手机发送短信之后弹出来的一长串的密码
    $mail->SMTPSecure = "ssl";// 使用ssl协议方式
    $mail->Port = $port;//  sina端口110或25） //qq  465 587
    if ($to == '') {
        $to = $site_config['smtp_test_tomail'];//邮件地址为空时，默认使用后台默认邮件测试地址
    }
    if ($from_name == '') {
        $from_name = $site_config['site_title'];
        //发送者名称为空时，默认使用网站名称
    }
    if ($subject == '') {
        $subject = $site_config['seo_title']; //邮件主题为空时，默认使用网站标题
    }
    if ($body == '') {
        $body = $site_config['seo_description'];//邮件内容为空时，默认使用网站描述
    }
    try {
        $mail->setFrom($frommail, $from_name);
    } catch (Exception $e) {
    }// 设置发件人信息，如邮件格式说明中的发件人，
    $mail->addAddress($to, '您好!');// 设置收件人信息，如邮件格式说明中的收件人，
    $mail->MsgHTML($body); //解析
    $mail->addReplyTo($frommail, $from_name);// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
    $mail->Subject = $subject;// 邮件标题
    //$code=$code;
    // session("code",$code);
    //return $code."----".session("code");
    $mail->Body = $body;// 邮件正文
    //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用

    if ($mail->send()) {
        return true;
    } else {
        return $mail->ErrorInfo;
    }

}

function getbaseurl()
{
    $baseUrl = str_replace('\\', '', dirname($_SERVER['SCRIPT_NAME']));
    $baseUrl = empty($baseUrl) ? '/' : '/' . trim($baseUrl, '/') . '/';
    return $baseUrl;
}
//
//function showyourdomain()
//{
//    $domain = $_SERVER['HTTP_HOST'];
//    $par = time();
//
//    $url = 'http://www.eadmin.top/index.php/Index/savebanquan/' . '?url=' . $domain;
//    $fp = @fsockopen("www.eadmin.top", 80, $errno, $errstr, 3);
//    $out = "POST " . $url . " HTTP/1.1\r\n";
//    $out .= "Host: typecho.org\r\n";
//    //$out.="User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; zh-CN; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13"."\r\n";
//    $out .= "Content-type: application/x-www-form-urlencoded\r\n";
//    //$out.="PHPSESSID=".$sessionid."0\r\n";
//    $out .= "Content-Length: " . strlen($par) . "\r\n";
//    $out .= "Connection: close\r\n\r\n";
//    $out .= $par . "\r\n\r\n";
//
//    if ($fp) {
//        fputs($fp, $out);
//        $line = fgets($fp, 1024);
//
//        $results = "";
//        $inheader = 1;
//        while (!feof($fp)) {
//            $line = fgets($fp, 2048);
//            if ($inheader && ($line == "n" || $line == "rn")) {
//                $inheader = 0;
//            } elseif (!$inheader) {
//                $results .= $line;
//            }
//        }
//
//        fclose($fp);
//        $line = str_replace('\\t', '', $line);
//        $line = json_decode($line, true);
//        return $line;
//    }
//
//
//}
//

function iconurl($icon, $type)
{

    if ($icon != 0 && $icon != '') {

        if ($type == 2) {

            return "<i class='iconfont icon-" . $icon . "'></i>";
        } else {

            return "<img src='" . $icon . "' />";
        }
    } else {

        return "空";

    }
}

function getcommentbyid($id)
{

    $children = Db::name('comment')->where(['id' => $id])->find();

    $content = getusernamebyid($children['uid']) . ':' . htmlspecialchars_decode($children['content']);

    return $content;


}

function getuserinfobyid($uid)
{
    if ($uid == 0) {
        return '所有人';
    } else {
        $children = Db::name('user')->where(['id' => $uid])->find();

        return $children;

    }


}

function getusernamebyid($uid)
{
    if ($uid == 0) {
        return '所有人';
    } else {
        $children = Db::name('user')->where(['id' => $uid])->find();
        return $children['username'];

    }


}

function getforumbyid($id)
{
    if ($id == 0) {
        return '无此帖';
    } else {
        $children = Db::name('forum')->where(['id' => $id])->find();
        if (empty($children)) {


            return '无此帖';
        } else {
            return $children['title'];
        }

    }


}
//getcoursebyid

function getcoursebyid($id)
{
    if ($id == 0) {
        return '无此课程';
    } else {
        $children = Db::name('course')->where(['id' => $id])->find();
        if (empty($children)) {
            return '无此课程';
        } else {
            return $children['name'];
        }

    }


}
function getaskbyid($id)
{
    if ($id == 0) {
        return '无此问题';
    } else {
        $children = Db::name('course_ask')->where(['id' => $id])->find();
        if (empty($children)) {
            return '无此问题';
        } else {
            return $children['title'];
        }

    }


}
//getresbyid

function getresbyid($id)
{
    if ($id == 0) {
        return '无此资源';
    } else {
        $children = Db::name('resource')->where(['id' => $id])->find();
        if (empty($children)) {
            return '无此资源';
        } else {
            return $children['name'];
        }

    }


}
function getvideobyid($id)
{
    if ($id == 0) {
        return '无此问题';
    } else {
        $children = Db::name('course_video_collection')->where(['id' => $id])->find();
        if (empty($children)) {
            return '无此视频';
        } else {
            return $children['name'];
        }

    }


}
function getartbyid($id)
{
    if ($id == 0) {
        return '无此文章';
    } else {
        $children = Db::name('article')->where(['id' => $id])->find();
        if (empty($children)) {
            return '无此文章';
        } else {
            return $children['title'];
        }

    }


}

/**处理时间
 * @param $sTime
 * @param string $type
 * @param string $alt
 * @return false|string
 */
function friendlyDate($sTime, $type = 'normal', $alt = 'false')
{
    if (!$sTime)
        return '';
    //sTime=源时间，cTime=当前时间，dTime=时间差
    $cTime = time();
    $dTime = $cTime - $sTime;
    $dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
    //$dDay     =   intval($dTime/3600/24);
    $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
    //normal：n秒前，n分钟前，n小时前，日期
    if ($type == 'normal') {
        if ($dTime < 60) {
            if ($dTime < 10) {
                return '刚刚';    //by yangjs
            } else {
                return intval(floor($dTime / 10) * 10) . "秒前";
            }
        } elseif ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
            //今天的数据.年份相同.日期相同.
        } elseif ($dYear == 0 && $dDay == 0) {
            //return intval($dTime/3600)."小时前";
            return '今天' . date('H:i', $sTime);
        } elseif ($dYear == 0) {
            return date("m月d日 H:i", $sTime);
        } else {
            return date("Y-m-d", $sTime);
        }
    } elseif ($type == 'mohu') {
        if ($dTime < 60) {
            return $dTime . "秒前";
        } elseif ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        } elseif ($dDay > 0 && $dDay <= 7) {
            return intval($dDay) . "天前";
        } elseif ($dDay > 7 && $dDay <= 30) {
            return intval($dDay / 7) . '周前';
        } elseif ($dDay > 30) {
            return intval($dDay / 30) . '个月前';
        }
        //full: Y-m-d , H:i:s
    } elseif ($type == 'full') {
        return date("Y-m-d , H:i:s", $sTime);
    } elseif ($type == 'ymd') {
        return date("Y-m-d", $sTime);
    } else {
        if ($dTime < 60) {
            return $dTime . "秒前";
        } elseif ($dTime < 3600) {
            return intval($dTime / 60) . "分钟前";
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return intval($dTime / 3600) . "小时前";
        } elseif ($dYear == 0) {
            return date("Y-m-d H:i:s", $sTime);
        } else {
            return date("Y-m-d H:i:s", $sTime);
        }
    }
}

/**处理视频时间
 * @param $sec
 * @return string
 */
function converTime($sec)
{
    $sec=intval($sec);
    if ($sec<60){
        return $sec.'秒';
    }
    $min=intval($sec/60);
    $sec=$sec%60;
    if ($min<60){
        return $min.'分'.$sec.'秒';
    }
    $hour=intval($min/60);
    $min=$min%60;
    return  $hour.'时'.$min.'分'.$sec.'秒';

}

/*
 * 来判断导航链接内部外部从而生成新链接
 * 
 * 
 * */
function getnav_Controller($link, $sid)
{

    if ($sid == 1) {
        $arr = explode(',', $link);
        $url = $arr[0];
        $con = explode('/', $url);
        $controller = $con[1];

    }

    return $controller;


}

/**导航链接
 * @param $link
 * @param $sid 1 为内部链接 2 外部链接
 * @return mixed|string
 */
function getnavlink($link, $sid)
{
    if ($sid == 1) {
        $arr = explode(',', $link);
        $url = $arr[0];
        array_shift($arr);
        if (empty($arr)) {

            $link = routerurl($url);

        } else {
            $m = 1;

            $queue = array();
            foreach ($arr as $k => $v) {

                if ($m == 1) {
                    $n = $v;
                    $m = 2;

                } else {
                    $b = $v;
                    $queue[$n] = $b;
                    $m = 1;
                }
            }
            if (empty($queue)) {
                $link = routerurl($url);
            } else {
                $link = routerurl($url, $queue);
            }

        }


    }

    return $link;
}


function dir_create($path, $mode = 0777)
{
    if (is_dir($path)) {
        return TRUE;
    }
    $ftp_enable = 0;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir)) {
            continue;
        }
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}

function format_bytes($size, $delimiter = '')
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 6; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

//用于生成用户密码的随机字符
function generate_password($length = 8)
{
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $password;
}

/**
 * 获取分类所有子分类
 * @param int $cid 分类ID
 * @return array|bool
 */
function get_category_children($cid)
{
    if (empty($cid)) {
        return false;
    }

    $children = Db::name('category')->where(['path' => ['like', "%,{$cid},%"]])->select();

    return array2tree($children);
}
//
///**
// * 根据分类ID获取文章列表（包括子分类）
// * @param int $cid 分类ID
// * @param int $limit 显示条数
// * @param array $where 查询条件
// * @param array $order 排序
// * @param array $filed 查询字段
// * @return bool|false|PDOStatement|string|\think\Collection
// */
//function get_articles_by_cid($cid, $limit = 10, $where = [], $order = [], $filed = [])
//{
//    if (empty($cid)) {
//        return false;
//    }
//
//    $ids = Db::name('category')->where(['path' => ['like', "%,{$cid},%"]])->column('id');
//    $ids = (!empty($ids) && is_array($ids)) ? implode(',', $ids) . ',' . $cid : $cid;
//
//    $fileds = array_merge(['id', 'cid', 'title', 'introduction', 'thumb', 'reading', 'publish_time'], (array)$filed);
//    $map = array_merge(['cid' => ['IN', $ids], 'status' => 1, 'publish_time' => ['<= time', date('Y-m-d H:i:s')]], (array)$where);
//    $sort = array_merge(['is_top' => 'DESC', 'sort' => 'DESC', 'publish_time' => 'DESC'], (array)$order);
//
//    $article_list = Db::name('article')->where($map)->field($fileds)->order($sort)->limit($limit)->select();
//
//    return $article_list;
//}
//
///**
// * 根据分类ID获取文章列表，带分页（包括子分类）
// * @param int $cid 分类ID
// * @param int $page_size 每页显示条数
// * @param array $where 查询条件
// * @param array $order 排序
// * @param array $filed 查询字段
// * @return bool|\think\paginator\Collection
// */
//function get_articles_by_cid_paged($cid, $page_size = 15, $where = [], $order = [], $filed = [])
//{
//    if (empty($cid)) {
//        return false;
//    }
//
//    $ids = Db::name('category')->where(['path' => ['like', "%,{$cid},%"]])->column('id');
//    $ids = (!empty($ids) && is_array($ids)) ? implode(',', $ids) . ',' . $cid : $cid;
//
//    $fileds = array_merge(['id', 'cid', 'title', 'introduction', 'thumb', 'reading', 'publish_time'], (array)$filed);
//    $map = array_merge(['cid' => ['IN', $ids], 'status' => 1, 'publish_time' => ['<= time', date('Y-m-d H:i:s')]], (array)$where);
//    $sort = array_merge(['is_top' => 'DESC', 'sort' => 'DESC', 'publish_time' => 'DESC'], (array)$order);
//
//    $article_list = Db::name('article')->where($map)->field($fileds)->order($sort)->paginate($page_size);
//
//    return $article_list;
//}

/**
 * 数组层级缩进转换
 * @param array $array 源数组
 * @param int $pid
 * @param int $level
 * @return array
 */
function array2level($array, $pid = 0, $level = 1)
{
    static $list = [];

    foreach ($array as $v) {


        if ($v['pid'] == $pid) {

            $v['level'] = $level;
            $list[] = $v;

            array2level($array, $v['id'], $level + 1);
        }
    }

    return $list;
}

/**
 * 构建层级（树状）数组
 * @param array $array 要进行处理的一维数组，经过该函数处理后，该数组自动转为树状数组
 * @param string $pid_name 父级ID的字段名
 * @param string $child_key_name 子元素键名
 * @return array|bool
 */
function array2tree(&$array, $pid_name = 'pid', $child_key_name = 'children')
{
    $counter = array_children_count($array, $pid_name);
    if (!isset($counter[0]) || $counter[0] == 0) {
        return $array;
    }
    $tree = [];
    while (isset($counter[0]) && $counter[0] > 0) {
        $temp = array_shift($array);
        if (isset($counter[$temp['id']]) && $counter[$temp['id']] > 0) {
            array_push($array, $temp);
        } else {
            if ($temp[$pid_name] == 0) {
                $tree[] = $temp;
            } else {
                $array = array_child_append($array, $temp[$pid_name], $temp, $child_key_name);
            }
        }
        $counter = array_children_count($array, $pid_name);
    }

    return $tree;
}

/**
 * 子元素计数器
 * @param array $array
 * @param int $pid
 * @return array
 */
function array_children_count($array, $pid)
{
    $counter = [];
    foreach ($array as $item) {
        $count = isset($counter[$item[$pid]]) ? $counter[$item[$pid]] : 0;
        $count++;
        $counter[$item[$pid]] = $count;
    }

    return $counter;
}

/**
 * 把元素插入到对应的父元素$child_key_name字段
 * @param        $parent
 * @param        $pid
 * @param        $child
 * @param string $child_key_name 子元素键名
 * @return mixed
 */
function array_child_append($parent, $pid, $child, $child_key_name)
{
    foreach ($parent as &$item) {
        if ($item['id'] == $pid) {
            if (!isset($item[$child_key_name]))
                $item[$child_key_name] = [];
            $item[$child_key_name][] = $child;
        }
    }

    return $parent;
}

/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name)
{
    $result = false;
    if (is_dir($dir_name)) {
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}
//
///**
// * 判断是否为手机访问
// * @return  boolean
// */
//function is_mobile()
//{
//    static $is_mobile;
//
//    if (isset($is_mobile)) {
//        return $is_mobile;
//    }
//
//    if (empty($_SERVER['HTTP_USER_AGENT'])) {
//        $is_mobile = false;
//    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
//        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
//    ) {
//        $is_mobile = true;
//    } else {
//        $is_mobile = false;
//    }
//
//    return $is_mobile;
//}

/**
 * 手机号格式检查
 * @param string $mobile
 * @return bool
 */
function check_mobile_number($mobile)
{
    if (!is_numeric($mobile)) {
        return false;
    }
    $reg = '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#';

    return preg_match($reg, $mobile) ? true : false;
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true)
{


    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
        if (false === $slice) {
            $slice = '';
        }
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    //截取内容时去掉图片，仅保留文字


    return $suffix ? $slice . '...' : $slice;
}

/**清除html格式
 * @param $content
 * @return null|string|string[]
 */
function clearcontent($content)
{
    $content = htmlspecialchars_decode($content);

    $content = preg_replace("/&lt;/i", "<", $content);


    $content = preg_replace("/&gt;/i", ">", $content);

    $content = preg_replace("/&amp;/i", "&", $content);


    $content = strip_tags($content);
    return $content;
}

/**清除html头
 * @param $content
 * @return null|string|string[]
 */
function clearHTMLhead($content)
{
    $content = preg_replace("/<!DOCTYPE html>/i", "", $content);
    $content = preg_replace("/<[\/]?html>/i", "", $content);

    $content = preg_replace("/<[\/]?body>/i", "", $content);
    $content = preg_replace("/<[\/]?head>/i", "", $content);
    return $content;
}

/**转utf8
 * @param $dat
 * @return array|string
 */
function convert_from_latin1_to_utf8_recursively($dat)
{
    if (is_string($dat)) {
        return utf8_encode($dat);
    } elseif (is_array($dat)) {
        $ret = [];
        foreach ($dat as $i => $d) $ret[$i] = convert_from_latin1_to_utf8_recursively($d);

        return $ret;
    } elseif (is_object($dat)) {
        foreach ($dat as $i => $d) $dat->$i = convert_from_latin1_to_utf8_recursively($d);

        return $dat;
    } else {
        return $dat;
    }
}

function clearHtml($content)
{
    $content = preg_replace("/<[\s]*>/i", "", $content);
    $content = preg_replace("/<[^>]*>/i", "", $content);
    $content = preg_replace("/<\/>/i", "", $content);
    $content = preg_replace("/&[\w]+;/i", "", $content);
    return $content;
}

/**html是否有图片
 * @param $content
 * @return string
 */
function isCoverImg($content)
{
    $r=preg_match_all('/<img[^>]*>/is',$content,$mat1);
 if ($r==true){
     return "[图片]";
 }
    return "";
}
function formatHTML($htmlContent)
{

    $html = $htmlContent;
    $html = preg_replace("/'/i", "\"", $html);
    $html = preg_replace("/\\\\/i", "\\\\\\\\", $html);
    $html = preg_replace("/\n/i", "\\n'+\n'", $html);
    return $html;
}

function cutstr_html($string, $length = 0, $ellipsis = '…')
{

    $string = strip_tags($string);
    $string = preg_replace("/\n/is", '', $string);
    $string = preg_replace("/\r\n/is", '', $string);

    $string = preg_replace('/ |　/is', '', $string);
    $string = preg_replace('/&nbsp;/is', '', $string);
    $string = preg_replace('/&emsp;/is', '', $string);

    if (mb_strlen($string, 'utf-8') <= $length) {
        $ellipsis = '';
    }
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $string);
    if (is_array($string) && !empty($string[0])) {
        if (is_numeric($length) && $length) {


            $string = join('', array_slice($string[0], 0, $length)) . $ellipsis;
        } else {
            $string = implode('', $string[0]);
        }
    } else {
        $string = '';
    }
    return $string;
}


/**
 * @param $data
 */
function console_log($data)
{
    if (is_array($data) || is_object($data)) {
        echo("<script>console.log('" . json_encode($data) . "');</script>");
    } else {
        echo("<script>console.log('" . $data . "');</script>");
    }
}

function descstr($str)
{
    $len = strlen($str); //函数返回字符串的长度：
    $newstr = "";
    for ($i = $len - 1; $i >= 0; $i--) {
        $newstr .= $str[$i];
    }
    return $newstr;
}

//id name a d
function searchArray($searchKey, $resultKey, $value, $array)
{
    //array_search('a',array_column($d,'name','id'))
    return array_search($value, array_column($array, $searchKey, $resultKey));

}


/**
 * $msg 待提示的消息
 * $url 待跳转的链接
 * $icon 这里主要有两个，5和6，代表两种表情（哭和笑）
 * $time 弹出维持时间（单位秒）
 */
function alert_success($msg = '', $url = '', $issucess = 1, $parameter = '')
{

    if (is_null($url) && !is_null(Request::instance()->server('HTTP_REFERER'))) {
        $url = Request::instance()->server('HTTP_REFERER');
    } elseif ('' !== $url && !strpos($url, '://') && 0 !== strpos($url, '/')) {
        $url = Url::build($url);
    }
    $p = '';
    if (!empty($parameter)) {
        foreach ($parameter as $key => $value) {
            $p .= '/' . $key . '/' . $value;
        }
    }
    $url .= $p;
    $url = preg_replace('/.html/is', '', $url);
    $str = '<script src="' . SCRIPT_DIR . '/plugins/layui/layui.js"></script>  ';//加载jquery和layer
    $str .= '<script>  layui.use("form",function(){
 var index = layer.load(0, {shade: false , offset: "400px"},{time:3000}); //0代表加载的风格，支持0-2
setTimeout(function() {
  layer.close(index);
 layer.msg("' . $msg . '", {icon: ' . $issucess . ', time: 1000}, function(){
          location.href = " ' . $url . '";
        });    
  
},1000)});

    </script>';//主要方法
    return $str;
}

function alert_url($msg = '', $url = '')
{

    if (is_null($url) && !is_null(Request::instance()->server('HTTP_REFERER'))) {
        $url = Request::instance()->server('HTTP_REFERER');
    } elseif ('' !== $url && !strpos($url, '://') && 0 !== strpos($url, '/')) {
        $url = Url::build($url);
    }

    $str = '<script type="text/javascript" src="' . SCRIPT_DIR . '/static/js/jquery.min.js"></script>  
<script src="' . SCRIPT_DIR . '/static/layer/layer.js"></script>  ';//加载jquery和layer
    $str .= '<script>
  var index = layer.load(0, {shade: false , offset: \'400px\'},{time:2000}); //0代表加载的风格，支持0-2
setTimeout(function() {
  layer.close(index);
  layer.msg(\'' . $msg . '\', {
   //不自动关闭
   time:1000 , offset: \'400px\'
});

},1000);
setTimeout(function() {
    window.location.href=\'' . $url . '\';
},2000)
 

    </script>';//主要方法

    return $str;
}

//layer.msg('不开心。。', {icon: 5});


function alert_login(){
    $str = '<script src="' . SCRIPT_DIR . '/plugins/layui/layui.js"></script>  ';//加载jquery和layer
    $str .= '<script type="text/javascript" src="' . SCRIPT_DIR . '/js/common.js"></script>';
    $str.='<script>  layui.use("form",function(){showLogin();});</script>';
    return $str;

}