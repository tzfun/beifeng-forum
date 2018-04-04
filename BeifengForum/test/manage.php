<?php
include "./connect.php";
if (isset($_COOKIE['adminid'])){
	//删除
if(isset($_GET['action']) && $_GET['action']=='delete'){
	$_sql = "DELETE FROM user WHERE user_id = ({$_GET['id']})";
	$result = _query($_sql);
	if(_affected_rows()==1){
		_location('删除成功','manage.php');
	}else{
		_alert('删除失败');
	}
}

//修改
if(isset($_POST['action'])&& $_POST['action']=='update'){
	// echo $_POST['id'];
	// echo $_POST['newUsername'];
	$_sql = "UPDATE user SET user_id = '{$_POST['newUsername']}'
                              WHERE
                                  user_id='{$_POST['id']}'";
	$result = _query($_sql);
	if(_affected_rows()==1){
		_location('修改成功','manage.php');
	}else{
		_alert('修改失败');
	}
}
//查询所有用户
$_sql = "SELECT user_id,name,password,sex FROM user";
$result = _fetch_array($_sql);
//var_dump($result);
$_sql_="SELECT user_id,name,password,sex FROM admin";
$result_ = _fetch_array($_sql_);
//var_dump($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理</title>
</head>
<body>
<a href="admin_index.php">论坛社区</a>&nbsp
<a href="masage_manage.php">消息管理</a><br><br>
<!-- 打印管理员信息表 -->
<table border="1" width="100%">
管理员
<tr>
<th>序号</th>
<th>昵称</th>
<th>ID</th>
<th>密码</th>
<th>性别</th>
<th>发言记录</th>
<th>操作<?php echo('&nbsp<a href="add_user.php?action=add">增加</a>');?></th></tr>

<?php
	$number=1;
	foreach($result_ as $value){
		$nickname_ = $value['name'];
		$idnum_ = $value['user_id'];
		$pass_= $value['password'];
		$Sex_=$value['sex'];
?>
<tr>
<td align="center">
	<?php 
		echo ($number);
		$number++;
	?>
</td>
<td align="center">
	<?php 
		echo ($nickname_);
	?>
</td>
<td align="center">
	<?php
		echo ($idnum_);
	?>
</td>
<td align="center">
	<?php
		echo ($pass_);
	?>
</td>
<td align="center">
	<?php
		echo ($Sex_);
	?>
</td>
<td align="center">
	<a href="" title="" >查看</a>
</td>
<td align="center">
	<?php echo ('<a href="manage.php?action=delete&id='.$idnum_.'">删除</a>');?>
</td>
	<?php
		}
	?>
</tr>

		<!-- <form action="manage.php" method="post">
			<input type="hidden" name="action" value="update">
			<input type="hidden" name="id" value="<?php echo $idnum;?>">
			<input type="text" name="newNickname" value="<?php echo $nickname;?>">
			<input type="submit" value="修改">
		</form> -->
</table><br><br>




<!-- 打印用户信息表 -->
<table border="1" width="100%">
普通用户
<tr>
<th>序号</th>
<th>昵称</th>
<th>ID</th>
<th>密码</th>
<th>性别</th>
<th>发言记录</th>
<th>操作<?php echo('&nbsp<a href="add_user.php?action=add">增加</a>');?></th></tr>
<?php
	$number=1;
	foreach($result as $value){
		//var_dump($value);
		$nickname = $value['name'];
		$idnum = $value['user_id'];
		$pass= $value['password'];
		$Sex=$value['sex'];
?>
<tr>
<td align="center">
	<?php 
		echo ($number);
		$number++;
	?>
</td>
<td align="center">
	<?php 
		echo ($nickname);
	?>
</td>
<td align="center">
	<?php
		echo ($idnum);
	?>
</td>
<td align="center">
	<?php
		echo ($pass);
	?>
</td>
<td align="center">
	<?php
		echo ($Sex);
	?>
</td>
<td align="center">
	<a href="" title="" >查看</a>
</td>
<td align="center">
	<?php
		echo ('<a href="manage.php?action=delete&id='.$idnum.'">删除</a>');
		
	?>
</td>
	<?php
		}
	?>
</tr>
		<!-- <form action="manage.php" method="post">
			<input type="hidden" name="action" value="update">
			<input type="hidden" name="id" value="<?php echo $idnum;?>">
			<input type="text" name="newNickname" value="<?php echo $nickname;?>">
			<input type="submit" value="修改">
		</form> -->
</table>
<?php
	$datetime = date('Y-m-d H:i:s',time());
	$intdate = strtotime($datetime);
?>

</body>
</html>
<?php
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>