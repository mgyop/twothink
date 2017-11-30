<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/notice\detail.html";i:1511950244;}*/ ?>
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
    <?php require '/html/nav.html'?>
    <div class="container-fluid">
        <div class="blank"></div>
        <h3 class="noticeDetailTitle"><strong><?=$notice->title?></strong></h3>
        <div class="noticeDetailInfo">发布者:<?=$username?></div>
        <div class="noticeDetailInfo">发布时间：<?=$notice->create_time?></div>
        <div class="noticeDetailContent">
            <?=$notice->documentArticle->content?>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>