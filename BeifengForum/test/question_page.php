<?php
include "./connect.php";
if (isset($_COOKIE['userid'])) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>回复</title>
	<link rel="stylesheet" href="css/inputbutton.css">
</head>

<body>
<a href="my_index.php" >我的主页</a>
<h1>

	<?php
	
	$user_id=$_COOKIE['userid'];
	// var_dump($_COOKIE['userid']);
	// var_dump($_GET['action']);
		$question=$_GET['question_'];
		$_sql1="SELECT name,user_id FROM user WHERE user_id='{$_COOKIE['userid']}'";
		$result1 =  _fetch_array($_sql1);
		$_sql2="SELECT post_time,question_name,answer_content,answer_id,answer_time FROM question WHERE question_name='{$question}'";
		$result2= _fetch_array($_sql2);
		// var_dump($result1[0]['name']);
		$zuozhe_id=$_COOKIE['userid'];
		$zuozhe_name=$result1[0]['name'];
		// var_dump($result2);
		foreach ($result2 as $value){
			if ($value!="" && $value['post_time']!=""){
				$post_time=date("Y-m-d H:i:s",$value['post_time']);//从数据库取出时间并转换格式存进post_time
			} 
		}
		
		//  var_dump($post_time);
		echo ($question);

	?>
</h1>
<p>作者id：
	<?php 
		echo $zuozhe_id;
	?>
</p>
<p>昵称：
	<?php 
		echo $zuozhe_name;
	?>
</p>
<p>发布时间：
	<?php 
		echo $post_time;
	?>
</p>
<table border="1" width="70%">
		<tr>
			<th align="left"><br>网友回复<br><br></th>
		</tr>
		<tr>
		<?php 
		echo ('<td>');
			foreach ($result2 as $value) {
				if ($value!="" && $value['answer_time']!="") {
					$answer_time=date("Y-m-d H:i:s",$value['answer_time']);
					echo ('用户'.$value['answer_id'].'回答：<p>&nbsp&nbsp'.$value['answer_content'].'</p><p align="right">'.$answer_time.'</p><hr>');
					
					// $value['answer_content'].'&nbsp'.$value['answer_id'].'&nbsp'.$answer_time.'<br><hr>'
				}

			}
			echo ('</td>');
	
?>
		</tr>
	</table>
<?php
	echo ('<form action="question_page1.php? method="get" accept-charset="utf-8">
		<br>
		<input checked="true" type="radio" name="question_" value="'.$question.'">'.$question.'<br><br>
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