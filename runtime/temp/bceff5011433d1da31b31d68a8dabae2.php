<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:61:"E:\phpStudy\WWW\kyw/application/index\view\school_detail.html";i:1548593560;s:58:"E:\phpStudy\WWW\kyw\application\index\view\index_base.html";i:1554441040;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_header.html";i:1554174358;s:58:"E:\phpStudy\WWW\kyw\application\index\view\other_menu.html";i:1548855206;s:60:"E:\phpStudy\WWW\kyw\application\index\view\index_footer.html";i:1548922078;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title><?php echo $site_config['site_title']; ?>|<?php echo $site_config['seo_title']; ?></title>

<meta name="keywords" content="<?php echo $site_config['seo_keyword']; ?>">
<meta name="description" content="<?php echo $site_config['seo_description']; ?>">

    <link rel="shortcut icon" href="/kyw/public/images/favicon.ico">
  <link rel="stylesheet" href="/kyw/public/plugins/layui/css/layui.css">
    <link rel="stylesheet" href="/kyw/public/css/base.css">
    <link rel="stylesheet" href="/kyw/public/css/index.css">
    <link rel="stylesheet" href="/kyw/public//css/common.css">
    
<link rel="stylesheet" type="text/css" href="/kyw/public//css/school.css"/>


<script src="/kyw/public/plugins/layui/layui.js"></script>
<script src="/kyw/public/js/jquery-1.9.1.min.js"></script>
<script src="/kyw/public/js/jquery.SuperSlide.2.1.1.js"></script>
<script src="/kyw/public//js/common.js"></script>
  <style>

  </style>
</head>
<body>

<div class="header">
    <div class="header-top">
        <div class="content-index clearfix">
            <div class="fl">
                <a href="http://<?php echo $web_url; ?>/admin.php" target="_blank" style="color: white;line-height: 30px">后台登录</a>
            </div>
            <div class="fr header-top-right">
                <?php if(\think\Session::get('userid') != ''): ?>
                <a class="avatar fl" href="<?php echo url('user/index/home',array('id'=>\think\Session::get('userid'))); ?>">
                    <img src="/kyw<?php echo \think\Session::get('userhead'); ?>">
                    <cite  style="color:#fff;"><?php echo \think\Session::get('username'); ?></cite>
                    <i  class="grade" style="font-style:normal"><?php echo getgradenamebyid(\think\Session::get('grades')); ?></i>
                </a>
                <div class="nav fl">
                    <a href="<?php echo url('user/index/set'); ?>"  target="_blank" style="color:#fff;" ><i class="iconfont">&#xe65f;</i>设置</a>
                    <a   onclick="loginout();" href="javascript:void(0)"    style="color:#fff;">
                        <i class="iconfont " style="line-height: 10px; font-size: 26px;">&#xe60c;</i>退出</a>
                </div>
                <?php else: ?>
                 <a href="javascript:void(0);" onclick="showLogin();"  >登录</a>
                    <a href="javascript:void(0);" onclick="showReg();"  >注册</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="header-bootom content-index clearfix">
        <div class="fl">
            <?php if($site_config['logo'] != ''): ?>
            <img src="/kyw<?php echo $site_config['logo']; ?>" class="logo fl">
            <?php endif; ?>
        </div>
        <div class="fr">
            <div class="search-box fl">
                <div class="select-list search-select fl">
                    <span id="commonSearch" data-id="1">课程</span>
                    <ul class="sub-ul" id="commonSearchType">
                        <li data-id="1"><a href="javascript:void(0);" >课程</a></li>
                        <li  data-id="2"><a href="javascript:void(0);"  >学校</a></li>
                        <li  data-id="3"><a href="javascript:void(0);"  >专业</a></li>
                    </ul>
                </div>
                <div class="fl search-input-box">
                    <input type="text" name="commonSearchInput" id="commonSearchInput" placeholder="学院信息" class="search-input fl">
                </div>
                <input type="button" name="" id="btn" value="搜索" class="search-ic fl" style="color: white">
            </div>
        </div>
    </div>
</div>
<script>
$('#commonSearchType li').click(function () {
    var id=$(this).data('id');
    $('#commonSearch').attr('data-id',id)
    $('#commonSearch').text($(this).text());
})
    $('#btn').click(function () {
var id=$('#commonSearch').attr('data-id')
console.log(id)
    var url='#';
    var keywords=$('input[name=commonSearchInput]').val();
    switch (id){
        case '2': url="<?php echo url('index/school/index'); ?>?keywords="+keywords;break;
        case '3': url="<?php echo url('index/magor/index'); ?>?keywords="+keywords;break;
        case '1': url="<?php echo url('index/course/index'); ?>?keywords="+keywords;break;
    }
    window.open(url)
    })

</script>
<div class="main layui-clear "  >

<div class="nav-box ">
    <div class="content-index nav-c ">
        <div class="nav-home fl">
           <a href="<?php echo url('index/index/index'); ?>">首页</a>
        </div>
        <ul class="nav-sub fl  "  >
            <?php if(is_array($infonav) || $infonav instanceof \think\Collection || $infonav instanceof \think\Paginator): $i = 0; $__LIST__ = $infonav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>" <?php  if($vo['link']!=''&&$controller==getnav_Controller($vo['link'] ,$vo['sid'])) echo ('class="sel-this"'); ?>><?php echo $vo['name']; ?></a>
                <ul>
                    <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                    <li><a href="<?php echo getnavlink($vo1['link'],$vo['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>


<div class="wap12    bw" style="padding-bottom: 50px;margin-top: 20px ">
    <div class="schoolBan"><img src="/kyw<?php echo $school['pic']; ?>" width="1184px" height="243px" alt="<?php echo $school['name']; ?>">
    </div>
    <div class="theSchool clearfix">
        <div class="fl schoolImg">
            <img src="/kyw<?php echo $school['badge']; ?>" alt="<?php echo $school['name']; ?>">
            <p><?php echo $school['name']; ?></p>
        </div>
        <div class="shoolWords">
            <div class="shoolWordsTop clearfix">
                <p class="attri fl">
                    <?php $prop=explode(',',$school['prop']);foreach($prop as $v) echo ("<span>$v</span>");  ?>
                </p>
                <p class="schoolCode fl">院校代码：<?php echo $school['code']; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="wap12 clearfix">
    <div class="pubLeftBar fl">
        <div class="pubLinks mb20">
            <ul class="clearfix">
                <li class='school-btn on' onclick="brief()"><a name="here"   class="brief">学校简介</a>
                </li>
                <li class='school-btn ' onclick="rules()"><a name="here"  class="rules">招生简章</a></li>
                <li class='school-btn ' onclick="zsmajor()"><a name="here" class="zsmajor">招生专业</a></li>
                <li class='school-btn ' onclick="cutoffline()"><a name="here" class="cutoffline">分数线</a></li>
                <li class='school-btn ' onclick="reexam()"><a name="here"  class="reexam">复试</a></li>
            </ul>
        </div>

        <div class="recordCon brief-con">
            <h4 class="schoolTit"><?php echo $school['name']; ?>研究生院简介</h4>
            <div class="slogBox">
                <div class="reexamCon">
                    <?php if(clearcontent($school['info'])=='')echo ("  <p>暂无简介</p>"); ?>
                    <?php echo clearHTMLhead($school['info']); ?>
                </div>
            </div>
        </div>
        <div class="recordCon rules-con dn">
            <h4 class="schoolTit"><?php echo $school['name']; ?>招生简章</h4>
            <div class="slogBox">
                <div class="reexamCon">
                    <?php if(clearcontent($school['rule'])=='')echo ("  <p>暂无说明</p>"); ?>
                    <?php echo clearHTMLhead($school['rule']); ?>
                </div>
            </div>
        </div>
        <div class="recordCon zsmajor-con dn">
            <h4 class="schoolTit"><?php echo $school['name']; ?>招生专业</h4>
            <div class="masterBar">
                <ul class="clearfix masterUl">
                    <li class="hasBorder on">学术硕士</li>
                    <li class="">专业硕士</li>
                </ul>
                <div class="masterConBox mt20">
                    <div class="masterCon on">
                        <div class="subjectCon">
                            <ul>
                                <?php if(is_array($m1) || $m1 instanceof \think\Collection || $m1 instanceof \think\Paginator): $i = 0; $__LIST__ = $m1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li><span>学院:
                                <a   target="_blank" title="<?php echo $vo['college']; ?>"><?php echo $vo['college']; ?></a>
                                </span><span class="master-m">专业:<a href="<?php echo url('index/magor/detail',array('id'=>$vo['id'])); ?>" target="_blank" title="<?php echo $vo['name']; ?>">
                                    <?php echo $vo['name']; ?></a></span> </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>

                        </div>
                      </div>
                       <div class="masterCon">
                            <div class="subjectCon">
                                <ul>
                                    <?php if(is_array($m2) || $m2 instanceof \think\Collection || $m2 instanceof \think\Paginator): $i = 0; $__LIST__ = $m2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <li><span>学院:
                                <a   target="_blank" title="<?php echo $vo['college']; ?>"><?php echo $vo['college']; ?></a>
                                </span><span class="master-m">专业:<a href="<?php echo url('index/magor/detail',array('id'=>$vo['id'])); ?>" target="_blank" title="<?php echo $vo['name']; ?>">
                                    <?php echo $vo['name']; ?></a></span> </li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>

                       </div><!--masterConBox-->
                    </div><!--masterBar-->
                </div>
            </div>
        <div class="recordCon cutoffline-con dn">
            <h4 class="schoolTit"><?php echo $school['name']; ?>分数线</h4>
            <div class="slogBox">
                <div class="reexamCon">
                    <?php if(clearcontent($school['grade'])=='')echo ("  <p>暂无说明</p>"); ?>
                    <?php echo clearHTMLhead($school['grade']); ?>
                </div>
            </div>
        </div>
        <div class="recordCon reexam-con dn">
            <h4 class="schoolTit"><?php echo $school['name']; ?>复试信息</h4>
            <div class="slogBox">
                <div class="reexamCon">
                    <?php if(clearcontent($school['fushi'])=='')echo ("  <p>暂无说明</p>"); ?>
                    <?php echo clearHTMLhead($school['fushi']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="pubRightBar fr">
        <div class="pubRight">
            <div class="concatCon">
                <p class="pubWeb" title="<?php echo $school['website']; ?>"><strong>研究生院网址：</strong><?php echo $school['website']; ?> </p>
                <p title="<?php echo $school['tel']; ?>"><strong>联系电话：</strong><?php echo $school['tel']; ?></p>
                <p title="<?php echo $school['email']; ?>"><strong>联系邮箱：</strong><?php echo $school['email']; ?></p>
                <p title="<?php echo $school['address']; ?>"><strong>学校地址：</strong><?php echo $school['address']; ?></p>
            </div>
        </div>


        <div class="pubSchoolHot mt15">
            <h4 class="pubRightTit"><span>同类型院校人气排名</span></h4>
            <ul class="hotSchoolList">
                <?php if(is_array($right_s) || $right_s instanceof \think\Collection || $right_s instanceof \think\Paginator): if( count($right_s)==0 ) : echo "" ;else: foreach($right_s as $k=>$vo): ?>
                <li class="num<?php echo $k+1; ?> noBor"><a href="<?php echo url('index/school/detail',array('id'=>$vo['id'],'t'=>'1')); ?> "
                                          target="_blank"><?php echo $vo['name']; ?></a>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>




</div>
<div class="maintop " > </div>

<div class="footer">
    <div class="content-index clearfix">
        <div class="footnav">
            <ul>
                <?php if(is_array($footnav) || $footnav instanceof \think\Collection || $footnav instanceof \think\Paginator): $i = 0; $__LIST__ = $footnav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo getnavlink($vo['link'],$vo['sid']); ?>" target="<?php echo $vo['target']; ?>"><?php echo $vo['name']; ?></a>
                    <ul>
                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo getnavlink($vo1['link'],$vo1['sid']); ?>" target="<?php echo $vo1['target']; ?>"><?php echo $vo1['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>

        </div>
        <span>
            <?php if($site_config['site_icp'] != ''): ?>
            ICP备案号:<?php echo $site_config['site_icp']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_copyright'] != ''): ?>
            版权信息:<?php echo $site_config['site_copyright']; endif; ?>

        </span>
        <span>
            <?php if($site_config['site_tongji'] != ''): ?>
            <?php echo $site_config['site_tongji']; endif; ?>

        </span>


    </div>
</div>    
 
<script src="/kyw/public//js/home.js"></script>



<!--页面JS脚本-->

<script>

    console.log('%c 考研网','color:#1BC7F1;font-size:30px;font-weight: bold ');
    // var mh= $('.main').outerWidth(true) ;
        // var mt= $('.main').offset().top
        // console.log(mt )
        // console.log(mh )
        // var ft=mh+mt;
        // if (ft<800){
        //     ft=800;
        // }
        // $('.footer').css({
        //     'position':'absolute',
        //     'top':ft+'px',
        // })

</script>

<script type="text/javascript">
    '<?php if($t == 1): ?>'
    brief()
    '<?php endif; ?>'

    '<?php if($t == 2): ?>'
    rules();
    '<?php endif; ?>'
    '<?php if($t == 3): ?>'
    zsmajor();
    '<?php endif; ?>'
    '<?php if($t == 4): ?>'
    cutoffline();
    '<?php endif; ?>'
    '<?php if($t == 5): ?>'
    reexam();
    '<?php endif; ?>'
    function brief(){
        $('.school-btn').removeClass('on');
        $('.brief').parent().addClass('on');
        $('.brief-con').show();
        $('.rules-con').hide();
        $('.zsmajor-con').hide();
        $('.cutoffline-con').hide();
        $('.reexam-con').hide();

    }
    function rules(){
        $('.school-btn').removeClass('on');
        $('.rules').parent().addClass('on');
        $('.brief-con').hide();
        $('.rules-con').show();
        $('.zsmajor-con').hide();
        $('.cutoffline-con').hide();;
        $('.reexam-con').hide();

    }
    function zsmajor(){

        $('.school-btn').removeClass('on');
        $('.zsmajor').parent().addClass('on');
        $('.brief-con').hide();
        $('.rules-con').hide();
        $('.zsmajor-con').show();
        $('.cutoffline-con').hide();
        $('.reexam-con').hide();
    }
    function cutoffline(){

        $('.school-btn').removeClass('on');
        $('.cutoffline').parent().addClass('on');
        $('.brief-con').hide()
        $('.rules-con').hide();
        $('.zsmajor-con').hide();
        $('.cutoffline-con').show();
        $('.reexam-con').hide()
    }
    function reexam(){
        $('.school-btn').removeClass('on');
        $('.reexam').parent().addClass('on');
        $('.brief-con').hide()
        $('.rules-con').hide()
        $('.zsmajor-con').hide()
        $('.cutoffline-con').hide()
        $('.reexam-con').show()
    }



    //masterUl

$('.masterUl li:first-child').click(function () {
    $('.masterUl li').removeClass('on');
    $(this).addClass('on');
    $('.masterConBox .masterCon:first-child').show()
    $('.masterConBox .masterCon:nth-child(2)').hide()

})
    $('.masterUl li:nth-child(2)').click(function () {
        $('.masterUl li').removeClass('on');
        $(this).addClass('on');
        $('.masterConBox .masterCon:first-child').hide()
        $('.masterConBox .masterCon:nth-child(2)').show()

    })
</script>

</body>
</html>