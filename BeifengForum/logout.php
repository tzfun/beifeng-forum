
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title></title>
</head>
<body>
	<?php
	include "./connect.php";
	setcookie('userid','',time()-1);//清除cookie并跳转至主页
	_location('注销成功','index.php');

?>
</body>
</html>