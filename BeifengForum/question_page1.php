
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
include "./connect.php";
header("Content-Type:text/html;charset=utf-8");
if (isset($_COOKIE['userid'])){
	$user_id=$_COOKIE['userid'];
	//回复问题
	if($_GET['answer_content']!=""){
		 // var_dump($_GET['question_']);
		$question=$_GET['question_'];
		$_sql3 = "SELECT answer_id,ponsor_id,question_name,post_time,answer_content,answer_time FROM question WHERE question_name='{$question}'";
		$result3 = _fetch_array($_sql3);
		// var_dump($result3);
			if ($result3[0]['answer_id']==""){
			//如果无人回答，修改首字段值
			$datetime = date('Y-m-d H:i:s',time());//获取数据库系统时间
			$intdate = strtotime($datetime);//将date型字符转换为int型方便存进数据库
		$_sql4 = "UPDATE question SET answer_id='{$_COOKIE['userid']}',answer_time='$intdate',answer_content='{$_GET['answer_content']}' WHERE question_name='{$question}'";
		$result4 = _query($_sql4);
		if(_affected_rows()==1){
					_location('恭喜~回复成功！','chakanquestion.php?action=chakan&question='.$question.'');
				}else{
					_alert('阿偶~回复失败！');
					 }
		}else{
			//如果有人回答就添加回答
			$question=$_GET['question_'];
		$_sql3 = "SELECT answer_id,ponsor_id,question_name,post_time,answer_content,answer_time FROM question WHERE question_name='{$question}'";
		$result3 = _fetch_array($_sql3);
			$ponsor_id=$result3[0]['ponsor_id'];
			$datetime = date('Y-m-d H:i:s',time());//获取数据库系统时间
			$intdate = strtotime($datetime);//将date型字符转换为int型方便存进数据库
			$_sql5 = "INSERT INTO question(question_name,answer_id,answer_time,answer_content)values('{$question}','{$_COOKIE['userid']}','{$intdate}','{$_GET['answer_content']}')";

			// $_sql5 = "INSERT INTO question(ponsor_id,question_name,post_time,answer_id,answer_time,answer_content)values('{$result3[0]['ponsor_id']}','{$question}','{$result3[0]['post_time']}','{$_COOKIE['userid']}','{$intdate}','{$_GET['answer_content']}')";
			$_result5 = _query($_sql5);
			// var_dump($_result5);
		if(_affected_rows()==1){
					_location('恭喜~回复成功！','chakanquestion.php?action=chakan&question='.$question.'');
				}else{
					_alert('阿偶~回复失败！');
					 }
		}
		}else{
			_alert('回复不能为空！','question_page.php?action=answer');}
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>
</body>
</html>