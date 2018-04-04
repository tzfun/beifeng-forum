<?php
	include "./connect.php";
	if (isset($_COOKIE['userid'])) {
		
		echo '你好，用户'.$_COOKIE['userid'];
		echo '<a href="logout.php">注销</a>&nbsp<a href="user_index.php" >论坛社区</a>';
	if (isset($_GET['action']) && $_GET['action']=='information') {
		$_sql="SELECT user_id,name,sex,password FROM user WHERE user_id='{$_COOKIE['userid']}'";
		$result=_fetch_array($_sql);
		// var_dump($result);
	}

	if (isset($_GET['action']) && $_GET['action']=='information' && $_GET['play']=="update_information") {

	// var_dump($_POST['new_name']);
	// var_dump($_POST['new_sex']);
		$_sql1="UPDATE user SET name='{$_POST['new_name']}',sex='{$_POST['new_sex']}' WHERE user_id='{$_COOKIE['userid']}'";  
		$result1=_query($_sql1);
		if(_affected_rows()==1){
		_location('修改成功','user_information.php?action=information&userid='.$_COOKIE['userid'].'&masage=information&play=update');
	}else{
		_alert('修改失败');
	}
	}elseif (isset($_GET['action']) && $_GET['action']=='information' && $_GET['play']=="update_password") {
		// var_dump($_POST['new_name']);
		// var_dump($_POST['new_sex']);
		if ($_POST['oldpassword']!=$result[0]['password']) {
			_location('旧密码不正确！','uppassword.php?action=information&masage=information&play=update_password');
		}elseif ($_POST['newpassword']!=$_POST['check_newpassword']) {
			_location('两次新密码密码不一致！','uppassword.php?action=information&masage=information&play=update_password');
		}elseif($_POST['newpassword']==""){
			_location('请输入新密码！','uppassword.php?action=information&masage=information&play=update_password');
		}elseif($_POST['newpassword']==$result[0]['password']){
			_location('请输入和旧密码不同的新密码才可修改！','uppassword.php?action=information&masage=information&play=update_password');
		}else{
			// var_dump($_POST['newpassword']);
			$_sql2="UPDATE user SET name='{$_POST['new_name']}',sex='{$_POST['new_sex']}',password='{$_POST['newpassword']}' WHERE user_id='{$_COOKIE['userid']}'";  
		$result2=_query($_sql2);
		if(_affected_rows()==1){
		_location('修改成功,请重新登录！','logout.php');
	}else{
		_alert('修改失败');
	}
		}
	}
	}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
	
?>