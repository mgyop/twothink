<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/cactive\index.html";i:1512014091;}*/ ?>
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
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('index/index'); ?>" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid main_text">
        <?php if(is_array($_list) || $_list instanceof \think\Collection || $_list instanceof \think\Paginator): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
        <div class="row noticeList">
            <!--<a href="<?php echo url('notice/detail'); ?>?id=<?php echo $list['id']; ?>">-->
            <!--<div class="col-xs-2">-->
                <!--<img class="noticeImg" src="__ROOT__/static/home/other/image/1.png" />-->
            <!--</div>-->
            <!--<div class="col-xs-10">-->
                <!--<p class="title"><?php echo $list['title']; ?></p>-->
                <!--<p class="info">浏览: <?php echo $list['view']; ?> <span class="pull-right"><?=date("Y-m-d",$list['create_time'])?></span> </p>-->
            <!--</div>-->
            <!--</a>-->

        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="container-fluid">
        <button class="btn btn-info col-xs-12" path="" id="my_button">下一页</button>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="__ROOT__/static/home/other/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="__ROOT__/static/home/other/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(function () {
        var page = "<?php echo $pageNext; ?>";
        $("#my_button").attr('path',page);

        $("#my_button").click(function () {
            init();
        });
        init();
        function init(){
            path = $("#my_button").attr('path');
            $.getJSON(path,function (data) {
                json = JSON.parse(data);
                if (json.success == 1){
                    //改变按钮的path
                    $("#my_button").attr('path',json.path);
                    //准备数据
                    var lists = json.data;
                    var html = '';
                    $(lists).each(function(index,item){
                        html += '<div class="row noticeList">';
                        html += '<a href="<?php echo url('notice/detail'); ?>?id='+item.id+'">';
                        html += '<div class="col-xs-2">';
                        html += '<img class="noticeImg" src="'+item.img_src+'" />';
                        html += '</div>';
                        html += '<div class="col-xs-10">';
                        html += '<p class="title">'+item.title+'</p>';

                        html += '<p class="info">浏览: '+item.view+' <span class="pull-right">'+getLocalTime(item.create_time)+'</span> </p>';
                        html += '</div></a>';
                        html += '<div><button class="join btn-info" activeid="'+item.id+'">报名活动</button></div>';
                        html += '</div>';
                    });
                    //追加数据
                    $(".main_text").append(html);
                }else{
                    alert('我也是有底线的')
                }
            });
        };
        //参加活动代码
        $('body').on('click','.join',function(){
            //活动id
            var active_id = $(this).attr('activeid');
            //发送ajax请求,注册活动
            $.getJSON("<?php echo url('active/join'); ?>?activeid="+active_id,function (data) {
                if (data.success == 1){
                    alert('参加成功');
                }else{
                    if(data.msg == '已经参加过了'){
                        alert('已经参加过了');
                    }else if(data.msg == '参数错误'){
                        alert('参数错误');
                    }else if(data.msg == '请先登录'){
                        location.href = "<?php echo url('/user/login'); ?>";
                    }
                }

            });
        });
    });
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,17)
    }
</script>
</body>
</html>