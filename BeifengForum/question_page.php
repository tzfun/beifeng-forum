<?php
include "./connect.php";
header("Content-Type:text/html;charset=utf-8");
if (isset($_COOKIE['userid'])){
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
  </head>
<style>
/*  div{
    border:1px solid red;
  }*/
/*  body{
    margin:0;
    padding: 0; 
  }  */
/*  ul,li{
    border:1px solid red;

  }*/
  #bg_photo{
    position: fixed;
    width: 100%;
    height: 100%;
  }
  .main_body{
    position: absolute;
    z-index: 9888;
    width: 70%;
    height: 100%;
    margin: 0px;
    top: 60px;
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
    position: absolute;
    width: 100%;

    z-index: 10000;
    bottom: 0px;
    text-align: center;
  }
  #question_name{
    margin-top:30px;
    margin-left: 100px;
    font-size: 30px;
  }
  .poster_id{
    margin-left: 100px;
    margin-top: 20px;
    font-size: 20px;
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
        
        <div class="main_body">
            <?php
  
  $user_id=$_COOKIE['userid'];
  // var_dump($_COOKIE['userid']);
  // var_dump($_GET['action']);
    $question=$_GET['question_'];
    $_sql1="SELECT name,user_id FROM user WHERE user_id='{$_COOKIE['userid']}'";
    $result1 =  _fetch_array($_sql1);
    $_sql2="SELECT post_time,question_name,answer_content,answer_id,answer_time FROM question WHERE question_name='{$question}'";
    $result2= _fetch_array($_sql2);
    // var_dump($result1[0]['name']);
    $zuozhe_id=$_COOKIE['userid'];
    $zuozhe_name=$result1[0]['name'];
    // var_dump($result2);
    foreach ($result2 as $value){
      if ($value!="" && $value['post_time']!=""){
        $post_time=date("Y-m-d H:i:s",$value['post_time']);//从数据库取出时间并转换格式存进post_time
      } 
    }
    //  var_dump($post_time);
    ?>
    <p id="question_name"><?php echo ($question);?></p>
	<p class="poster_id">作者id：<?php echo $zuozhe_id;?></p>
	<p class="poster_id">昵称：<?php echo $zuozhe_name;?></p>
	<p class="poster_id">发布时间：<?php echo $post_time;?></p>
	<table width="70%" style="margin-left: 100px;">
    <tr>
      <th align="left" style="font-size: 18px;"><br>网友回复<br><br></th>
    </tr>
    <tr>
    <?php 
    echo ('<td>');
      foreach ($result2 as $value) {
        if ($value!="" && $value['answer_time']!="") {
          $answer_time=date("Y-m-d H:i:s",$value['answer_time']);
          echo ('用户'.$value['answer_id'].'回答：<p>&nbsp&nbsp<br>'.$value['answer_content'].'</p><p align="right">'.$answer_time.'</p><hr>');
          
          // $value['answer_content'].'&nbsp'.$value['answer_id'].'&nbsp'.$answer_time.'<br><hr>'
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
  echo ('<form action="question_page1.php? method="get" accept-charset="utf-8">
    <br>
    <p style="margin-left:100px;font-size:20px;color:#006699"><input  checked="true" type="radio" name="question_" value="'.$question.'" >'.$question.'</p><br><br>
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