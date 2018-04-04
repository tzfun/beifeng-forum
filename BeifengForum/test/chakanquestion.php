<?php
include "./connect.php";
if (isset($_COOKIE['userid'])){


	date_default_timezone_set("Asia/Shanghai");//初始化时间，否则换算回来会有8个小时时差
		
		if(isset($_GET['action']) && $_GET['action']=='chakan'){
			$question_name=$_GET['question'];
			// var_dump($question_name);
			$_sql="SELECT ponsor_id,post_time,answer_id,answer_time,answer_content FROM question WHERE question_name='{$question_name}'";
			$result=_fetch_array($_sql);
			foreach ($result as $value) {
				if ($value['ponsor_id']!="" && $value['post_time']!="") {
					$ponsor_id=$value['ponsor_id'];
					$post_time=date("Y-m-d H:i:s",$value['post_time']);
				}
			}
			// var_dump($ponsor_id);
			$_sql1="SELECT name FROM user WHERE user_id='{$ponsor_id}'";
			$result1=_fetch_array($_sql1);
			foreach ($result1 as $value) {
				$post_name=$value['name'];
			}
			// var_dump($value['name']);
			// var_dump($ponsor_id);
			// var_dump($post_time);
		}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>问题详情</title>
	<link rel="stylesheet" href="css/inputbutton.css">
</head>
<body>

<a href="user_index.php">论坛社区   </a>   
<a href="my_index.php" >我的主页</a>

	<h1>
		<?php
			echo ($question_name);
		?>
	</h1>
	<p>发布者id
		<?php
			echo ($ponsor_id);
		?>
	</p>
	<p>昵称
		<?php
			echo ($post_name);
		?>
	</p>
	<p>发布时间
		<?php
			echo($post_time);
		?>
	</p>
	<table border="1" width="70%">
		<tr>
			<th align="left"><br>网友回复<br><br></th>
		</tr>
		<tr>
		<?php 
		echo ('<td>');
			foreach ($result as $value) {
				if ($value!="") {
					$answer_time=date("Y-m-d H:i:s",$value['answer_time']);
					echo ('用户'.$value['answer_id'].'回答：<p>&nbsp&nbsp'.$value['answer_content'].'</p><p align="right">'.$answer_time.'</p><hr>');
				}

			}
			echo ('</td>');
	
?>
		</tr>
	</table>
	<?php
echo ('<form action="question_page1.php" method="get" accept-charset="utf-8">
		
		
		<br><input checked="true" type="radio" name="question_" value="'.$question_name.'">'.$question_name.'<br><BR>
		<textarea name="answer_content" placeholder="有事没事吐槽两句吧" style="width:70%;height:200px;font-size:16px;"></textarea>
		<input type="submit" value="回复" style="width:100px;" align="center">
	</form>');

	?>
</body>
</html>
<?php
}else{
		_location('您还未登录，请登陆后访问！','index.php');
	}
?>