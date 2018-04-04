<?php
include "./connect.php";
header("Content-Type:text/html;charset=utf-8");
if (isset($_COOKIE['userid']) ){
  

  date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
    
    $_sql="SELECT ponsor_id,post_time,question_name FROM question WHERE 1";
    $result=_fetch_array($_sql);

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
    top: 0;
  }
  .main_body{
    position: absolute;
    z-index: 9988;
    width: 70%;
    height: 100%;
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
    margin-top: 20px;
    z-index: 10000;
    text-align: center;
  }
  #table{
    height: 100%;
    box-shadow:2px 2px  3px 3px #3eede7;
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
    margin-top: 100px;
  }
</style>

  <body>
  <img src="images/bg.png" id="bg_photo">
  <div class="bg_">
  </div>
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
          <form action="user_index.php" method="post" accept-charset="utf-8">
            <input type="text" name="question" placeholder="提问在这里输入" style="width:50% ; font-size: 20px">
            <input type="submit" value="发表问题" style="width: 100px;margin-left: 30px;font-size: 20px">
          </form>
        </div>
        <table width="80%"  align="center" style="margin-top: 7%;font-size: 20px;" id="table_">
          <th colspan="4" height="100px" style="font-size: 35px;">网友们都在吐槽</th>
        
          <?php
  $number=0;
    foreach ($result as $value) {
      if ($value['ponsor_id']!="" && $value['post_time']!="") {
      	$_sql3="SELECT name FROM user WHERE user_id='{$value['ponsor_id']}'";
  	  	$result3=_fetch_array($_sql3);
        $ponsor_id=$value['ponsor_id'];
      $username=$result3[0]['name'];
      $question_name=$value['question_name'];
      $post_time= date('Y-m-d H:i:s',$value['post_time']);
      $number++;
      
      if ($number%2==0) {
        echo ('<tr id="hang_1"><p><h3><b><td width="3%">'.$number.'.</td><td width="20%">用户 <font style="color:#00cccc;">'.$username.'</font> 发表：</td><td width="55%" id="question"><a href="chakanquestion.php?action=chakan&question='.$question_name.'">'.$question_name.'</a>&nbsp;</td><td width="12%">'.$post_time.'</td></b><h3></p></tr>');
      }else{
        echo ('<tr id="hang_2"><p><h3><b><td width="3%">'.$number.'.</td><td width="20%">用户 <font style="color:#00cccc;">'.$username.'</font> 发表：</td><td width="55%" id="question"><a href="chakanquestion.php?action=chakan&question='.$question_name.'">'.$question_name.'</a>&nbsp;</td><td width="12%">'.$post_time.'</td></b><h3></p></tr>');
      }
      
    }
      

    }
  ?>
</table><br><br><br><br>
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