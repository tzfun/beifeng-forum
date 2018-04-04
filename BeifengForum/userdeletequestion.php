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
	$_sql4 = "DELETE FROM question WHERE question_name='{$_GET['question_']}'";
          $result4 = _query($_sql4);
          // var_dump($result4);
            _location('删除成功！','my_index.php');
          
}
 ?>
 </body>
 </html>