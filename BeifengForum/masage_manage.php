<?php
include "./connect.php";//连接数据库
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
if (isset($_COOKIE['adminid'])){
  //检索所有发言记录
    $_sql="SELECT ponsor_id,post_time,question_name FROM question WHERE 1";
    $result=_fetch_array($_sql); 
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
    <script type="text/javascript">
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
        <legend>消息列表</legend>
        <div class="layui-field-box layui-form">
          <table class="layui-table admin-table">
            <thead>
              <tr>
                <th>序号</th>
                <th>用户ID</th>
                <th>发布时间</th>
                <th>发布内容</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody id="content">
              <?php
                $number=0;
                foreach($result as $value){
                  //var_dump($value);
                  //查询所有发布记录的信息
                  if ($value['ponsor_id']!="" && $value['post_time']!="") {
                  $ponsor_id=$value['ponsor_id'];
                  $post_time=date('Y-m-d H:i:s',$value['post_time']);//讲数据库内的时间戳转换为date数据
                  $question_name=$value['question_name'];
                  $number++;
              ?>
              <tr>
                <td style="width: 5%"><?php echo ($number);?></td>
                <td style="width: 10%"><?php echo ($ponsor_id);?></td>
                <td style="width: 10%"><?php echo($post_time);?></td>
                <td><?php echo ('<a href="chakanquestion_.php?action=chakan&question='.$question_name.'">'.$question_name.'</a>');?></td>
                <td style="width: 15%">
                <?php
                  echo ('<a href="masage_manage.php?action=delete&delete_question='.$question_name.'" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" >删除</a>');
                  ?>
                </td>
                <?php }}
                  if (isset($_GET['action']) && $_GET['action']=='delete') {
                    $_sql="DELETE FROM question WHERE question_name='{$_GET['delete_question']}'";
                    $result = _query($_sql);
                      _location('删除成功','masage_manage.php');
                  }
                ?>
              </tr>
            </tbody>
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