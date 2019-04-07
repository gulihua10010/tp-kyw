<?php
/**
 * Created by PhpStorm.
 * User: 顾力华
 * Date: 2019/1/5
 * Time: 14:57
 */

namespace app\user\controller;


use app\common\model\User as UserModel;
use app\common\controller\HomeBase;
use Easemob\Easemob;
use think\Cache;
use think\Config;
use think\Db;
use think\Session;

class Index extends HomeBase
{
    protected $site_config;
    protected $hx;

    const ADD_USER_MSG = 1;//为请求添加用户
    const ADD_USER_SYS = 2;//为系统消息（添加好友
    const ADD_GROUP_MSG = 3;//为请求加群
    const ADD_GROUP_SYS = 4;//为系统消息（添加群）
    const ADD_ADMIN = 6;//为添加管理
    const REMOVE_ADMIN = 7;//为取消管理
    const ALLUSER_SYS = 5;// 全体会员消息
    const UNREAD = 1;//未读
    const AGREE_BY_TO = 2;//同意
    const DISAGREE_BY_TO = 3;//拒绝
    const AGREE_BY_FROM = 4;//同意且返回消息已读
    const DISAGREE_BY_FROM = 5;//拒绝且返回消息已读
    const READ = 6;//全体消息已读

    protected function _initialize()
    {
        parent::_initialize();
//        $this->getNav(1);
//        Cache::set('site_config',null);
        $this->site_config = Cache::get('site_config');
        /**
         * 环信配置
         */
        $eaconfig = Config::get('easemob');
        $this->hx['client_id'] = $eaconfig['client_id'];
        $this->hx['client_secret'] = $eaconfig['client_secret'];
        $this->hx['org_name'] = $eaconfig['org_name'];
        $this->hx['app_name'] = $eaconfig['app_name'];
//        console_log(\session('userid'));
    }

    public function reg()
    {
        $regswitch = Cache::get('site_config');
        if (!$regswitch['user_reg']) {
//            $this->error('网站已关闭用户注册功能', url('index/index'));
            return json(array('code' => 0, 'msg' => '网站已关闭用户注册功能'));

        }
        $member = new UserModel();
        if (request()->isPost()) {
            if (!$regswitch['user_reg']) {
                return json(array('code' => 0, 'msg' => '网站已关闭会员注册功能'));
            }
            $data = json_decode($_POST['data'], true);
            if (!empty($regswitch['baoliu'])) {
                $arr = explode(',', $regswitch['baoliu']);
                foreach ($arr as $k => $v) {
                    if ($data['username'] == $v) {
                        return json(array('code' => 0, 'msg' => '你的昵称被禁止注册'));
                    }
                }
            }

            $password = input('password');
            //$passwords = input('confirm_password');
            //return json(array('code' => 0, 'msg' => '注册失败'));

            $validate_result = $this->validate($data, 'User');
            if ($regswitch['emailcheck'] == 1) {        //是否开启邮件注册
                $user = $member->where('usermail', $data['usermail'])->where('status', 0)->find();  //未激活用户
                if (!empty($user)) {
                    $active_code = encrypt($user->id . ',' . time(), md5($user['salt']));
                    Db::name('user')->where('id', $user->id)->setField("activecode", $active_code);
                    $web_url = $_SERVER['HTTP_HOST'] . WEB_URL;
                    //重新激活邮件
                    $active_url = "<h1>" . $data['username'] . ",恭喜你!注册成功。</h1><a href='http://" . $web_url . "/index.php/user/index/active/code/" . $active_code . "/token/" . md5($user['salt']) . "'>点击激活</a>,有效期30分钟";

                    return json(array('code' => 500, 'msg' => '用户名为(' . $user['username'] . ')邮箱已注册但未激活，是否重新发送激活邮件?', 'username' => $user['username'],
                        'usermail' => $user['usermail'], 'activeurl' => $active_url));

                }

            }

            if ($validate_result !== true) {
                // $this->error($validate_result);
                return json(array('code' => 0, 'msg' => $validate_result));
            } else {
                $data['salt'] = generate_password(18);
                $data['regtime'] = time();
                $data['username'] = remove_xss($data['username']);
                $data['grades'] = 0;
                $data['status'] = 0;//config('web.WEB_REG');
                $data['point'] = 0;//config('point.REG_POINT');
                $data['userhead'] = '/public/images/default.png';
                $data['userip'] = $_SERVER['REMOTE_ADDR'];
                $data['password'] = md5($password . $data['salt']);
                if ($regswitch['emailcheck'] == 1) {
                    $data['status'] = 0;//config('web.WEB_REG');
                } else {
                    $data['status'] = 1;//config('web.WEB_REG');
                    //环信注册
                    $ea = new Easemob($this->hx);
                    $create_result = $ea->createUser($data['username'], $data['password'], $data['username']);
//                    console_log($create_result);
                }
                if ($member->allowField(true)->save($data)) {
                    if ($regswitch['emailcheck'] == 1) {        //是否开启邮件注册
                        $active_code = encrypt($member->id . ',' . $data['regtime'], md5($data['salt']));       //激活码加密
                        Db::name('user')->where('id', $member->id)->setField("activecode", $active_code);
                        point_note($regswitch['point_reg'], $member->id, 'reg');
                        $web_url = $_SERVER['HTTP_HOST'] . WEB_URL;
                        //激活邮件
                        $active_url = "<h1>" . $data['username'] . ",恭喜你!注册成功。</h1><a href='http://" . $web_url . "/index.php/user/index/active/code/" . $active_code . "/token/" . md5($data['salt']) . "'>点击激活</a>,有效期30分钟";
                        return json(array('code' => 200, 'msg' => '注册成功！积分+' . $regswitch['point_reg'], 'usermail' => $data['usermail'], 'activeurl' => $active_url));

                    } else {
                        return json(array('code' => 200, 'msg' => '注册成功！积分+' . $regswitch['point_reg'], 'usermail' => $data['usermail'], 'activeurl' => 0));


                    }
                } else {
                    return json(array('code' => 0, 'msg' => '注册失败'));
                }
            }
        }
        //  $data = input('post.');
        return view();
    }


    public function login()
    {
//        Cache::set('site_config',null);
        $site_config = Cache::get('site_config');
        $yzmarr = explode(',', $site_config['site_yzm']);
        //判断是否开启验证码
        if (in_array(1, $yzmarr)) {
            $regyzm = 1;
        } else {
            $regyzm = 0;
        }
        if (in_array(2, $yzmarr)) {
            $lgyzm = 1;
        } else {
            $lgyzm = 0;
        }

        $this->assign('regyzm', $regyzm);
        $this->assign('lgyzm', $lgyzm);
        $member = new UserModel();
        if (request()->isPost()) {
//            if(in_array(2, $yzmarr)){
//                if(!captcha_check(input('code'))){
//                    return json(array('code' => 0, 'msg' => '验证码错误'));
//                }
//            }
//            $data = input('post.')
            $data = json_decode($_POST['data'], true);;
//            $status['status'] = array('gt', 0);
            //判断是邮箱还是用户名
            preg_match_all("/^[a-z0-9A-Z]+([-_.a-z0-9A-Z])*@([a-z0-9A-Z]+[-.])+.[a-zA-Z]{2,4}$/i", $data['username'], $pre);
            //console_log($pre[0]);
            if (!empty($pre[0])) {
                $user = $member->where('usermail', $data['username'])->find();
//                console_log("email");
            } else {
//                console_log("user");
                $user = $member->where('username', $data['username'])->find();
            }
            if (empty($user)) {
                return json(array('code' => 0, 'msg' => '账户不存在!'));

            }
            if ($user['status'] == 0) {
                return json(array('code' => 0, 'msg' => '账户还未激活！先激活！'));
            } else if ($user['status'] == -1) {
                return json(array('code' => 0, 'msg' => '您已经被管理员禁用！'));

            }
            if ($user) {

                $user = updategrade($user);
                if ($user['password'] == md5($data['pass'] . $user['salt'])) {

                    if ($user['userhead'] == '') {
                        $user['userhead'] = '/public/images/default.png';
                    }
                    //环信登录
                    $e = new Easemob($this->hx);
                    $token = $e->getUserToken($user['id']);
//                    console_log($token);
                    //写入session
                    session('userstatus', $user['status']);
                    session('grades', $user['grades']);
                    session('srkey', $user['password']);
                    session('userhead', $user['userhead']);
                    session('username', $user['username']);
                    session('point', $user['point']);
                    session('access_token', $token['access_token']);
                    session('id', $user['id']);
                    $cook = array('id' => $user['id'], 'status' => $user['status'], 'point' => $user['point'], 'username' => $user['username'], 'userhead' => $user['userhead'], 'grades' => $user['grades']);
                    systemSetKey($cook);
                    $member->update(
                        [
                            'last_login_time' => time(),
                            'last_login_ip' => $this->request->ip(),
                            'id' => $user['id']
                        ]
                    );
                    $score = point_note($site_config['point_login'], $user['id'], 'login');
                    if ($score > 0) {
                        $msg = '积分+' . $score;
                    } else {
                        $msg = '';
                    }
                    return json(array('code' => 200, 'msg' => '登录成功!' . $msg, 'id' => $user['id']));
                } else {
                    return json(array('code' => 0, 'msg' => '密码错误'));
                }
            } else {
                return json(array('code' => 0, 'msg' => '账号错误或已禁用'));
            }
        }
        return view();
    }

    public function test1()
    {
        echo alert_success('正在跳转..', 'user/index/reset', 1, array('code' => 'BO_wHKCcyp9bCM0rC7M4XtzMLrSIeAqzprY', 'token' => md5('89zcEa7k7cJ2h42zBm')));
        $data['id'] = 20;
        $data['regtime'] = '1546677473';
        $data['salt'] = '3leI5bdyasNxxSzgyO';

        $active_code = encrypt($data['id'] . ',' . $data['regtime'], $data['salt']);
        $re = decrypt($active_code, $data['salt']);
        $arr = explode(',', $re);
        var_dump($arr[0] . '\t\t' . $arr[1]);
    }

    /**发送激活邮件
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function send_active_code()
    {
        if ($this->request->isPost()) {
            $data = json_decode($_POST['data'], true);
            $res = send_code_to_email($data['usermail'], '考研网用户注册', $data['activeurl']);
            if ($res == true) {
                return json(array('code' => 200, 'msg' => '发送成功'));
            } else {
                Db::name('user')->where('usermail', $data['usermail'])->delete();
                return json(array('code' => 0, 'msg' => '发送失败，请检查邮箱是否可用'));
            }
        }
    }

    /**邮件中激活链接
     * @param string $code  激活码
     * @param string $token  激活token
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function active($code = '', $token = '')
    {
        if ($code == '' || $token == '') {
            return $this->error('亲！您迷路了！');

        }
//        $data['id']=19;
//        $data['regtime']='1546665902';
//        $data['salt']='RpINMG6qblkMeThbl9';
//
//        $active_code=encrypt($data['id'].','.$data['regtime'] ,$data['salt']);
//        var_dump($active_code);
//        $re=decrypt($active_code,$data['salt']);
//        $arr=explode(',',$re);
//        var_dump($arr[0].'\t\t'.$arr[1]);
        //解密
        $descode = decrypt($code, $token);
        $arr = explode(',', $descode);
        $member = new UserModel();
        $user = $member->where("activecode", $code)->find();
        if (!$user) {
//            return json(array('code'=>0,'msg'=>'用户名不存在！'));
            echo alert_success('用户名不存在', '#', 2);
        }
        if (empty($arr) || sizeof($arr) !== 2) {
//            return json(array('code'=>0,'msg'=>'链接不合法！'));
            echo alert_success('链接不合法', '#', 2);

        } else {
            $time = time();
//            var_dump($time);
//            var_dump($arr[1]);
            $user = $member->where("activecode", $code)->where('id', $arr[0])->find();
            if ($time - $arr[1] > 30 * 60) {
//                return json(array('code'=>0,'msg'=>'链接超时！请重新注册！'));
                echo alert_success('链接超时！请重新注册', '#', 2);

            } else if ($user) {
                if ($user['status'] == 1) {
//                    return join(array('code'=>0,'msg'=>'用户已经激活！请登录！'));
                    echo alert_success('用户已经激活', 'index/index/index', 0);

                } else {
                    Db::name('user')->where('id', $user['id'])->setField('status', 1);

                    $ea = new Easemob($this->hx);
                    $create_result = $ea->createUser($user['username'], $user['password'], $user['username']);
//                    return json(array('code'=>1,'msg'=>'激活成功！请登录！'));
                    echo alert_success('激活成功！请登录！', 'index/index/index', 1);

                }
            } else {
//                return json(array('code'=>0,'msg'=>'未知错误！'));
                echo alert_success('未知错误', '#', 2);
            }
        }
    }

    public function findpwd($code = '', $token = '')
    {
        if ($code == '' || $token == '') {
            return $this->error('亲！您迷路了！');

        }
        $descode = decrypt($code, $token);
        $arr = explode(',', $descode);
        $member = new UserModel();
        $user = $member->where("activecode", $code)->find();
        if (!$user) {
//            return json(array('code'=>0,'msg'=>'用户名不存在！'));
            echo alert_success('用户名不存在', '#', 2);
        }
        if (empty($arr) || sizeof($arr) !== 2) {
//            return json(array('code'=>0,'msg'=>'链接不合法！'));
            echo alert_success('链接不合法', '#', 2);

        } else {
            $time = time();
//            var_dump($time);
//            var_dump($arr[1]);
            $user = $member->where("activecode", $code)->where('id', $arr[0])->find();
            if ($time - $arr[1] > 30 * 60) {
//                return json(array('code'=>0,'msg'=>'链接超时！请重新注册！'));
                echo alert_success('链接超时！请重新发送', 'user/index/forget', 2);
            } else if ($user) {
                if ($user['status'] == 0) {
//                    return join(array('code'=>0,'msg'=>'用户已经激活！请登录！'));
                    echo alert_success('用户被禁用', '#', 0);

                } else {
                    $active_code = encrypt($user['id'] . ',' . $time, md5($user['salt']));
                    Db::name('user')->where('id', $user['id'])->setField('activecode', $active_code);
//                    return json(array('code'=>1,'msg'=>'激活成功！请登录！'));
                    echo alert_success('正在跳转..', 'user/index/reset', 1, array('code' => $active_code, 'token' => md5($user['salt'])));
                }
            } else {
//                return json(array('code'=>0,'msg'=>'未知错误！'));
                echo alert_success('链接不合法', '#', 2);

            }

        }

    }

    /**重置密码
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function resetpass()
    {
        $data = $this->request->param();
//        if(in_array(3, $this->yzmarr)){
//            if(!captcha_check(input('code'))){
//                return json(array('code' => 0, 'msg' => '验证码错误'));
//            }
//        }

        if ($data['pass'] != $data['repass']) {
            return json(array('code' => 0, 'msg' => '两次密码输入不一致'));
        } else {
            $n = Db::name('user')->where('id', $data['id'])->find();
            Db::name('user')->where('id', $data['id'])->setField('password', md5($data['pass'] . $n['salt']));

            $ea = new Easemob($this->hx);
            $create_result = $ea->resetPassword($n['username'], md5($data['pass'] . $n['salt']));

            return json(array('code' => 200, 'msg' => $create_result));
        }
    }

    public function reset($code = '', $token = '')
    {
        if ($code == '' || $token == '') {
            return $this->error('亲！您迷路了！', url('index/index/index'));

        }
        $descode = decrypt($code, $token);
        $arr = explode(',', $descode);
        $user = Db::name('user')->where('id', $arr[0])->find();
        $this->assign('id', $arr[0]);
        $this->assign('username', $user['username']);
        return view();
    }

    /**重置密码（没有邮件验证）
     * @param string $userid
     * @return mixed|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function reset_noemail($userid = '')
    {

        $userid = decrypt($userid, 'kyw');
        if (!is_numeric($userid) || $userid == '') {
            return $this->error('亲！您迷路了!!', url('index/index/index'));

        }

        $user = Db::name('user')->where('id', $userid)->find();
        if (empty($user)) {
            return $this->error('亲！您迷路了！', url('index/index/index'));

        }
        $this->assign('id', $userid);
        $this->assign('username', $user['username']);
        return $this->fetch('reset');
    }

    /***忘记密码
     * @return \think\response\Json|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function forget()
    {
        $site_config = Cache::get('site_config');
//var_dump($site_config['emailcheck']);
        $yzmarr = explode(',', $site_config['site_yzm']);
        if (in_array(3, $yzmarr)) {
            $fpyzm = 1;
        } else {
            $fpyzm = 0;
        }
        if (request()->isPost()) {
            $datan = $this->request->param();
//            if(in_array(3, $this->yzmarr)){
//                if(!captcha_check(input('code'))){
//                    return json(array('code' => 0, 'msg' => '验证码错误'));
//                }
//            }

            $n = Db::name('user')->where('usermail', $datan['usermail'])->find();

            if (empty($n) || ($n['status'] != 1)) {
                return json(array('code' => 0, 'msg' => '邮箱未激活或邮箱未注册'));
            } else if ($n['username'] !== $datan['username']) {
                return json(array('code' => 0, 'msg' => '用户名与绑定邮箱不匹配！'));
            } else {
                if ($site_config['emailcheck'] == 1) {
                    $time = time();
                    $active_code = encrypt($n['id'] . ',' . $time, md5($n['salt']));
                    Db::name('user')->where('id', $n['id'])->setField("activecode", $active_code);
                    $web_url = $_SERVER['HTTP_HOST'] . WEB_URL;
                    $active_url = "<h1>" . $n['username'] . ",你好！</h1><br><h1>重置密码:</h1><a href='http://" . $web_url . "/index.php/user/index/findpwd/code/" . $active_code . "/token/" . md5($n['salt']) . "'>点击重置密码</a>,有效期30分钟";
                    $res = send_code_to_email($n['usermail'], '考研网重置密码', $active_url);
                    if ($res == true) {
                        return json(array('code' => 200, 'msg' => '邮件已发送，请到邮箱进行查收', 'ise' => 1));

                    } else {
                        return json(array('code' => 0, 'msg' => '发送失败！请检查邮箱！'));

                    }
                } else {
                    return json(array('code' => 200, 'msg' => '填写正确！', 'ise' => 0, 'id' => encrypt($n['id'], 'kyw')));

                }

            }
        }
        $this->assign('fpyzm', $fpyzm);
        return view();
    }

    public function logout()
    {
        session("userstatus", NULL);
        session("userid", NULL);
        session("username", NULL);
        session("usermail", NULL);
        session("kouling", NULL);

        cookie('sys_key', null);
        return json(array('code' => 200, 'msg' => '退出成功'));
        //  return NULL;
    }


    public function set()
    {
//        if (!session('userid') || !session('username')) {
//            echo alert_success('请先登录', '#', 2);
//            //return json(array('code' => 0, 'msg' => '亲！请登录','url'=>url('login/index')));
//        } else {
        $member = new UserModel();
        $uid = session('userid');
        $tptc = $member->where(array('id' => $uid))->find();
        if (request()->isPost()) {
            $data = $this->request->post();
            $data['id'] = $uid;
            $validate_result = $this->validate($data, 'User');
            if ($validate_result !== true) {
                // $this->error($validate_result);
                return json(array('code' => 0, 'msg' => $validate_result
                ));
            } else {
                $data['userhome'] = remove_xss($data['userhome']);
                $data['description'] = remove_xss($data['description']);
                if ($member->save($data, ['id' => $uid])) {
                    return json(array('code' => 200, 'msg' => '修改成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '修改失败'));
                }
            }
        }
        $this->assign('tptc', $tptc);
        $this->assign('uid', $uid);
        return view();
//        }
    }


    public function setedit()
    {
        if (!session('userid') || !session('username')) {
            echo alert_success('请先登录', '#', 2);

        } else {
            $member = new UserModel();
            $uid = session('userid');
            $tptc = $member->find($uid);
            if (request()->isPost()) {
                $data = $this->request->post();
                $validate_result = $this->validate($data, 'User.passwordedit');
                if ($validate_result !== true) {
                    // $this->error($validate_result);
                    return json(array('code' => 0, 'msg' => $validate_result
                    ));
                } else {
                    if ($data['password'] == $data['nowpass']) {
                        return json(array('code' => 0, 'msg' => '密码未修改'));
                    }
                    if ($tptc['password'] != md5($data['nowpass'] . $tptc['salt'])) {
                        return json(array('code' => 0, 'msg' => '原始密码错误'));
                    } else {
                        $datam['password'] = md5($data['password'] . $tptc['salt']);
                        if ($member->save($datam, ['id' => $uid])) {
                            return json(array('code' => 200, 'msg' => '修改成功'));
                        } else {
                            return json(array('code' => 0, 'msg' => '修改失败'));
                        }
                    }
                }
            }
//            $this->assign('tptc', $tptc);
//            return view();
        }
    }

    /**头像
     * @return \think\response\Json|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function headedit()
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录', url('index/index/index'));
        } else {
            $member = new UserModel();
            $uid = session('userid');
            if (request()->isPost()) {
                $data = $this->request->post();
                if ($member->allowField(['userhead'])->save($data, ['id' => $uid])) {
                    session('userhead', $data['userhead']);
                    return json(array('code' => 200, 'msg' => '修改成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '修改失败'));
                }
            }
            $tptc = $member->find($uid);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    /**照片墙
     * @return \think\response\Json|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function photoedit()
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录', url('index/index/index'));
        } else {
            $member = new UserModel();
            $uid = session('userid');
            if (request()->isPost()) {
                $data = $this->request->post();
                if ($member->allowField(['photowall'])->save($data, ['id' => $uid])) {
                    session('photowall', $data['photowall']);
                    return json(array('code' => 200, 'msg' => '修改成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '修改失败'));
                }
            }
            $tptc = $member->find($uid);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    public function resetmail()
    {
        $mail = $this->request->param();
        $uid = session('userid');
        $user = db('user')->where(array('id' => $uid))->find();

        $mailarr = db('user')->column('usermail');
        if (in_array($mail['email'], $mailarr) && $user['usermail'] != $mail['email']) {
            return json(array('code' => 0, 'msg' => '该邮箱已经被其他账号注册'));
        } else {
            $time = time();
            $active_code = encrypt($uid . ',' . $time, md5($user['salt']));
            Db::name('user')->where('id', $user['id'])->setField("activecode", $active_code);

            $web_url = $_SERVER['HTTP_HOST'] . WEB_URL;
            $active_url = "<h1>" . $user['username'] . ",你好！</h1><br><h1>激活邮箱:</h1><a href='http://" . $web_url . "/index.php/user/index/resetmailres/code/" . $active_code . "/token/" . md5($user['salt']) . "/email/" . $mail['email'] . "'>点击激活邮箱</a>,有效期30分钟";
            $res = send_code_to_email($mail['email'], '考研网邮箱更改', $active_url);
            if ($res == true) {
                return json(array('code' => 200, 'msg' => '邮箱登录已更改为新邮箱，请到邮箱查收验证'));
            } else {
                return json(array('code' => 0, 'msg' => '发送失败！请检查邮箱！'));
            }
        }
    }

    public function resetmailres($code, $token, $email)
    {
        $descode = decrypt($code, $token);
        $arr = explode(',', $descode);
        $member = new UserModel();
        $user = $member->where("activecode", $code)->find();
        if (!$user) {
//            return json(array('code'=>0,'msg'=>'用户名不存在！'));
            echo alert_success('用户名不存在', '#', 2);
        }
        if (empty($arr) || sizeof($arr) !== 2) {
//            return json(array('code'=>0,'msg'=>'链接不合法！'));
            echo alert_success('链接不合法', '#', 2);
        } else {
            $time = time();
//            var_dump($time);
//            var_dump($arr[1]);
            $user = $member->where("activecode", $code)->where('id', $arr[0])->find();
            if ($time - $arr[1] > 30 * 60) {
//                return json(array('code'=>0,'msg'=>'链接超时！请重新注册！'));
                echo alert_success('链接超时！请重新发送', '#', 2);
            } else if ($user) {
                if ($user['status'] == -1) {
//                    return join(array('code'=>0,'msg'=>'用户已经激活！请登录！'));
                    echo alert_success('用户被禁用', '#', 0);
                } else {
                    $active_code = encrypt($user['id'] . ',' . $time, md5($user['salt']));
                    Db::name('user')->where('id', $user['id'])->setField('usermail', $email);
                    Db::name('user')->where('id', $user['id'])->setField('activecode', $active_code);
                    session("userstatus", NULL);
                    session("userid", NULL);
                    session("username", NULL);
                    session("usermail", NULL);
                    session("kouling", NULL);
                    cookie('sys_key', null);
                    echo alert_success('激活成功！', 'index/index/index', 1);
                }
            } else {
//                return json(array('code'=>0,'msg'=>'未知错误！'));
                echo alert_success('未知错误', '#', 2);
            }
        }
    }

    public function topic()
    {
        if (!session('userid') || !session('username')) {
            return $this->error('亲！请登录', url('index/index/index'));
        } else {
            $forum = Db::name('forum');
            $uid = session('userid');
            $count = $forum->where("uid = {$uid}")->count();
            $tptc = $forum->where("uid = {$uid}")->order('id desc')->paginate(10);
            $this->assign('tptc', $tptc);
            $this->assign('uid', $uid);
            $this->assign('count', $count);
            return view();
        }

    }

    public function message()
    {
        if (!session('userid') || !session('username')) {
            return $this->error('亲！请登录', url('index/index/index'));
        } else {
            //$readmessage = Db::name('readmessage');
            $uid = session('userid');
            $arr = Db::name('readmessage')->alias('rm')->where(array('uid' => $uid))->column('mid');
            if (!empty($arr)) {
                //	$arrimplode=implode(',', $arr);
                $tptc = Db::name('message')->alias('me')->join('user u', 'me.uid=u.id', 'LEFT')->field('me.*,u.id as userid,u.username')
                    ->where('me.touid', ['=', 0], ['=', $uid], 'or')
                    ->where('me.id', 'not in', $arr)
                    ->order('me.time desc')->paginate(5);
                //  	$tptc = Db::name('message')->alias('me')->join('user u', 'me.uid=u.id','LEFT')->field('me.*,u.id as userid,u.username')->where(array('me.touid'=>0))->where('me.id','not in',$arr)->whereOr(array('me.touid'=>$uid))->order('me.time desc')->paginate(5);
                //  dump( Db::name('message'));
            } else {
                $tptc = Db::name('message')->alias('me')->join('user u', 'me.uid=u.id', 'LEFT')->field('me.*,u.id as userid,u.username')->where('me.touid', $uid)->whereOr('me.touid', 0)->order('me.time desc')->paginate(5);

            }
            $this->assign('tptc', $tptc);
            $this->assign('uid', $uid);
            return view();
        }
    }

    /**我的消息
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delallmessage()
    {
        $uid = session('userid');
        $tptc = Db::name('message')->where(array('touid' => 0))->column('id');
        $tptc1 = array();
        $tptc1 = Db::name('readmessage')->where(array('uid' => $uid))->column('mid');
        if (Db::name('message')->where(array('touid' => $uid))->count() > 0) {
            if (Db::name('message')->where(array('touid' => $uid))->delete()) {
                if (!empty($tptc)) {
                    foreach ($tptc as $k => $v) {
                        if (!in_array($v, $tptc1)) {
                            $messdata['uid'] = $uid;
                            $messdata['mid'] = $v;
                            Db::name('readmessage')->insert($messdata);
                        }
                    }
                }
                //$this->success('删除成功');
                return json(array('code' => 200, 'msg' => '删除成功'));
            } else {
                // $this->error('删除失败');
                return json(array('code' => 0, 'msg' => '删除失败'));
            }
        } else {
            if (!empty($tptc)) {
                if (count($tptc) != count($tptc1)) {
                    foreach ($tptc as $k => $v) {
                        if (!in_array($v, $tptc1)) {
                            $messdata['uid'] = $uid;
                            $messdata['mid'] = $v;
                            Db::name('readmessage')->insert($messdata);
                        }
                    }
                    return json(array('code' => 200, 'msg' => '删除成功'));
                } else {
                    return json(array('code' => 0, 'msg' => '您无任何消息可删除'));
                }
            } else {
                return json(array('code' => 0, 'msg' => '您无任何消息可删除'));
            }
        }
    }

    public function delsysmessage($id = 0)
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录', url('index/index/index'));
        } else {
            if ($id == 0) {
                return json(array('code' => 0, 'msg' => '亲！您迷路了！'));

            }
            $uid = session('userid');
            $messdata['uid'] = $uid;
            $messdata['mid'] = $id;
            if (Db::name('readmessage')->insert($messdata)) {
                return json(array('code' => 200, 'msg' => '删除成功'));
            } else {
                return json(array('code' => 0, 'msg' => '删除失败'));
            }
        }

    }

    public function delmessage($id = 0)
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录', url('index/index/index'));
        } else {
            if ($id == 0) {
                return json(array('code' => 0, 'msg' => '亲！您迷路了！'));
            }
            if (Db::name('message')->delete($id)) {
                //$this->success('删除成功');
                return json(array('code' => 200, 'msg' => '删除成功'));
            } else {
                // $this->error('删除失败');
                return json(array('code' => 0, 'msg' => '删除失败'));
            }
        }

    }

    public function comment()
    {
        if (!session('userid') || !session('username')) {
            $this->error('亲！请登录', url('index/index/index'));
        } else {
            $comment = Db::name('comment');
            $uid = session('userid');
            $tptc = $comment->alias('c')->join('forum f', 'f.id=c.fid')->field('c.*,f.title')->where("c.uid = {$uid}")->order('c.id desc')->paginate(5);
            $this->assign('tptc', $tptc);
            $this->assign('uid', $uid);
            return view();
        }
    }

    public function myforum($uid = 0, $page = 1)
    {

        if (empty($uid) || $uid == 0) {
            return $this->error('亲！你迷路了');
        } else {
            $member = new UserModel();
            $m = $member->where("id = {$uid}")->find();
            if ($m) {
                $f = Db::name('forum')->alias('f')->join('forumcate c', 'c.id=f.tid')
                    ->where('uid', $uid)->order('time desc')->field('c.name as cname, f.*')->paginate(10);

                $this->assign('f', $f);
                $this->assign('m', $m);
            } else {
                return $this->error('亲！你迷路了');

            }


        }

        return $this->fetch();
    }

    public function mycourse($uid = 0, $page = 1)
    {

        if (empty($uid) || $uid == 0) {
            return $this->error('亲！你迷路了');
        } else {
            $member = new UserModel();
            $m = $member->where("id = {$uid}")->find();
            if ($m) {
                $course = Db::name('user_course')->alias('uc')->join('course c', 'uc.cid=c.id')
                    ->join('course_video_collection v', 'v.id=uc.vid')
                    ->where('uid', $uid)->whereNotIn('vid', [0])
                    ->order('c.id asc')
                    ->field('c.name as cname ,c.pic as cpic,c.teacher,c.star as cstar,c.classhour,v.name as vname ,uc.*')->paginate(10);
                console_log($course);
                $this->assign('course', $course);
                $this->assign('m', $m);
            } else {
                return $this->error('亲！你迷路了');

            }


        }

        return $this->fetch();
    }

    public function mynote($uid = 0, $page = 1)
    {

        if (empty($uid) || $uid == 0) {
            return $this->error('亲！你迷路了');
        } else {
            $member = new UserModel();
            $m = $member->where("id = {$uid}")->find();
            if ($m) {

                $note = Db::name('course_note')->alias('n')->join('course_video_collection v', 'v.id=n.vid')
                    ->join('course c', 'v.cid=c.id')->where('n.uid', $uid)->field('n.* ,v.name as vname ,c.id as cid,c.name as cname')->paginate(10);
                $this->assign('note', $note);
                $this->assign('m', $m);
            } else {
                return $this->error('亲！你迷路了');

            }


        }

        return $this->fetch();
    }

    public function home()
    {
        $uid = session('userid');
        $id = input('id');
        if (empty($id)) {
            return $this->error('亲！你迷路了');
        } else {
            $member = new UserModel();
            $m = $member->where("id = {$id}")->find($id);
            $datainfo['type'] = 0;
            $datainfo['uid'] = $uid;
            $datainfo['sid'] = $id;
            $iszan = 0;
            $n = Db::name('zan')->where($datainfo)->order('time', 'desc')->limit(1)->find();
            if ((!empty($uid)) && time() - $n['time'] < 24 * 60 * 60) {
                $iszan = 1;
            }
            if ($m) {
                $this->assign('m', $m);
                $this->assign('iszan', $iszan);
                $forum = Db::name('forum');
                $map['open'] = 1;
                $map['uid'] = $id;
                //帖子
                $tptc = $forum->where($map)->order('id desc')->limit(10)->select();

                $this->assign('tptc', $tptc);
                $comment = Db::name('comment');
                //评论
                $tpte = $comment->alias('c')->join('forum f', 'f.id=c.fid')->field('c.*,f.title')->where("c.uid = {$id}")->order('c.id desc')->limit(5)->select();
                $this->assign('tpte', $tpte);
                //课程
                $course = Db::name('user_course')->alias('uc')->join('course c', 'uc.cid=c.id')
                    ->join('course_video_collection v', 'v.id=uc.vid')
                    ->where('uid', $id)->whereNotIn('vid', [0])
                    ->order('c.id asc')
                    ->field('c.name as cname ,v.name as vname ,uc.*')->limit(10)->select();
                //笔记
                $note = Db::name('course_note')->alias('n')->join('course_video_collection v', 'v.id=n.vid')
                    ->join('course c', 'v.cid=c.id')->where('n.uid', $uid)->field('n.* ,v.name as vname ,c.id as cid,c.name as cname')->limit(5)->select();
                $this->assign('course', $course);
                $this->assign('note', $note);
                return view();
            } else {
                return $this->error('亲！你迷路了');
            }
        }
    }

    public function zan()
    {
        $data = $this->request->param();
        $uid = session('userid');
        if (!session('userid') || !session('username')) {
            return json(array('code' => 0, 'msg' => '请先登录'));
        } else {
            $datainfo['type'] = 0;
            $datainfo['uid'] = $uid;
            $datainfo['sid'] = $data['id'];
            $n = Db::name('zan')->where($datainfo)->order('time', 'desc')->limit(1)->find();
            $datainfo['time'] = time();
            if ($uid == $data['id']) {
                return json(array('code' => 0, 'msg' => '您不能赞自己哟'));

            } else if ($datainfo['time'] - $n['time'] < 24 * 60 * 60) {
                return json(array('code' => 0, 'msg' => '您已经在24小时内赞过该用户，明天试试把'));
            } else {
                if (Db::name('zan')->insert($datainfo)) {
                    Db::name('user')->where('id', $data['id'])->setInc('zan');
                    return json(array('code' => 200, 'msg' => '操作成功'));
                } else {
                    ;
                    return json(array('code' => 0, 'msg' => '操作失败'));
                }

            }


        }


    }

    function chatinit($id)
    {
        $uid = session('userid');
            if (!session('userid') || !session('username')) {
            return json(array('code' => -1, 'msg' => '请先登录'));
        } else {

        $res =  array(
            "username"=>\session('username') //我的昵称
      ,"id"=> session('username')  //我的ID
      ,"status"=> "online" //在线状态 online：在线、hide：隐身
      ,"sign"=>"考研网 " //我的签名
      ,"avatar"=> session('userhead')  //我的头像
        ) ;
        }
        return json($res);
    }

    /**添加聊天记录到数据库
     * @return string|\think\response\Json
     */
    function addChatLog()
    {
        if ($this->request->isPost()) {

            $data = $this->request->post();
            $data['from'] = session('userid');
            $data['sendTime'] = time();
            if (!$data['from']) {
                $res['code'] = -1;
                return json_encode($res);
            }

                $res = Db::name('chatlog')->insert($data);
                if ($res) {
                    return json(array('code' => 200, 'msg' => '操作成功'));

                } else {
                    return json(array('code' => 0, 'msg' => '操作失败'));

                }
        }


    }

    /**获取聊天记录
     * @param string $id
     * @param int $page
     * @param int $type
     * @return \think\response\Json
     */
function getChatLog($id='',$page=1,$type=1){
    $uname = session('userid');
    $to['c.to']=['=',$uname];

    $rows = 10;//每页显示数量
    $select_from = ($page-1) * $rows;
    $to['c.from']=['=',$id];
    $from['c.to']=['=',$id];
    $from['c.from']=['=',$uname]    ;
    $ChatLog=sqlQuery("SELECT  `c`.`content`,c.sendTime as timestamp,`c`.`from`,u1.userhead as fromhead,u1.id as fromid,
u1.username as fromName,u2.userhead as tohead,u2.id as toid,u2.username as toName 
FROM `chatlog` `c` INNER JOIN `user` `u1` ON `u1`.`id`=`c`.`from` INNER JOIN `user` `u2` ON `u2`.`id`=`c`.`to` 
WHERE(  `c`.`to` = '{$uname}' AND `c`.`from` = '{$id}' )  OR ( `c`.`to` = '{$id}' AND `c`.`from` = '{$uname}') limit {$select_from} , {$rows}   ");
//获取记录数
$count= sqlQuery("SELECT   count(*) as count
FROM `chatlog` `c` INNER JOIN `user` `u1` ON `u1`.`id`=`c`.`from` INNER JOIN `user` `u2` ON `u2`.`id`=`c`.`to` 
WHERE(  `c`.`to` = '{$uname}' AND `c`.`from` = '{$id}' )  OR ( `c`.`to` = '{$id}' AND `c`.`from` = '{$uname}')   ");


    if ($ChatLog) {
        $res['code'] = 0;
    }else{
        $res['code'] = -1;
    }
    $res['limit'] =$rows;
    $res['count'] =$count[0]['count'];
    $res['data'] = $ChatLog;
    return  json($res);

}
//获取用户信息
function  getuserinfo($uname=''){
        if ($uname==''){
            return json(array('code'=>0));
        }
        $res=Db::name('user')->where('username',$uname)->field('userhead,id')->find();
        if (empty($res)){
            return json(array('code'=>0));

        }else{
            return json(array('code'=>200,'data'=>$res));

        }

}
    function test()
    {
        return $this->fetch();
    }
//    public function  loginiframe(){
//
//        return $this->fetch();
//    }
}