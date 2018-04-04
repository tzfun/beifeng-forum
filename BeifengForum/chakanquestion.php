<?php
include "./connect.php";//连接数据库
if (isset($_COOKIE['userid'])){ //用户登陆过可访问，否则返回主页
  date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    if(isset($_GET['action']) && $_GET['action']=='chakan'){
      $question_name=$_GET['question'];
      // var_dump($question_name);
      $_sql="SELECT ponsor_id,post_time,answer_id,answer_time,answer_content FROM question WHERE question_name='{$question_name}'";
      $result=_fetch_array($_sql);
      foreach ($result as $value) {
        //检索在question数据表里面的发言记录
        if ($value['ponsor_id']!="" && $value['post_time']!="") {//发布问题的id和时间为空表示该用户仅参与回复问题
          $ponsor_id=$value['ponsor_id'];//提取发布者的id
          $post_time=date("Y-m-d H:i:s",$value['post_time']);//提取发布的时间并将时间戳传换成date型时间
        }
      }
      // var_dump($ponsor_id);
      //查询发布者的昵称
      $_sql1="SELECT name FROM user WHERE user_id='{$ponsor_id}'";
      $result1=_fetch_array($_sql1);
      foreach ($result1 as $value) {
        $post_name=$value['name'];
      }
      // var_dump($value['name']);
      // var_dump($ponsor_id);
      // var_dump($post_time);
    }
?>
<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>北风社区</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/inputbutton.css">
  </head>
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
    z-index: 1;
  }
  .main_body{
    position: absolute;
    z-index: 9988;
    width: 70%;
    height: 100%;
    margin: 0px;
    top: 0;
    left: 50%;
    margin-left:-35%;
  }
  .bg_{
    position: fixed;
    z-index: 2;
    width: 70%;
    height: 100%;
    left: 50%;
    margin-left:-35%;
    background-color: #FAF7EF;
  }
  .footer{
    position: relative;
    width: 100%;
    margin-top: 5%;
    z-index: 10000;
    bottom: 0px;
    text-align: center;
  }
  #question_name{
  	margin-top:60px;
  	margin-left: 100px;
  	font-size: 30px;
  }
  .poster_id{
  	margin-left: 100px;
  	margin-top: 20px;
  	font-size: 20px;
    color: #00cccc;
  }
</style>

  <body>
  <img src="images/bg.png" id="bg_photo">
  <div class="bg_"></div>
    <div style="margin-top:0px;position: fixed;z-index: 10000;">
<!--       <fieldset class="layui-elem-field layui-field-title">
        <legend>水平长导航菜单</legend>
      </fieldset> -->

      <ul class="layui-nav" style="position: fixed;width: 100%;top: 0;">
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
        <div class="main_body">
          <br><br>
            <p id="question_name"><?php echo ($question_name);?></p>
  <p class="poster_id">发布者id: <?php echo ($ponsor_id);?></p>
  <p class="poster_id">昵称:<?php echo ($post_name);?></p>
  <p class="poster_id">发布时间:<?php echo($post_time);?></p>
  <table  width="70%" style="margin-left: 100px;">
    <tr>
      <th align="left" style="font-size: 18px;"><br>网友回复<br><br></th>
    </tr>
    <tr>
    <?php 
    echo ('<td>');
      foreach ($result as $value) {
        if ($value!="" && $value['answer_content']!="") {
          $_sql2="SELECT name FROM user WHERE user_id='{$value['answer_id']}'";
          $result2=_fetch_array($_sql2);
          $username=$result2[0]['name'];
          $answer_time=date("Y-m-d H:i:s",$value['answer_time']);
          echo ('用户 <font style="color:#00cccc;">'.$username.'</font> 回答：<p><br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<xmp style="color:#758a99;font-weight: 800;">'.$value['answer_content'].'</xmp></p><p align="right">'.$answer_time.'</p><hr>');
        }else{
          echo ('<p style="color:red;">暂无人回答！</p>');
          break;
        }
      }
      echo ('</td>');
  
?>
    </tr>
  </table>
  <?php
echo ('<form action="question_page1.php" method="get" accept-charset="utf-8">
    <br><p style="margin-left:100px;font-size:20px;color:#006699"><input checked="true" type="radio" name="question_" value="'.$question_name.'">'.$question_name.'</p><br><BR>
    <textarea name="answer_content" placeholder="有事没事吐槽两句吧" style="width:70%;height:200px;font-size:16px;margin-left:100px"></textarea><br>
    <input type="submit" value="回复" style="position:relative;width:120px;left:73%;margin-left:-60px;margin-top:20px;" align="center">
  </form>');
  ?>
      <ul class="footer">
          <li style="height:30px;">CopyRight 2017 © BeiFengTZ</li>
        <ul>
        </div>
        
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