<?php
	//连接数据库
	$_conn=mysqli_connect('localhost','root','');
	if (!$_conn) {
		exit('数据库连接失败：'.mysqli_error($_conn));
	}
	mysqli_select_db($_conn,'forum')  or die('找不到数据库：'.mysqli_error($_conn).mysqli_errno($_conn));
	mysqli_query($_conn,"SET NAMES UTF8");
	define('IN_TG',true);
	include "./mysql.func.php";
 ?>