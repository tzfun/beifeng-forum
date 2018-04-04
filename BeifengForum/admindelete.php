
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<?php 
	include "./connect.php";//连接数据库
	if(isset($_GET['action']) && $_GET['action']=='delete'){
			$_sql = "DELETE FROM user WHERE user_id = ({$_GET['id']})";
	  $result = _query($_sql);
	  $_sql1 ="DELETE FROM question WHERE answer_id='{$_GET['id']}'";
	    $result1=_query($_sql1);
	    // var_dump($result1);
	  $_sql2 ="DELETE FROM question WHERE ponsor_id='{$_GET['id']}'";
	    $result2=_query($_sql2);
	    // var_dump($result2);
	    _location('删除成功','manage.php');
	}
 ?>
 </body>
 </html>