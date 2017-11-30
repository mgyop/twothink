<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/server\lists.html";i:1512025414;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?=$meta_title?></title>

    <!-- Bootstrap -->
    <link href="__ROOT__/static/home/other/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="__ROOT__/static/home/other/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <?php require '/html/nav.html'?>
    <!--导航结束-->

    <div class="container-fluid">
        <div class="indexImg row">
            <img src="__ROOT__/static/home/other/image/3.png" width="100%" />
        </div>
        <div class="blank"></div>
        <div class="container">
            <ul class="list-group fuwuList">
                <li class="list-group-item"><a href="diaochawenjuan.html" class="text-danger"><span class="iconfont">&#xe604;</span>调查问卷</a> </li>
                <li class="list-group-item"><a href="<?php echo url('confirm'); ?>" class="text-info"><span class="iconfont">&#xe605;</span>业主认证</a></li>
                <li class="list-group-item"><a href="#" class="text-success"><span class="iconfont">&#xe602;</span>在线缴费</a></li>
                <li class="list-group-item"><a href="<?php echo url('tips'); ?>" class="text-warning"><span class="iconfont">&#xe601;</span>生活贴士</a></li>
                <li class="list-group-item"><a href="<?php echo url('about'); ?>" class="text-primary"><span class="iconfont">&#xe600;</span>关于我们</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="__ROOT__/static/home/other/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="__ROOT__/static/home/other/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>