<?php 
	$_sql_="SELECT user_id,name,password,sex FROM admin WHERE user_id='{$_COOKIE['adminid']}'";//查询当前登录管理员的信息
	$result_ = _fetch_array($_sql_);
	//var_dump($result);
?>