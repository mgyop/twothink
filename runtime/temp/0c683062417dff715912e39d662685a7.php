<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpStudy\WWW\twothink\public/../application/home/view/default/repair\index.html";i:1512057939;}*/ ?>
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
    
    <table class="table table-striped">
       <thead>
          <tr>
              <th>编号</th>
              <th>sn</th>
              <th>name</th>
              <th>tel</th>
              <th>address</th>
              <th>question</th>
              <th>content</th>
              <th>status</th>
              <th>创建时间</th>
              <th>操作</th>
          </tr>
       </thead>
        <tbody class="main_text">

        </tbody>
    </table>
    <div class="container-fluid ">
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
                    var lists = json.data.data;
                    var html = '';
                    $(lists).each(function(index,item){
                        html += '<tr>';
                        html += '<td>'+item.id+'</td>';
                        html += '<td>'+item.sn+'</td>';
                        html += '<td>'+item.name+'</td>';
                        html += '<td>'+item.tel+'</td>';
                        html += '<td>'+item.address+'</td>';
                        html += '<td>'+item.question+'</td>';
                        html += '<td>'+item.content+'</td>';
                        html += '<td>'+item.create_time+'</td>';
                        html += '<td><button class="btn btn-info">撤销</button></td>';
                        html += '</tr>';
                    });
                    //追加数据
                    $(".main_text").append(html);
                }else{
                    alert('我也是有底线的')
                }
            });
        };
    });
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().substr(0,17)
    }
</script>
</body>
</html>