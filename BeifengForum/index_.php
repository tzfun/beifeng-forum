<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>首页</title>
	<link rel="stylesheet" href="">
</head>
<body>
<!-- 根据角色不同进入不同页面 -->
	<?php
	// var_dump($_COOKIE['userid']);
	//如果浏览器存在用户cookie可直接进入主页
	if (isset($_COOKIE['userid'])) {
		header("Location:user_index.php");
	}
	{
				//跳转至管理员登录界面
			if ($_POST['role']=="admin") {
				// header("Location:admin_login.php");
				_location('','admin_login.php');
				//跳转至游客主界面
				}elseif ($_POST['role']=="user") {
				// header("Location:user_login.php");
				_location('','user_login.php');
			}
}
?>
</body>
</html>