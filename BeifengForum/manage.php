<?php
include "./connect.php";//连接数据库
header("Content-Type:text/html;charset=utf-8");
if (isset($_COOKIE['adminid'])){//管理员登录过方可进入，否则返回首页
  //删除
if(isset($_GET['action']) && $_GET['action']=='delete'){

  echo ('<script> if(confirm( "删除后不可恢复，你确定要删除吗？"))  location.href="admindelete.php?action=delete&id='.$_GET['id'].'";else location.href="manage.php"; </script>');
}
//修改
if(isset($_POST['action'])&& $_POST['action']=='update'){
  // echo $_POST['id'];
  // echo $_POST['newUsername'];
  $_sql = "UPDATE user SET user_id = '{$_POST['newUsername']}'
                              WHERE
                                  user_id='{$_POST['id']}'";
  $result = _query($_sql);
  if(_affected_rows()==1){
    _location('修改成功','manage.php');
  }else{
    _alert('修改失败');
  }
}
//查询所有用户
$_sql = "SELECT user_id,name,password,sex FROM user";
$result = _fetch_array($_sql);
//var_dump($result);
?>
<!DOCTYPE html>
<html>
  <head>
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
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
  </head>
  <body>
  <div style="position:absolute;width:100%">
    <div class="admin-main">
      <blockquote class="layui-elem-quote">
      </blockquote>
      <fieldset class="layui-elem-field">
        <legend>用户列表</legend>
        <div class="layui-field-box layui-form">
          <table class="layui-table admin-table">
            <thead>
              <tr>
                <th>序号</th>
                <th>昵称</th>
                <th>ID</th>
                <th>密码</th>
                <th>性别</th>
                <th>发言记录</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody id="content">
              <?php
                $number=1;
                foreach($result as $value){
                  //var_dump($value);
                  $nickname = $value['name'];
                  $idnum = $value['user_id'];
                  $pass= $value['password'];
                  $Sex=$value['sex'];
              ?>
              <tr>
                <td><?php echo ($number); $number++;?></td>
                <td><?php echo ($nickname);?></td>
                <td><?php echo ($idnum);?></td>
                <td><?php echo ($pass);?></td>
                <td><?php echo ($Sex);?></td>
                <td><a href="" title="" >查看</a></td>
                <td>
                <?php
                  echo ('<a href="manage.php?action=delete&id='.$idnum.'" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" >删除</a>');
                  echo ('<a href="register_.php" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" >增加</a>');
                  ?>
                </td>
                <?php }?>
              </tr>
            </tbody>
          </table>
          <?php
            $datetime = date('Y-m-d H:i:s',time());
            $intdate = strtotime($datetime);
          ?>
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