<?php
include "./connect.php";
header("Content-Type:text/html;charset=utf-8");
if (isset($_COOKIE['userid']) ){
  date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    $_sql="SELECT ponsor_id,post_time,question_name FROM question WHERE 1";
    $result=_fetch_array($_sql);
?>
<!doctype html>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>北风社区</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/inputbutton.css">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  </head>
  <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="layui/layui.all.js"></script>
<style>
/*  div{
    border:1px solid red;
  }*/
  body{
    margin:0;
    padding: 0;
  }  
/*  ul,li{
    border:1px solid red;

  }*/
  #bg_photo{
    position: fixed;
    width: 100%;
    height: 100%;
  }
  .main_body{
    position: fixed;
    width: 70%;
    height: 100%;
    margin: 0px;
    top: 60px;
    left: 50%;
    margin-left:-35%;
    background-color: #FAF7EF;
  }
  .footer{
    position: absolute;
    width: 100%;

    z-index: 10000;
    bottom: 0px;
    text-align: center;

  }

  #table_ a{
    color: #009999;
  }
  #table_ a:hover{
    color:#00CCFF;
    text-decoration: underline blink;
  }
  #hang_1{
    background-color: #66FFCC;
  }
  #hang_2{
    background-color:#ffffff;
  }
  #information_box{
    display: inline-block;
    width: 44%;
    height:0 auto;
    position: absolute;
    left: 50%;
    margin-left: -22%;
    top: 100px;
    bottom: 100px;
    background-color: rgba(225,225,225,0.6);
    border-radius: 10px;
  }
  .box1{
    margin-top: 40px;
    font-size: 20px;
    margin-left: 20px;
  }
  .box2{
    margin-top: 40px;
    font-size: 20px;
  }
  .box3{
    margin-top: 40px;
    font-size: 20px;
    margin-left: -40px;
  }
  .box4{
  	font-size: 20px;
  	margin-top: 40px;
  	margin-left: -20px;
  }
  .box5{
  	font-size: 20px;
  	margin-top: 40px;
  	margin-left: -20px;
  }
  .box6{
  	font-size: 20px;
  	margin-top: 40px;
  	margin-left: -60px;
  }
</style>
  <body>
  <img src="images/bg.png" id="bg_photo">
    <div style="margin-top:0px;position: fixed;z-index: 10000;">
      <ul class="layui-nav" style="position: fixed;width: 100%">
        <img src="images/LOGO.png" style="width: 65px;">
        <li class="layui-nav-item" >
          <a href="user_index.php">论坛社区</a>
        </li>
        <li class="layui-nav-item" >
          <a href="my_index.php">我的主页</a>
        </li>
        <li class="layui-nav-item layui-this layui-nav admin-header-item" style="position:absolute;right:10px;">
          <a href="javascript:;" class="admin-header-user">
                <img src="images/0.jpg" style="width: 60px;border-radius: 50%;">
                <span>用户<?php echo($_COOKIE['userid'])?></span>
              </a>
<!--           <a href="javascript:;">用户</a> -->
          <dl class="layui-nav-child">
            <dd>
              <a href="user_information.php?action=information&userid='.$_COOKIE['userid'].'&masage=information&play=update">个人信息</a>
            </dd>
            <dd>
              <a href="logout.php">注销</a>
            </dd>
          </dl>
        </li>
        </ul>
        </div>
        <div>
          <div class="main_body">
          
        </div>
        <div class="footer">
          
        </div>
        </div>
        <div class="main_body">
          <div id="information_box">
          <p align="center" style="font-size: 25px;margin-top: 20px;"><b>个人信息</b></p>
  <?php
  if (isset($_GET['action']) && $_GET['action']=='information') {
    $_sql="SELECT user_id,name,sex,password FROM user WHERE user_id='{$_COOKIE['userid']}'";
    $result=_fetch_array($_sql);
    // var_dump($result);
  }
  // var_dump($_GET['play']);
?>
<form action="check_upinformation.php?action=information&play=update_password" method="post" accept-charset="utf-8">
  <?php
  // if ($_GET['masage']=="information" && $_GET['play']!="update_password") {
  //   echo ('<p align="center" class="box1">ID：<input type="text" name="user_id" value="'.$result[0]['user_id'].'" disabled  ></p>');
  // echo ('<P align="center" class="box2">昵称：<input type="text" name="new_name"  value="'.$result[0]['name'].'" ></P>');

  //   if ($result[0]['sex']=="boy") {
  //     echo ('<p class="box3" align="center">性别：<input checked="true" type="radio" name="new_sex" value="boy" style="margin-left:20px;">男<input type="radio" name="new_sex" value="girl" style="margin-left:100px;">女</P>');
  //   }else{
  //     echo ('<p class="box3">性别：<input  type="radio" name="new_sex" value="boy" style="margin-left:20px;">男
  //       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input checked="true" type="radio" name="new_sex" value="girl" style="margin-left:30px;" style="margin-left:100px;">女</P>');
  //   }
  // echo ('<p align="center"><a href="uppassword.php?action=information&masage=information&play=update_password">修改密码</a ></p>');
  // echo ('<p align="center" style="margin-top:40px;"><input type="submit" value="更新" style="width:100px;" align="center"></p>');
  // } 
  if ($_GET['masage']=="information" && $_GET['play']=="update_password") {
    echo ('<p align="center" class="box1">ID：<input type="text" name="user_id" value="'.$result[0]['user_id'].'" disabled></p>');
  echo ('<P align="center" class="box2">昵称：<input type="text" name="new_name" value="'.$result[0]['name'].'"></P>');
  if ($result[0]['sex']=="boy") {
      echo ('<p class="box3" align="center">性别：<input checked="true" type="radio" name="new_sex" value="boy" style="margin-left:20px;">男<input type="radio" name="new_sex" value="girl" style="margin-left:100px;">女</P>');
    }else{
      echo ('<p class="box3" align="center">性别：<input  type="radio" name="new_sex" value="boy" style="margin-left:20px;">男<input checked="true" type="radio" name="new_sex" value="girl" style="margin-left:100px;">女</P>');
    }
  
  echo ('<p class="box4" align="center">旧密码：<input type="password" name="oldpassword" placeholder="请输入旧密码"></p>');
  echo ('<p class="box5" align="center">新密码：<input type="password" name="newpassword" placeholder="请输入新密码"></p>');
  echo ('<p class="box6" align="center">确认新密码：<input type="password" name="check_newpassword" placeholder="请确认新密码"></p>');
  echo ('<p align="center" style="margin-top:30px;"><input type="submit" value="更新" style="width:100px; background-color:#065279;color:white;" ></p>');
  }
?>  
</form>
    </div>
        </div>
        <ul class="footer">
          <li style="height:30px;">CopyRight 2017 © BeiFengTZ</li>
        <ul>
<script type="text/javascript" src="plugins/layui/layui.js"></script>
    <script>
      layui.use('element', function() {
        var element = layui.element(); //导航的hover效果、二级菜单等功能，需要依赖element模块
      });
    </script>
  </body>
</html>
<?php
}else{
    _location('您还未登录，请登陆后访问！','index.php');
  }
?>