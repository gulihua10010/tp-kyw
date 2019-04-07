<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\phpStudy\WWW\kyw/application/bbs\view\test_index.html";i:1546971386;}*/ ?>
<?php echo '<?'; ?>
xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Title</title>
    <style type="text/css">
        ul li{
            list-style: none;

        }
        ul,li{
            margin: 0;
            padding: 0;
        }
        .pptmenu ul li>div{
            width: 135px;
            height: 35px;
            background-color:#ccc;
            cursor: pointer;
        }
        .pptmenu{
            border: 1px salmon solid;
        }
        .pptmenu>ul>li{
            display: block;height: 35px;
            position: relative;
        }
        .pptmenu>ul>li>ul{
            border: 1px navy solid;
            position: absolute;
            top: 0;
            left: 140px;
        }
        .pptmenu>ul>li>ul>li{
            float: left;
        }

    </style>
</head>
<body>

 <div class="pptmenu">
     <ul>
         <li><div>111111</div>
         <ul>
             <li><div>1112222</div></li>
             <li><div>1133333</div></li>
         </ul>
         </li>
         <li><div>222</div>
             <ul>
                 <li><div>222333</div></li>
             </ul>
         </li>
         <li><div>3333</div></li>
         <li><div>4444</div></li>


     </ul>

 </div>

</body>
</html>