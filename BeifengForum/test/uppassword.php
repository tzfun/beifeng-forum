<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>个人信息</title>
	<link rel="stylesheet" href="css/inputbutton.css">
</head>
<body>
	<?php
	include "./connect.php";
	if (isset($_COOKIE['userid']) ) {

	echo '你好，用户'.$_COOKIE['userid'];
		echo '<a href="logout.php">注销</a>&nbsp<a href="user_index.php" >论坛社区</a>';
	if (isset($_GET['action']) && $_GET['action']=='information') {
		$_sql="SELECT user_id,name,sex,password FROM user WHERE user_id='{$_COOKIE['userid']}'";
		$result=_fetch_array($_sql);
		// var_dump($result);
	}
	// var_dump($_GET['play']);
?>
	<form action="check_upinformation.php?action=information&play=update_password" method="post" accept-charset="utf-8">
<?php 
	if ($_GET['masage']=="information" && $_GET['play']=="update_password") {
		echo ('<p>ID：<input type="text" name="user_id" value="'.$result[0]['user_id'].'" disabled></p>');
	echo ('<P>昵称：<input type="text" name="new_name" value="'.$result[0]['name'].'"></P>');
	if ($result[0]['sex']=="boy") {
			echo ('<p>性别：<input checked="true" type="radio" name="new_sex" value="boy">男<input type="radio" name="new_sex" value="girl">女</P>');
		}else{
			echo ('<p>性别：<input  type="radio" name="new_sex" value="boy">男<input checked="true" type="radio" name="new_sex" value="girl">女</P>');
		}
	
	echo ('<p>旧密码：<input type="password" name="oldpassword" placeholder="请输入旧密码"></p>');
	echo ('<p>新密码：<input type="password" name="newpassword" placeholder="请输入新密码"></p>');
	echo ('<p>确认新密码：<input type="password" name="check_newpassword" placeholder="请确认新密码"></p>');
	echo ('<p><input type="submit" value="更新" style="width:100px;" align="center"></p>');
	}


	
?>	
	</form>
</body>
</html>
<?php
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>

