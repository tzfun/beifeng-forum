

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
//删除回答的功能暂时还存在bug，还未添加进论坛系统
include "./connect.php";//连接数据库
if (isset($_COOKIE['userid'])) {//用户登录后可进行操作，否则返回首页
	date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
		// var_dump($_COOKIE);
		// var_dump($_GET['question_name']);
		// var_dump($_GET['answer_content']);
		//检验是否有点击删除传入action
		if(isset($_GET['action']) && $_GET['action']=='delete'){
		$_sql1="SELECT question_name,answer_content,ponsor_id FROM question WHERE question_name='{$_GET['question_name']}'";
		$result1=_fetch_array($_sql1);
		 // var_dump($result1);
		//一一检索发布的问题
		foreach ($result1 as $value) {
			$ponsor_id=$value['ponsor_id'];
			$answer_content=$value['answer_content'];
			// var_dump($ponsor_id);
			// var_dump($_GET['answer_content']);
			//非发布者回答的内容进行删除回答记录
			if ($ponsor_id=="" && $answer_content==$_GET['answer_content']) {
				// var_dump($_GET['answer_content']);
							$_sql2="DELETE FROM question WHERE answer_content= '{$_GET['answer_content']}' ";
							// var_dump($_sql2);
					$result2 = _query($_sql2);
					if(_affected_rows()==1){
						_location('删除成功','my_index.php');
					}else{
						_alert('删除失败');
					}
			}
			var_dump($ponsor_id);
		}
		// var_dump($result2);
}
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>
</body>
</html>