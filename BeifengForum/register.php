
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>注册北风账号</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <style type="text/css">
* { margin:0; padding:0; }
body { width:100%; height:100%; overflow:hidden; }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="layui/layui.all.js"></script>
</head>
<style>
/*        div{
            border:1px solid red;
        }*/
        body,html{
          width: 100%;
          height: 100%;
        }
        .bg_box{
            width:480px;
            height:550px;
            background-color:#ccffff;
            margin:0px auto;
            border-radius: 10px;
            background:rgba(225,225,225,0.4867);
            }

        .position_box2{
        position: relative;
        top:120px;
        
        }
        .position_font{
        font-size:25px;
        position: relative;
        width: 58px;
        margin-left: 50%;
        top:80px;
        left:-29px;
        }
        #background {
    position: fixed;
    top: 0;
    left: 0;
    z-index: -100;
  }
        #photo{
    margin: 0;
    padding: 0;
    width: 120px;
  }
  #bgImg{
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: -1;
  }
</style>
  <body>
    <img id="bgImg" src="images/bg1.png" alt="">
    <a href="index.php">
<span style="font-size:40px;color:#ccffff;" id="section">
  <img src="images/LOGO.png" id="photo">北风论坛
  </span>
</a>

  <div style="position:absolute;left:50%;margin-left:-240px;top:50%;margin-top:-300px">
  <div class="bg_box position_box">
  <div class="position_font">
  <p>注册</p>
  </div>
    <div style="margin:20px">
      <form class="layui-form" action="register.php" method="post">
      <div class="position_box2">
      <div class="layui-form-item">
          <label class="layui-form-label">ID:</label>
          <div class="layui-input-inline">
            <input type="text" name="userid" lay-verify="pass_id" placeholder="请输入ID" autocomplete="off" class="layui-input">
          </div>
          <div class="layui-form-mid layui-word-aux">请填写6到10位id</div>
        </div>
      
      
      
        <div class="layui-form-item" style="width:300px">
          <label class="layui-form-label">昵称:</label>
          <div class="layui-input-block">
            <input type="text" name="username" lay-verify="title" autocomplete="off" placeholder="请输入昵称" class="layui-input">
          </div>
        </div>
        

        <div class="layui-form-item">
          <label class="layui-form-label">密码:</label>
          <div class="layui-input-inline">
            <input type="password" name="password" lay-verify="pass_word" placeholder="请输入密码" autocomplete="off" class="layui-input">
          </div>
          <div class="layui-form-mid layui-word-aux">请填写6到12位密码</div>
        </div>
         
        <div class="layui-form-item">
          <label class="layui-form-label">性别:</label>
          <div class="layui-input-block">
            <input type="radio" name="sex" value="boy" title="男" >
            <input type="radio" name="sex" value="girl" title="女">
          </div>
        </div>


        <div class="layui-form-item">
          <div  class="layui-input-block position_box" style="position:relative;top:40px" >
          <!-- <button type="submit" class="layui-btn" lay-submit lay-filter="demo1">注册</button>  -->
          <input type="submit" class="layui-btn layui-btn-primary" lay-submit value="注册" style="width: 100px;border-radius:20px;color: #009688">         
          <input  type="button" onclick="javascript:window.location.href='user_login.php'" class="layui-btn layui-btn-primary" value="返回" style="width: 100px;margin-left: 40px;border-radius:20px;color: #009688">
          </div>
        </div>
      </div>
      </form>
      
      <!-- <button class="layui-btn"  onclick="javascript:window.location.href='user_login.php'" lay-filter="demo1" style="margin-top: 108px;margin-left: 250px;">返回</button> -->
      
    </div>
  </div>
  </div>
  <script type="text/javascript" src="plugins/layui/layui.js"></script>
    <script>
      layui.use(['form', 'layedit', 'laydate'], function() {
        var form = layui.form(),
          layer = layui.layer,
          layedit = layui.layedit,
          laydate = layui.laydate;

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');
        //自定义验证规则
        form.verify({
          title: function(value) {
            if(value.length ==0 ) {
              return '请输入昵称';
            }
          },
          pass_word: [/(.+){6,12}$/, '密码必须6到12位'],
          content: function(value) {
            layedit.sync(editIndex);
          },
          pass_id: [/(.+){6,10}$/, 'ID必须6到10位'],
          content: function(value) {
            layedit.sync(editIndex);
          }
        });

        //监听提交
      });
    </script>
    <?php
include "./connect.php";
//接收数据
// var_dump($_POST['userid']);
// var_dump($_POST['password']);
// var_dump($_POST['sex']);
// var_dump($_POST['name']);
if(isset($_POST['userid']) && isset($_POST['password']) && isset($_POST['sex']) && isset($_POST['username'])){
  //判断id是否存在
  $_sql1 = "SELECT user_id FROM user WHERE user_id='{$_POST['userid']}'";
  //插入到数据库中
  $result1 = _fetch_array($_sql1);
  if(!empty($result1[0])){
    // _alert('用户id已存在！');
    ?>
<script>
      layer.open({
                  title: '北风提示'
                  ,content: "用户id已存在！" 

                });
    </script>
    <?php
  }else{
  $_sql = "INSERT INTO user(user_id,password,name,sex)values('{$_POST['userid']}','{$_POST['password']}','{$_POST['username']}','{$_POST['sex']}')";
  $_result2 = _query($_sql);
  ?>
<script>
      layer.open({
                  title: '北风提示'
                  ,content: "恭喜~注册成功！" 

                });
    </script>
    <?php

  // _location('恭喜你注册成功！','user_login.php');

  _close();
  }
  }
?>
  </body>
</html>