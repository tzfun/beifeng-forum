<?php
include "./connect.php";
date_default_timezone_set("Asia/Shanghai");
if (isset($_COOKIE['adminid'])){
	echo '你好，管理员'.$_COOKIE['adminid'];
		echo '<a href="logout.php">注销</a>  ';
		echo '<a href="manage.php">人员管理</a>   ';
		echo '<a href="admin_index.php " title="">论坛社区</a>';
	//初始化时间，否则换算回来会有8个小时时差
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
	<link rel="stylesheet" href="css/inputbutton.css">
</head>
<body>
	
	<?php
	$number=0;
		foreach ($result as $value) {
			if ($value['ponsor_id']!="" && $value['post_time']!="") {
				$ponsor_id=$value['ponsor_id'];
			$post_time=$value['post_time'];
			$question_name=$value['question_name'];
			$number++;
			echo ('<p><h3><b><a href="masage_manage.php?action=delete&delete_question='.$question_name.'">删除</a>&nbsp'.$number.'.&nbsp<a href="chakanquestion_.php?action=chakan&question='.$question_name.'">'.$question_name.'</a>&nbsp'.$ponsor_id.'&nbsp'.$post_time.'</p></h3></b>');
		}
		}
		if (isset($_GET['action']) && $_GET['action']=='delete') {
			$_sql="DELETE FROM question WHERE question_name='{$_GET['delete_question']}'";
			$result = _query($_sql);
				_location('删除成功','masage_manage.php');
		}
	?>
</body>
</html>
<?php
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>