<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW\twothink\public/../application/user/view/default/login\index.html";i:1511709588;}*/ ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>登录</title>
  <link href="/static/home/other/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/static/home/other/css/style.css" rel="stylesheet">

  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <script src="/static/home/other/jquery-1.11.2.min.js"></script>

  <style>
    .main{margin-bottom: 60px;}
    .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    .controls_my{margin-bottom:5px;}
  </style>
</head>

<section>
<div class="span12"  class="page-header">
  <h1 class="col-xs-12">登 录</h1>
<form class="login-form" action="" method="post">
  <div class="control-group">
    <div class="controls">
      <input type="text" id="inputEmail" class="col-xs-12 input-lg controls_my" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <input type="password" id="inputPassword"  class="col-xs-12 input-lg controls_my" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <input type="text" id="inputPassword" class="col-xs-12 input-lg controls_my" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label"></label>
    <div class="controls verifyimg col-xs-12">
      <?php echo captcha_img(); ?>
    </div>
    <div class="controls Validform_checktip text-warning"></div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-info col-xs-12">登 陆</button>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <a href="register.html" class="btn col-xs-offset-9 col-sm-offset-10 col-md-offset-10 col-lg-offset-11" style="background-color: white;">新用户注册</a>
    </div>
  </div>
</form>
</div>
</section>


 

<!--导航部分-->
<nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container-fluid text-center">
    <div class="col-xs-3">
      <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="fuwu.html" class="navbar-link">服务</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="faxian.html" class="navbar-link">发现</a></p>
    </div>
    <div class="col-xs-3">
      <p class="navbar-text"><a href="my.html" class="navbar-link">我的</a></p>
    </div>
  </div>
</nav>
<!--导航结束-->
<script type="text/javascript">

    $(document)
        .ajaxStart(function(){
            $("button:submit").addClass("log-in").attr("disabled", true);
        })
        .ajaxStop(function(){
            $("button:submit").removeClass("log-in").attr("disabled", false);
        });


    $("form").submit(function(){
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.code){
                window.location.href = data.url;
            } else {
                self.find(".Validform_checktip").text(data.msg);
                //刷新验证码
                $(".verifyimg img").click();
            }
        }
    });

    $(function(){
        //刷新验证码
        var verifyimg = $(".verifyimg img").attr("src");
        $(".verifyimg img").click(function(){
            if( verifyimg.indexOf('?')>0){
                $(".verifyimg img").attr("src", verifyimg+'&random='+Math.random());
            }else{
                $(".verifyimg img").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
            }
        });
    });
</script>

