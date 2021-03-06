<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/sold\index.html";i:1512043177;}*/ ?>
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
    <?php require '/html/nav.html';?>
    <!--导航结束-->

    <div class="container-fluid">
        <div class="blank"></div>
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">租</a></li>
                <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">售</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                    <p class="text-danger">免费提供小区内的租房信息</p>
                    <div class="row my_zu">

                    </div>
                    <button class="btn btn-info col-xs-12" path="" id="my_button_zu">下一页</button>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <div class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                    <p class="text-danger">免费提供小区内的二手房信息</p>
                    <div class="row my_shou">

                    </div>
                    <button class="btn btn-info col-xs-12" path="" id="my_button_shou">下一页</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="__ROOT__/static/home/other/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="__ROOT__/static/home/other/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(function () {
        var zu_page = "<?php echo $zu_pageNext; ?>";
        var shou_page = "<?php echo $shou_pageNext; ?>";
        $("#my_button_zu").attr('path',zu_page);
        $("#my_button_shou").attr('path',shou_page);

        $("#my_button_zu").click(function () {
            init_zu();
        });
        $("#my_button_shou").click(function () {
            init_shou();
        });

        init_zu();
        init_shou();

        function init_zu(){
            zu_page = $("#my_button_zu").attr('path');
            $.getJSON(zu_page,function (data) {
                json = JSON.parse(data);
                if (json.success == 1){
                    //改变按钮的path
                    $("#my_button_zu").attr('path',json.path);
                    //准备数据
                    var lists = json.data;
                    var html = '';
                    $(lists).each(function(index,item){
                        html += '<div class="col-xs-6 col-md-4">';
                        html += '<div class="thumbnail">';
                        html += '<img src="'+item.img_src+'" alt="...">';
                        html += '<div class="caption">';
                        html += '<h4>'+item.title+'</h4>';
                        html += '<p class="text-danger">'+item.price+'</p>';
                        html += '<p><a href="<?php echo url('sold/detail'); ?>?cate_id='+item.category_id+'&id='+item.id+'" class="btn btn-danger zushouBtn">详细信息</a> </p>';
                        html += '<a href="<?php echo url('notice/detail'); ?>?id='+item.id+'">';
                        html += '</div></div></div>';
                    });
                    //追加数据
                    $(".my_zu").append(html);
                }else{
                    alert('我也是有底线的')
                }
            },false);
        }
        function init_shou(){
            shou_page = $("#my_button_shou").attr('path');
            $.getJSON(shou_page,function (data) {
                json = JSON.parse(data);
                if (json.success == 1){
                    //改变按钮的path
                    $("#my_button_shou").attr('path',json.path);
                    //准备数据
                    var lists = json.data;
                    var html = '';
                    $(lists).each(function(index,item){
                        html += '<div class="col-xs-6 col-md-4">';
                        html += '<div class="thumbnail">';
                        html += '<img src="'+item.img_src+'" alt="...">';
                        html += '<div class="caption">';
                        html += '<h4>'+item.title+'</h4>';
                        html += '<p class="text-danger">'+item.price+'</p>';
                        html += '<p><a href="<?php echo url('sold/detail'); ?>?cate_id='+item.category_id+'&id='+item.id+'" class="btn btn-danger zushouBtn">详细信息</a> </p>';
                        html += '<a href="<?php echo url('notice/detail'); ?>?id='+item.id+'">';
                        html += '</div></div></div>';
                    });
                    //追加数据
                    $(".my_shou").append(html);
                }else{
                    alert('我也是有底线的')
                }
            },false);
        }

//        //参加活动代码
//        $('body').on('click','.join',function(){
//            //活动id
//            var active_id = $(this).attr('activeid');
//            //发送ajax请求,注册活动
//            $.getJSON("<?php echo url('active/join'); ?>?activeid="+active_id,function (data) {
//                if (data.success == 1){
//                    alert('参加成功');
//                }else{
//                    if(data.msg == '已经参加过了'){
//                        alert('已经参加过了');
//                    }else if(data.msg == '参数错误'){
//                        alert('参数错误');
//                    }else if(data.msg == '请先登录'){
//                        location.href = "<?php echo url('/user/login'); ?>";
//                    }
//                }
//
//            });
    });
</script>
</body>
</html>