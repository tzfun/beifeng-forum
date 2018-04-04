<?php
include "./connect.php";//连接数据库
if (isset($_COOKIE['adminid'])) {//管理员登陆过可访问，否则返回主页
  date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    if(isset($_GET['action']) && $_GET['action']=='chakan'){
      $question_name=$_GET['question'];
      // var_dump($question_name);
      //在question数据表里面检索所有信息
      $_sql="SELECT ponsor_id,post_time,answer_id,answer_time,answer_content FROM question WHERE question_name='{$question_name}'";
      $result=_fetch_array($_sql);
      foreach ($result as $value) {
        if ($value['ponsor_id']!="" && $value['post_time']!="") {//发布问题的id和时间为空表示该用户仅参与回复问题
          $ponsor_id=$value['ponsor_id']; //提取发布者的id
          $post_time=date("Y-m-d H:i:s",$value['post_time']);    //提取发布的时间并将时间戳传换成date型时间
        }
      }
      // var_dump($ponsor_id);
      //提取发布者的昵称
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
<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>Table</title>
    <link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="css/global.css" media="all">
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/table.css" />
    <script type="text/javascript" src="plugins/layui/layui.js"></script>
    <style type="text/css">
* { margin:0; padding:0; }
body { width:100%; height:100%; overflow:hidden; }
#question_name{
    margin-top:30px;
    margin-left: 20px;
    font-size: 30px;
  }
  .poster_id{
    margin-left: 20px;
    margin-top: 20px;
    font-size: 20px;
  }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
  </head>
  <body>
  <div style="position:absolute;width:100%">
    <div class="admin-main">
        <a href="masage_manage.php"><button class="layui-btn" style="height: 30px;"><i class="layui-icon"></i></button></a>
      <fieldset class="layui-elem-field">
        <legend>消息详情</legend>
        <div class="layui-field-box layui-form">
  <p id="question_name">
    <?php
      echo ($question_name);
    ?>
  </p>
  <p class="poster_id">发布者id:
    <?php
      echo ($ponsor_id);
    ?>
  </p>
  <p class="poster_id">昵称:
    <?php
      echo ($post_name);
    ?>
  </p>
  <p class="poster_id">发布时间:
    <?php
      echo($post_time);
    ?>
  </p>
  <table style="margin-left: 20px;color:#009688;border-color: #009688;" border="1" width="70%" color="#009688">
    <tr>
      <th align="left"><br>网友回复<br><br></th>
    </tr>
    <tr>
    <?php 
    echo ('<td>');
      foreach ($result as $value) {
        
        if ($value!="") {
          $answer_time=date("Y-m-d H:i:s",$value['answer_time']);
          echo ('用户'.$value['answer_id'].'回答：<p>&nbsp&nbsp<br><h1 style="color:#00CCCC;">&nbsp&nbsp'.$value['answer_content'].'</h1></p><p align="right">'.$answer_time.'</p><hr>');
          
          // $value['answer_content'].'&nbsp'.$value['answer_id'].'&nbsp'.$answer_time.'<br><hr>'
        }

      }
      echo ('</td>');
  
?>
    </tr>
  </table>
          
        </div>
      </fieldset>
      <div class="admin-table-page">
        <div id="paged" class="page">
        </div>
      </div>
    </div>
    <script type="text/javascript" src="plugins/layui/layui.js"></script>
    </div>
  </body>
</html>
<?php
  }else{
    _location('您还未登录，请登陆后访问！','index.php');
  }
?>