
<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="css/global.css" media="all">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
  <?php 
include "./connect.php";
if (isset($_COOKIE['adminid'])){
  date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    $_sql="SELECT ponsor_id,post_time,question_name FROM question WHERE 1";
    $result=_fetch_array($_sql);
 ?>
    <div class="layui-layout layui-layout-admin" style="border-bottom: solid 5px #1aa094;">
      <div class="layui-header header header-demo">
        <div class="layui-main">
          <div class="admin-login-box" style="width: 300px;">

            <a class="logo" style="left: 0;margin-top: -17px;" href="index.php">
            <img src="images/LOGO.png" style="width: 60px;height: 60px;">
              <span style="font-size: 22px;">后台管理</span>
            </a>
            <div class="admin-side-toggle">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="admin-side-full">
              <i class="fa fa-life-bouy" aria-hidden="true"></i>
            </div>
          </div>
          <ul class="layui-nav admin-header-item">
          
            <li class="layui-nav-item">
              <a href="javascript:;" class="admin-header-user">
                <img src="images/0.jpg" />
                <span>管理员<?php echo($_COOKIE['adminid'])?></span>
              </a>
              
              <dl class="layui-nav-child">
                <dd>
                  <a href="admin_information.php"><i class="fa fa-user-circle" aria-hidden="true"></i> 个人信息</a>
                </dd>
                <dd>
                  <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
                </dd>
              </dl>
            </li>
          </ul>
          <ul class="layui-nav admin-header-item-mobile">
            <li class="layui-nav-item">
              <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="layui-side layui-bg-black" id="admin-side">
        <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
      </div>
      <div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
        <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
          <ul class="layui-tab-title">
            <li class="layui-this">
              <i class="fa fa-dashboard" aria-hidden="true"></i>
              <cite>控制面板</cite>
            </li>
          </ul>
          <div class="layui-tab-content" style="min-height: 150px; padding: 5px 0 0 0;">
            <div class="layui-tab-item layui-show">
              <iframe src="admin_index.php"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="layui-footer footer footer-demo" id="admin-footer">
        <div class="layui-main">
          <p>CopyRright &copy;&nbsp;2017&nbsp;BeiFengTZ
          </p>
        </div>
      </div>
      <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
      </div>
      <div class="site-mobile-shade"></div>
      
      <script type="text/javascript" src="plugins/layui/layui.js"></script>
      <script type="text/javascript" src="js/nav.js"></script>
      <script src="js/index.js"></script>
      <script>
        layui.use('layer', function() {
          var $ = layui.jquery,
            layer = layui.layer;

          $('#video1').on('click', function() {
            layer.open({
              title: 'YouTube',
              maxmin: true,
              type: 2,
              content: 'video.html',
              area: ['800px', '500px']
            });
                    });
                    $('#pay').on('click', function () {
                        layer.open({
                            title: false,
                            type: 1,
                            content: '<img src="images/xx.png" />',
                            area: ['500px', '250px'],
                            shadeClose: true
                        });
                    });
        });
      </script>
    </div>
  </body>

</html>
<?php
}else{
    _location('您还未登录，请登陆后访问！','index.php');
  }
?>