<?php
include "./connect.php";
if (isset($_COOKIE['userid']) ){


	date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
		
		$_sql="SELECT ponsor_id,post_time,question_name FROM question WHERE 1";
		$result=_fetch_array($_sql);
		// foreach ($value as $value) {
		// 	if ($value['ponsor_id']!="" && $value['post_time']!="") {
		// }
		// }	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>北风论坛home</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<a href="logout.php" title="">注销</a>
	<a href="my_index.php " title="">我的主页</a>
	<h1>欢迎来到北风论坛</h1>
	<?php
	$number=0;
		foreach ($result as $value) {
			if ($value['ponsor_id']!="" && $value['post_time']!="") {
				$ponsor_id=$value['ponsor_id'];
			
			$question_name=$value['question_name'];
			$post_time= date('Y-m-d H:i:s',$value['post_time']);
			$number++;
			echo ('<tr><p><h3><b><td>'.$number.'.</td><td>用户</td>'.$ponsor_id.'发表：<td><a href="chakanquestion.php?action=chakan&question='.$question_name.'">'.$question_name.'</a>&nbsp;</td><td>'.$post_time.'</td></b><h3></p></tr>');
		}
			

		}
	?>
</body>
</html>
<?php
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>