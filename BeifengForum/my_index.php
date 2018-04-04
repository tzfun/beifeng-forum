<?php 
include "./connect.php";//连接数据库
header("Content-Type:text/html;charset=utf-8");
  if (isset($_COOKIE['userid']) ){//用户登录可进入，否则返回首页
    date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    if(isset($_POST['question'])){
      //检索到发布者的信息，发布问题成功后录入question数据表
      $_sql1 = "SELECT ponsor_id,question_name,post_time FROM question WHERE ponsor_id='{$_COOKIE['userid']}'";
      $result1 = _fetch_array($_sql1);
      // var_dump($result1);
      if ($_POST['question']=="") {
        _alert('问题不能为空！');
      }else{
        $datetime = date('Y-m-d H:i:s',time());//获取当前系统时间
        $intdate = strtotime($datetime);//将date型数据转换为时间戳方便存进数据库
        //插入信息到question数据表，发布问题成功
        $_sql2 = "INSERT INTO question(ponsor_id,question_name,post_time)values('{$_COOKIE['userid']}','{$_POST['question']}','$intdate')";
        $_result2 = _query($_sql2);
        _alert('问题发布成功！');
      }
    }
    //删除提问
    if(isset($_GET['action']) && $_GET['action']=='delete'){
          // var_dump($_GET['question_']);
        echo ('<script> if(confirm( "删除后不可恢复，你确定要删除吗？"))  location.href="userdeletequestion.php?action=delete&question_='.$_GET['question_'].'";else location.href="my_index.php"; </script>'); 
    }
?> 
<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>我的主页</title>
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
    top: 0;
  }
  .main_body{
    position: absolute;
    z-index: 9888;
    width: 70%;
    height: 100%;
    top: 0;
    margin-top: 70px;
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
    margin-top: 30px;
    z-index: 10000;
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
  #post_question{
    margin-top: 30px;
  }
  th{
    background-color: #333333;
    color: #ccffff;
  }
  #_table_ tr{
    background-color:#ffffff;
  }
</style>

  <body>
  <img src="images/bg.png" id="bg_photo">
  <div class="bg_"></div>
    <div style="margin-top:0px;position: fixed;z-index: 10000;">
<!--       <fieldset class="layui-elem-field layui-field-title">
        <legend>水平长导航菜单</legend>
      </fieldset> -->

      <ul class="layui-nav" style="position: fixed;width: 100%;top:0;">
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
        <div id="post_question" align="center">
          <form action="my_index.php" method="post" accept-charset="utf-8">
            <input type="text" name="question" placeholder="提问在这里输入" style="width:50% ; font-size: 20px">
            <input type="submit" value="发表问题" style="width: 100px;margin-left: 30px;font-size: 20px">
          </form>
        </div>
          
          <table width="80%"  align="center" style="margin-top: 5%;font-size: 20px;" id="table_">
  <tr>
  <th width="5%">序号</th>
  <th width="40%">我的提问</th>
  <th width="5%">回答数</th>
  <th width="10%">发布时间</th>
  <th width="5%">操作</th>
  </tr>
  <?php
    $_sql1 = "SELECT ponsor_id,question_name,post_time,answer_content FROM question WHERE ponsor_id='{$_COOKIE['userid']}'";
    $result3= _fetch_array($_sql1);
    $number=1;
    
    
    foreach($result3 as $value){
      $answernum=0;
    $question = $value['question_name'];
    $time=date("Y-m-d H:i:s",$value['post_time']);//获取数据库时间并将int型转换成date型
   //    var_dump($value['post_time']);
    // var_dump($time);
   if ($number%2==0) {
  ?>
  <tr id="hang_1">
  <td align="center">
  <?php 
    echo ($number);
    $number++;
  ?>
  </td>
  <td>
    <?php
          echo ('<a href="question_page.php?action=answer&question_='.$question.'">'.$question.'</a>');
    ?>
  </td>

  <td align="center">
    <?php 

    $_sql3="SELECT answer_content FROM question WHERE question_name='{$question}'";
    $result6=_fetch_array($_sql3);

    if ($result6!="") {

      foreach ($result6 as $numvalue) {
        // var_dump($answernum);
        // var_dump($numvalue);
        if ($numvalue!="") {
          // var_dump($answernum);
        $answernum++;
         
        }else{
        }
      }echo ($answernum);
    }
    ?>
  </td>
  <td align="center">
    <?php echo ($time); ?>
  </td>
  <td>
    <?php
      echo ('<a href="my_index.php?action=delete&question_='.$question.'">删除</a>');
    ?>
  </td>
  
  </tr>
<?php }else{ ?>
    <tr id="hang_2">
  <td align="center">
  <?php 
    echo ($number);
    $number++;
?>
  </td>
  <td>
    <?php echo ('<a href="chakanquestion.php?action=chakan&question='.$question.'">'.$question.'</a>');?>

  </td>
  <td align="center">
    <?php 
    $_sql3="SELECT answer_content FROM question WHERE question_name='{$question}'";
    $result6=_fetch_array($_sql3);
    if ($result6!="") {
      foreach ($result6 as $numvalue) {
        // var_dump($answernum);
        // var_dump($numvalue);
        if ($numvalue!="") {
          // var_dump($answernum);
        $answernum++;
        }
      }echo ($answernum);
    }
    ?>
  </td>
  <td align="center">
    <?php echo ($time); ?>
  </td>
  <td>
    <?php
      echo ('<a href="my_index.php?action=delete&question_='.$question.'">删除</a>');
    ?>
  </td>
  <?php } ?>
  </tr>
  <?php } ?>
  </table><br><br>
  <table width="80%"  align="center" style="margin-top: 5%;font-size: 20px;" id="_table_">
  <tr><br><br>
  <th width="60%">我回答的问题</th>
  <th width="20%">回复时间</th>
  </tr>
  <?php
  $_sql6="SELECT answer_id,question_name,answer_time,answer_content FROM question WHERE answer_id='{$_COOKIE['userid']}'";
  $result7=_fetch_array($_sql6);
  $myanswernum=0;
  foreach ($result7 as $value) {
    $my_answer_content=$value['answer_content'];
    if ($_COOKIE['userid']==$value['answer_id']) {
      $myanswernum++;
      $Answertime=date("Y-m-d H:i:s",$value['answer_time']);
      $Answerquestion=$value['question_name'];
    }
  }
  if ($myanswernum!=0) {
    foreach($result7 as $value){
      $Answertime=date("Y-m-d H:i:s",$value['answer_time']);
      $Answerquestion=$value['question_name'];
  ?>
  <tr>
  <td>
    <?php 
      echo ('<a href="chakanquestion.php?action=chakan&question='.$Answerquestion.'">'.$Answerquestion.'</a>');
    ?>
  </td>
  <td><?php echo ($Answertime);?></td>
  </tr><?php }} ?>
  </table>
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