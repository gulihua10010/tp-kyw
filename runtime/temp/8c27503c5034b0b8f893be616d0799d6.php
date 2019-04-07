<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"E:\phpStudy\WWW\kyw/application/admin\view\site_config.html";i:1549102768;s:52:"E:\phpStudy\WWW\kyw\application\admin\view\base.html";i:1548150336;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>后台管理</title>
		<link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="/kyw/public/css/main.css"  media="all"  />
	
    
   
    <!--[if lt IE 9]>
    <script src="/kyw/static/css/html5shiv.min.js"></script>
    <script src="/kyw/static/css/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/kyw/public/plugins/layui/layui.js"></script>
</head>
<body>

    <!--主体-->
    <div style="margin-bottom:36px;">
      


<style type="text/css">
    .tpt_sels a {
        padding-right: 15px;
        position: relative
    }

    .tpt_sels a {
        padding: 0 20px 0 8px;
        color: #3B6268;
        background: #FFFFBA;
        border: 1px #F8E06E solid;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 14px;
        height: 26px;
        line-height: 26px;
        display: block;
        float: left
    }

    .tpt_sels a em {
        width: 12px;
        height: 12px;
        font-style: normal;
        display: block;
        position: absolute;
        top: 7px;
        right: 4px;
        z-index: 2;
        background: url(/kyw/public/images/sx.png) no-repeat 0 0;
    }
</style>

<!--tab标签-->
<div class="layui-tab layui-tab-brief">
    <ul class="layui-tab-title">
        <li class="layui-this">基本配置</li>
        <li>用户配置</li>
        <li>积分规则配置</li>
        <li>首页幻灯片</li>
        <li >邮箱配置</li>
    </ul>


    <form class="layui-form form-container layui-tab-content" id="layui-form"
          localtion-url="<?php echo url('admin/system/siteConfig'); ?>">

        <div class="layui-tab-item layui-show">

            <div class="layui-form-item">
                <label class="layui-form-label">网站标题</label>
                <div class="layui-input-inline">
                    <input type="text" name="site_config[site_title]" value="<?php echo (isset($site_config['site_title']) && ($site_config['site_title'] !== '')?$site_config['site_title']:''); ?>"
                           required lay-verify="required" placeholder="请输入网站标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO标题</label>
                <div class="layui-input-block">
                    <input type="text" name="site_config[seo_title]" value="<?php echo (isset($site_config['seo_title']) && ($site_config['seo_title'] !== '')?$site_config['seo_title']:''); ?>"
                           placeholder="请输入SEO标题" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO关键字</label>
                <div class="layui-input-block">
                    <input type="text" name="site_config[seo_keyword]" value="<?php echo (isset($site_config['seo_keyword']) && ($site_config['seo_keyword'] !== '')?$site_config['seo_keyword']:''); ?>"
                           placeholder="请输入SEO关键字" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SEO说明</label>
                <div class="layui-input-block">
                    <textarea name="site_config[seo_description]" placeholder="请输入SEO说明" class="layui-textarea"><?php echo (isset($site_config['seo_description']) && ($site_config['seo_description'] !== '')?$site_config['seo_description']:''); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">网站logo</label>
                <div class="layui-input-inline">
                    <button type="button" class="layui-btn" id="logo">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <input type="text" class="layui-input" id="logo-input"  name="site_config[logo]" value="<?php echo (isset($site_config['logo']) && ($site_config['logo'] !== '')?$site_config['logo']:''); ?>"
                           style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                </div>
            </div>
            <div class="layui-form-item"  id="pre-logo" style="<?php if($site_config['logo'] == ''): ?> display: none;<?php endif; ?>margin:20px ;position: relative;top:20px;">
                <label class="layui-form-label">logo预览</label>
                <img id="uploaded-logo"  width="300" src="/kyw<?php echo $site_config['logo']; ?>"   >
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">会员注册</label>
                <div class="layui-input-inline">
                    <input type="radio" name="site_config[user_reg]" value="1" title="开启" <?php if($site_config['user_reg'] == 1): ?>checked<?php endif; ?>>
                    <input type="radio" name="site_config[user_reg]" value="0" title="关闭" <?php if($site_config['user_reg'] == 0): ?>checked<?php endif; ?>>
                </div>
            </div>


            <div class="layui-form-item">
                <div>
                    <label class="layui-form-label">验证码场景</label>
                    <div class="layui-input-inline">
                        <input type="text" name="site_config[site_yzm]" value="<?php echo (isset($site_config['site_yzm']) && ($site_config['site_yzm'] !== '')?$site_config['site_yzm']:''); ?>"
                               required lay-verify="required" placeholder="验证码场景" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>
                <div class="label-tint">1\注册2\登录3\忘记密码4\后台登录[填写数字时用半角括号隔开，否则无效。如1,2]</div>
            </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱验证</label>
            <div class="layui-input-block">
                <input type="radio" name="site_config[emailcheck]" value="1" title="开启" <?php if($site_config['emailcheck'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="site_config[emailcheck]" value="0" title="关闭" <?php if($site_config['emailcheck'] == 0): ?>checked<?php endif; ?>>
            </div>
        </div>
            <div class="layui-form-item">
                <label class="layui-form-label">开启路由</label>
                <div class="layui-input-block">
                    <input type="radio" name="site_config[site_route]" value="1" title="开启" <?php if($site_config['site_route'] == 1): ?>checked<?php endif; ?>>
                    <input type="radio" name="site_config[site_route]" value="0" title="关闭" <?php if($site_config['site_route'] == 0): ?>checked<?php endif; ?>>
                </div>
            </div>

            <div class="tpt_item">
                <input type="hidden" id="sitekeyword" name="site_config[site_keyword]"
                       value="<?php echo $site_config['site_keyword']; ?>">
                <div id="tpt_sel" class="tpt_sels" style="margin-top: 20px;">
		<span style="margin-bottom: 5px;float: left;margin-left: 110px;">
		<?php if($site_config['site_keyword'] != ''): $arr=explode(',', $site_config['site_keyword']);foreach ($arr as $k=>
            $v){echo "<a href='javascript:;'>$v<em></em></a>";}endif; ?>
		</span>
                    <div class="layui-form-item" style="margin-bottom: 20px;">
                        <label class="layui-form-label">标签</label>
                        <div class="layui-input-block">
                            <input id="tpt_input" type="text" value="" autocomplete="off" class="layui-input"
                                   style="width: 400px;float: left;margin-right: 20px;">
                            <button class="layui-btn" id="tpt_btn" type="button" style="background: #FF5722;">添加标签
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="layui-form-item">
                <label class="layui-form-label">版权信息</label>
                <div class="layui-input-block">
                    <input type="text" name="site_config[site_copyright]"
                           value="<?php echo (isset($site_config['site_copyright']) && ($site_config['site_copyright'] !== '')?$site_config['site_copyright']:''); ?>" placeholder="请输入版权信息" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">ICP备案号</label>
                <div class="layui-input-block">
                    <input type="text" name="site_config[site_icp]" value="<?php echo (isset($site_config['site_icp']) && ($site_config['site_icp'] !== '')?$site_config['site_icp']:''); ?>"
                           placeholder="请输入版权信息" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">统计代码</label>
                <div class="layui-input-block">
                    <textarea name="site_config[site_tongji]" placeholder="请输入统计代码" class="layui-textarea"><?php echo (isset($site_config['site_tongji']) && ($site_config['site_tongji'] !== '')?$site_config['site_tongji']:''); ?></textarea>
                </div>
            </div>


        </div>
        <div class="layui-tab-item">

            <div class="layui-form-item">
                <div>
                    <label class="layui-form-label">用户名保留</label>
                    <div class="layui-input-inline">
                        <input type="text" name="site_config[baoliu]" value="<?php echo (isset($site_config['baoliu']) && ($site_config['baoliu'] !== '')?$site_config['baoliu']:''); ?>"
                               placeholder="不允许注册用户名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="label-tint">可设置多个用户不允许注册的昵称，填写时用半角括号隔开</div>
            </div>
        </div>
        <div class="layui-tab-item">
            <div class="layui-form-item">
                <label class="layui-form-label">积分名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="site_config[point_name]" value="<?php echo (isset($site_config['point_name']) && ($site_config['point_name'] !== '')?$site_config['point_name']:'积分'); ?>"
                           placeholder="请填写积分的别名" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">注册</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_reg]" value="<?php echo (isset($site_config['point_reg']) && ($site_config['point_reg'] !== '')?$site_config['point_reg']:'0'); ?>"
                           placeholder="请填写整数" autocomplete="off" class="layui-input">
                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">登录</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_login]" value="<?php echo (isset($site_config['point_login']) && ($site_config['point_login'] !== '')?$site_config['point_login']:'0'); ?>"
                           placeholder="请填写整数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发布帖子</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_write]" value="<?php echo (isset($site_config['point_write']) && ($site_config['point_write'] !== '')?$site_config['point_write']:'0'); ?>"
                           placeholder="请填写整数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">回复帖子</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_reply]" value="<?php echo (isset($site_config['point_reply']) && ($site_config['point_reply'] !== '')?$site_config['point_reply']:'0'); ?>"
                           placeholder="请填写整数" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">资源下载</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_download]"
                           value="<?php echo (isset($site_config['point_download']) && ($site_config['point_download'] !== '')?$site_config['point_download']:'0'); ?>" placeholder="请填写整数" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">资源上传</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[point_upload]"
                           value="<?php echo (isset($site_config['point_upload']) && ($site_config['point_upload'] !== '')?$site_config['point_upload']:'0'); ?>" placeholder="请填写整数" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">评论</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[comment]"
                           value="<?php echo (isset($site_config['comment']) && ($site_config['comment'] !== '')?$site_config['comment']:'0'); ?>" placeholder="请填写整数" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">回答问题</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[answer]"
                           value="<?php echo (isset($site_config['answer']) && ($site_config['answer'] !== '')?$site_config['answer']:'0'); ?>" placeholder="请填写整数" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">提出问题</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[ask]"
                           value="<?php echo (isset($site_config['ask']) && ($site_config['ask'] !== '')?$site_config['ask']:'0'); ?>" placeholder="请填写整数" autocomplete="off"
                           class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">记笔记</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[note]" value="<?php echo (isset($site_config['note']) && ($site_config['note'] !== '')?$site_config['note']:'0'); ?>"
                           placeholder="请填写整数" autocomplete="off" class="layui-input">
                </div>
            </div>
        </div>
        <div class="layui-tab-item">

            <div class="layui-form-item">
                <div class="label-tint">至少4张幻灯片</div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片1</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt1">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" class="layui-input" id="ppt1-input"  name="site_config[ppt1]" value="<?php echo (isset($site_config['ppt1']) && ($site_config['ppt1'] !== '')?$site_config['ppt1']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div> <div class="layui-input-inline">
                        <input type="text"     placeholder="链接" class="layui-input"
                               name="site_config[ppt1_url]" value="<?php echo (isset($site_config['ppt1_url']) && ($site_config['ppt1_url'] !== '')?$site_config['ppt1_url']:''); ?>"
                               lay-verify="required"></div>  </div>
                    <div class="label-tint">请输入全url(http://localhost:8080/kyw?id=1形式)</div>

                </div>
                <div class="layui-form-item" id="pre-ppt1" <?php if($site_config['ppt1'] == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt1"  width="300" src="/kyw<?php echo $site_config['ppt1']; ?>" >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片2</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt2">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" class="layui-input"  id="ppt2-input"   name="site_config[ppt2]" value="<?php echo (isset($site_config['ppt2']) && ($site_config['ppt2'] !== '')?$site_config['ppt2']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div> <div class="layui-input-inline">
                        <input type="text"  name="site_config[ppt2_url]" value="<?php echo (isset($site_config['ppt2_url']) && ($site_config['ppt2_url'] !== '')?$site_config['ppt2_url']:''); ?>"
                               placeholder="链接" class="layui-input"  lay-verify="required"></div>  </div>

                </div>
                <div class="layui-form-item" id="pre-ppt2" <?php if($site_config['ppt2'] == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt2"  width="300"  src="/kyw<?php echo $site_config['ppt2']; ?>" >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片3</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt3">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text" class="layui-input"  id="ppt3-input"  name="site_config[ppt3]" value="<?php echo (isset($site_config['ppt3']) && ($site_config['ppt3'] !== '')?$site_config['ppt3']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div> <div class="layui-input-inline">
                        <input type="text"  name="site_config[ppt3_url]" value="<?php echo (isset($site_config['ppt3_url']) && ($site_config['ppt3_url'] !== '')?$site_config['ppt3_url']:''); ?>"
                               placeholder="链接" class="layui-input"  lay-verify="required"></div>  </div>
                </div>
                <div class="layui-form-item" id="pre-ppt3" <?php if($site_config['ppt3']  == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt3"  width="300"   src="/kyw<?php echo $site_config['ppt3']; ?>">
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片4</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt4">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text"  class="layui-input"  id="ppt4-input"  name="site_config[ppt4]" value="<?php echo (isset($site_config['ppt4']) && ($site_config['ppt4'] !== '')?$site_config['ppt4']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div> <div class="layui-input-inline">
                        <input type="text"  placeholder="链接" class="layui-input"
                               name="site_config[ppt4_url]" value="<?php echo (isset($site_config['ppt4_url']) && ($site_config['ppt4_url'] !== '')?$site_config['ppt4_url']:''); ?>"
                               lay-verify="required"></div>  </div>
                </div>
                <div class="layui-form-item" id="pre-ppt4" <?php if($site_config['ppt4'] == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt4"  width="300"   src="/kyw<?php echo $site_config['ppt4']; ?>" >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片5</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt5">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text"  class="layui-input" id="ppt5-input"  name="site_config[ppt5]" value="<?php echo (isset($site_config['ppt5']) && ($site_config['ppt5'] !== '')?$site_config['ppt5']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;" >
                    </div>
                </div>
                <div class="layui-form-item">
                <label class="layui-form-label"> </label>
                <div> <div class="layui-input-inline">
                    <input type="text" name="site_config[ppt5_url]" value="<?php echo (isset($site_config['ppt5_url']) && ($site_config['ppt5_url'] !== '')?$site_config['ppt5_url']:''); ?>"
                           placeholder="链接" class="layui-input"></div>  </div>
            </div>
                <div class="layui-form-item" id="pre-ppt5" <?php if($site_config['ppt5'] == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt5"   width="300"  src="/kyw<?php echo $site_config['ppt5']; ?>" >
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">幻灯片6</label>
                    <div class="layui-input-inline">
                        <button type="button" class="layui-btn" id="ppt6">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="text"  class="layui-input"  id="ppt6-input"  name="site_config[ppt6]" value="<?php echo (isset($site_config['ppt6']) && ($site_config['ppt6'] !== '')?$site_config['ppt6']:''); ?>"
                               style="position: absolute;left: 111px;top: 0px;width: 500px;"  >
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div> <div class="layui-input-inline">
                        <input type="text" name="site_config[ppt6_url]" value="<?php echo (isset($site_config['ppt6_url']) && ($site_config['ppt6_url'] !== '')?$site_config['ppt6_url']:''); ?>"
                               placeholder="链接" class="layui-input"></div>  </div>
                </div>
                <div class="layui-form-item" id="pre-ppt6" <?php if($site_config['ppt6'] == ''): ?> style="display: none"><?php endif; ?>
                    <label class="layui-form-label">图片预览</label>
                    <img id="uploaded-ppt6"   width="300"  src="/kyw<?php echo $site_config['ppt6']; ?>" >
                </div>
            </div>
        </div>
        <div class="layui-tab-item">

            <div class="layui-form-item">
                <label class="layui-form-label">SMTP 服务器</label>
                <div class="layui-input-inline">
                    <input type="text" name="site_config[smtp]" value="<?php echo (isset($site_config['smtp']) && ($site_config['smtp'] !== '')?$site_config['smtp']:''); ?>" placeholder="SMTP 服务器" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">SMTP服务器的端口号</label>
                <div class="layui-input-inline">
                    <input type="number" name="site_config[smtp_port]" value="<?php echo (isset($site_config['smtp_port']) && ($site_config['smtp_port'] !== '')?$site_config['smtp_port']:''); ?>" placeholder="SMTP服务器的端口号" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"> SMTP服务器用户名</label>
                <div class="layui-input-inline">
                    <input type="text" name="site_config[smtp_user]" value="<?php echo (isset($site_config['smtp_user']) && ($site_config['smtp_user'] !== '')?$site_config['smtp_user']:''); ?>" placeholder="SMTP服务器用户名" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">SMTP服务器密码</label>
                <div class="layui-input-inline">
                    <input type="text" name="site_config[smtp_pwd]" value="<?php echo (isset($site_config['smtp_pwd']) && ($site_config['smtp_pwd'] !== '')?$site_config['smtp_pwd']:''); ?>" placeholder="SMTP服务器密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">测试地址</label>
                <div class="layui-input-inline">
                    <input type="text" id="J_email" name="site_config[smtp_test_tomail]" value="<?php echo (isset($site_config['smtp_test_tomail']) && ($site_config['smtp_test_tomail'] !== '')?$site_config['smtp_test_tomail']:''); ?>" placeholder="邮件地址为空时，默认使用后台默认邮件测试地址" autocomplete="off" class="layui-input">

                </div>
                <input type="button" id="mail-test" value="发送测试邮件" class="layui-btn layui-btn-small">
            </div>


        </div>
        <div class="btable-paged">
            <div class="layui-main">
                <div class="formbtngroup">
                    <button class="layui-btn layui-btn-small" lay-submit="" lay-filter="formadd">提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary layui-btn-small">重置</button>
                </div>
            </div>
        </div>
    </form>


</div>

</div>

 

<script>

</script>

<script type="text/javascript" src="/kyw/public/js/common.js"></script>

<!--页面JS脚本-->


<script>
    layui.use(['layer', 'form', 'element', 'upload'], function () {
        var form = layui.form
            , upload = layui.upload;
        form.render();
        //刷新界面 所有元素

        $ = layui.jquery;//导航的hover效果、二级菜单等功能，需要依赖element模块
        $('#tpt_input').keydown(function (e) {
            if (e.which === 13) {
                $("#tpt_btn").click();
                e.preventDefault();
                return false;
            }
        });
        $('#mail-test').click(function() {
            var email = $('#J_email').val();

            if(email == ''){
                layer.msg('邮箱为空', {icon: 2, time: 1000}, function(){

                });

                //  return false;
            }
            $.post("<?php echo url('system/ajax_mail_test'); ?>", {email:email}, function(result){

                if(result.code === 1){
                    layer.msg(result.msg, {icon: 1, time: 1000}, function(){

                    });
                }else{
                    layer.msg(result.msg, {icon: 2, time: 1000}, function(){

                    });
                }
            });
        });
       uploadImg( upload,'#ppt1', '<?php echo url("upload/upimage"); ?>',function (res) {
           $('#ppt1-input').val(res.path);
           layer.msg(res.msg, {icon: 1, time: 1000});
           $("#pre-ppt1").css('display', 'block');
           $('#uploaded-ppt1').attr('src', getRootPath_web() + res.path);
       });
        uploadImg( upload,'#ppt2', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#ppt2-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-ppt2").css('display', 'block');
            $('#uploaded-ppt2').attr('src', getRootPath_web() + res.path);
        });

        uploadImg( upload,'#ppt3', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#ppt3-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-ppt3").css('display', 'block');
            $('#uploaded-ppt3').attr('src', getRootPath_web() + res.path);
        });

        uploadImg( upload,'#ppt4', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#ppt4-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-ppt4").css('display', 'block');
            $('#uploaded-ppt4').attr('src', getRootPath_web() + res.path);
        });

        uploadImg( upload,'#ppt5', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#ppt5-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-ppt5").css('display', 'block');
            $('#uploaded-ppt5').attr('src', getRootPath_web() + res.path);
        });

        uploadImg( upload,'#ppt6', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#ppt6-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-ppt6").css('display', 'block');
            $('#uploaded-ppt6').attr('src', getRootPath_web() + res.path);
        });

        uploadImg( upload,'#logo', '<?php echo url("upload/upimage"); ?>',function (res) {
            $('#logo-input').val(res.path);
            layer.msg(res.msg, {icon: 1, time: 1000});
            $("#pre-logo").css('display', 'block');
            $('#uploaded-logo').attr('src', getRootPath_web() + res.path);
        });


        $("#tpt_sel").on('click', 'a>em', function () {
            var name = "WEB_TAG";
            var tag = $(this).parent().text();
            $(this).parent().remove();
            var tags = new Array();
            $("#tpt_sel").find('a').each(function () {
                tags.push($(this).text());
            });
            $("#sitekeyword").val(tags.join(","));
            $("#tpt_pre a:contains('" + tag + "')").removeClass("selected");
        });
        $("#tpt_btn").click(function () {
            var name = "WEB_TAG";
            var tags = $.trim($("#sitekeyword").val());
            if (tags !== "") {
                tags = tags.split(",");
            } else {
                tags = new Array();
            }
            var tag = $.trim($("#tpt_input").val());
            if (tag !== '' && $.inArray(tag, tags) === -1) {
                tags.push(tag);
                $("#tpt_pre a:contains('" + tag + "')").addClass("selected");
            }
            $("#tpt_sel").children('span').empty();
            $.each(tags, function (k, v) {
                $("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
            });
            $("#sitekeyword").val(tags.join(","));
            $("#tpt_input").val('');
        });
        $("#tpt_pre").on('click', 'a:not(.selected)', function () {
            var name = "WEB_TAG";
            var tags = $.trim($("#sitekeyword").val());
            if (tags !== "") {
                tags = tags.split(",");
            } else {
                tags = new Array();
            }
            var tag = $.trim($(this).text());
            if (tag !== '' && $.inArray(tag, tags) === -1) {
                tags.push(tag);
            }
            $("#tpt_sel").children('span').empty();
            $.each(tags, function (k, v) {
                $("#tpt_sel").children('span').append('<a href="javascript:;">' + v + '<em></em></a>');
            });
            $("#sitekeyword").val(tags.join(","));
            $(this).addClass('selected');
        });
        form.on('submit', function(data){
            var formdata=$('#layui-form').serialize();
            ajaxform(formdata,"<?php echo url('admin/System/updateSiteConfig'); ?>",$)
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
    });



</script>


</body>
</html>