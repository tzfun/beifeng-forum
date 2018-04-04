<?php 
include "./connect.php";
	if (isset($_COOKIE['userid']) ){
		date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
		
	    echo '你好，用户'.$_COOKIE['userid'];
		echo '<a href="logout.php">注销</a>&nbsp<a href="user_index.php" >论坛社区</a>&nbsp<a href="user_information.php?action=information&userid='.$_COOKIE['userid'].'&masage=information&play=update">管理我的信息</a>';
		if(isset($_POST['question'])){
			$_sql1 = "SELECT ponsor_id,question_name,post_time FROM question WHERE ponsor_id='{$_COOKIE['userid']}'";
			$result1 = _fetch_array($_sql1);
			// var_dump($result1);
			if ($_POST['question']=="") {
				_alert('问题不能为空！');
			}else{
				$datetime = date('Y-m-d H:i:s',time());//获取数据库系统时间
				$intdate = strtotime($datetime);//将date型字符方便转换为int型存进数据库
				$_sql2 = "INSERT INTO question(ponsor_id,question_name,post_time)values('{$_COOKIE['userid']}','{$_POST['question']}','$intdate')";
				$_result2 = _query($_sql2);
				_alert('问题发布成功！');
			}
		}
		if(isset($_GET['action']) && $_GET['action']=='delete'){
//删除提问
		// var_dump($_GET['question_']);
	$_sql4 = "DELETE FROM question 
									WHERE 
											question_name='{$_GET['question_']}'";
	$result4 = _query($_sql4);
	// var_dump($result4);
	if(_affected_rows()==1){
		_location('删除成功','user_index.php');
	}else{
			_alert('删除失败');
	}
}
//回复问题
	if(isset($_POST['action'])&& $_POST['action']=='answer'){
	
		$_sql5 = "SELECT answer_id FROM question WHERE question_name='{$_GET['question_']}'";
		$result5 = _query($_sql5);
		var_dump($result5);
		if ($value('answer_id')=="") {
			//如果无人回答，修改首字段值
	// echo $_POST['id'];
	// echo $_POST['newUsername'];
			$datetime = date('Y-m-d H:i:s',time());//获取数据库系统时间
			$intdate = strtotime($datetime);//将date型字符转换为int型方便存进数据库
	$_sql = "UPDATE question SET answer_id='{$_COOKIE['userid']}',answer_time='$intdate',answer_content='{$_POST['answer_content']}' WHERE question_name='{$_GET['question_']}'";
	$result = _query($_sql);
	if(_affected_rows()==1){
		_location('恭喜~回复成功！','user_index.php');
	}else{
		_alert('阿偶~回复失败！','user_index.php');
}
		}else{
			$_sql="ALTER TABLE question ADD answer VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER answer_id";
		}
		
	}
 ?>	
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>用户主页</title>
 	<link rel="stylesheet" href="css/inputbutton.css">
 </head>

 <body>
 <form action="my_index.php" method="post" accept-charset="utf-8">
 	<input type="text" name="question" placeholder="提问在这里输入" style="width:50%">
 	<input type="submit" value="发表问题">
 </form>
 <table border="1" width="70%">
 	<tr>
 	<th width="5%">序号</th>
 	<th width="40%">我的提问</th>
 	<th width="5%">回答数</th>
 	<th width="10%">发布时间</th>
 	<th width="5%">操作</th>
 	</tr>
 	<?php
 		$_sql1 = "SELECT ponsor_id,question_name,post_time,answer_content FROM question WHERE ponsor_id='{$_COOKIE['userid']}'";
 		$result3= _fetch_array($_sql1);
 		$number=1;
 		
 		
		foreach($result3 as $value){
			$answernum=0;
		$question = $value['question_name'];
		$time=date("Y-m-d H:i:s",$value['post_time']);//获取数据库时间并将int型转换成date型
	 //    var_dump($value['post_time']);
		// var_dump($time);
 	?>
 	<tr>
 	<td align="center">
	<?php 
		echo ($number);
		$number++;
	?>
	</td>
 	<td>
 		<?php
           echo ('<a href="question_page.php?action=answer&question_='.$question.'">'.$question.'</a>');

 		?>
 	</td>

 	<td align="center">
 		<?php 

 		$_sql3="SELECT answer_content FROM question WHERE question_name='{$question}'";
 		$result6=_fetch_array($_sql3);

 		if ($result6!="") {

 			foreach ($result6 as $numvalue) {
 				// var_dump($answernum);
 			 	// var_dump($numvalue);
 			 	if ($numvalue!="") {
 					// var_dump($answernum);
 				$answernum++;
 				 
 				}else{

 				}
 			}echo ($answernum);
 		}
 		?>
 	</td>
 	<td align="center">
 		<?php echo ($time); ?>
 	</td>
 	<td>
 		<?php
 			echo ('<a href="my_index.php?action=delete&question_='.$question.'">删除</a>');
 		?>
 	</td>
 	<?php } ?>
 	</tr>
 	</table><br><br>
 	<table width="70%" border="1">
 	<tr><hr><br><br>
 	<th width="60%">我回答的问题</th>
 	<th width="20%">回复时间</th>
 	</tr>
 	
 	<?php
 	$_sql6="SELECT answer_id,question_name,answer_time,answer_content FROM question WHERE answer_id='{$_COOKIE['userid']}'";
 	$result7=_fetch_array($_sql6);
 	$myanswernum=0;
 	foreach ($result7 as $value) {
 		$my_answer_content=$value['answer_content'];
 		if ($_COOKIE['userid']==$value['answer_id']) {
 			$myanswernum++;
 			$Answertime=date("Y-m-d H:i:s",$value['answer_time']);
 			$Answerquestion=$value['question_name'];
 		}
 	}
 	if ($myanswernum!=0) {
 		foreach($result7 as $value){
 			$Answertime=date("Y-m-d H:i:s",$value['answer_time']);
 			$Answerquestion=$value['question_name'];
 	?>
 	<tr>
 	<td>
 		<?php 
 			echo ('<a href="chakanquestion.php?action=chakan&question='.$Answerquestion.'">'.$Answerquestion.'</a>');
 		?>
 	</td>
 	<td>
 		<?php 
 			echo ($Answertime);
 		?>
 	</td>
 	</tr><?php }} ?>
 		
 	</table>

 	<h3></h3>
 </body>
 </html>
 <?php
	}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>