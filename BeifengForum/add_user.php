<?php
include "./connect.php";
//接收数据
if (isset($_COOKIE['adminid'])){


if(isset($_POST['userid']) && isset($_POST['password']) && isset($_POST['sex']) && isset($_POST['name'])){
	// if ($_POST['userid']=="") {
	// 	_alert('请输入用户id!');
	// }elseif ($_POST['password']=="") {
	// 	_alert('请输入密码!');
	// }elseif ($_POST['sex']=="") {
	// 	_alert('请选择性别!');
	// }elseif ($_POST['name']=="") {
	// 	_alert('请输入用户名！');
	// }
	//判断id是否存在
	$_sql1 = "SELECT user_id FROM user WHERE user_id='{$_POST['userid']}'";
	//插入到数据库中
	$result1 = _fetch_array($_sql1);
	if(!empty($result1[0])){
		_alert('用户id已存在！');
	}else{
	$_sql = "INSERT INTO user(user_id,password,name,sex)values('{$_POST['userid']}','{$_POST['password']}','{$_POST['name']}','{$_POST['sex']}')";
	$_result2 = _query($_sql);
	_location('恭喜你添加成功！','manage.php');
	_close();
	}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>添加成员</title>
	<link rel="stylesheet" href="css/inputbutton.css">
</head>
<body>
	<form action="add_user.php" method="post">
		用户ID：<input type="text" name="userid" placeholder="请输入用户id"><br>
		密码：<input type="password" name="password" placeholder="请输入密码"><br>
		用户名：<input type="text" name="name" placeholder="请输入用户名"><br>
		请选择性别：<input type="radio" name="sex" value="boy">男
		<input type="radio" name="sex" value="girl">女<br>
		<input type="submit" value="添加">
	</form>
</body>
</html>
<?php
	}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>