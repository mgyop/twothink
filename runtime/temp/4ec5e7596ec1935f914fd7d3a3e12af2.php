<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\phpStudy\WWW\twothink\public/../application/user/view/default/login\register.html";i:1512033984;}*/ ?>
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
    <h1 class="col-xs-12">注 册</h1>
        <form class="login-form" action="" method="post">
          <div class="control-group">
            <div class="controls">
              <input type="text" id="inputEmail" class="span3 col-xs-12 controls_my" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="password" id="inputPassword"  class="span3 col-xs-12 controls_my" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="password" id="inputPassword" class="span3 col-xs-12 controls_my" placeholder="请再次输入密码" recheck="password" errormsg="您两次输入的密码不一致" nullmsg="请填确认密码" datatype="*" name="repassword">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="inputEmail" class="span3 col-xs-12 controls_my" placeholder="请输入电子邮件"  ajaxurl="/member/checkUserEmailUnique.html" errormsg="请填写正确格式的邮箱" nullmsg="请填写邮箱" datatype="e" value="" name="email">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" class="span3 col-xs-12 controls_my" placeholder="请输入手机号"  nullmsg="请填写手机号" datatype="e" value="" name="mobile">
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <input type="text" id="inputPassword" class="span3 col-xs-12 controls_my" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label"></label>
            <div class="controls verifyimg">
               <?php echo captcha_img(); ?>
            </div>
            <div class="controls Validform_checktip text-warning"></div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn btn-info col-xs-12">注 册</button>
            </div>
          </div>
          <div class="controls">
            <a href="<?php echo url('User/login'); ?>" class="btn col-xs-offset-9 col-sm-offset-11 col-md-offset-11 col-lg-offset-11" style="background-color: white;">去登陆</a>
          </div>
  </div>
        </form>
	</div>
</section>



 

<!--导航部分-->
<?php require '/html/nav.html';?>
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

