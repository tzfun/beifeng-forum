
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>登录</title>
	<link rel="stylesheet" href="css/inputbutton.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="css/login.css" />
		<style>
/*		div{
			border:1px solid red;
		}*/
	body, html {
		width: 100%;
		height: 100%;
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		overflow-x: hidden;
		margin: 0;
		padding: 0;
	}
	#background {
		position: fixed;
		top: 0;
		left: 0;
		z-index: -100;
	}
	#photo{
  	margin: 0;
  	padding: 0;
  	width: 120px;
  }
  #bgImg{
  	position: absolute;
  	width: 100%;
  	height: 100%;
  	z-index: -1;
  }
	</style>
</head>
<body>
<img id="bgImg" src="images/bg1.png">
<script type="text/javascript" src="layui/layui.all.js"></script>
<a href="index.php">
<span style="font-size:40px;color:#ccffff;" id="section">
	<img src="images/LOGO.png" id="photo">北风论坛
	</span>
</a>


<div id="dd">

	</div>
	<div class="beg-login-box">
			<header>
				<h1>用户登录</h1>
			</header>
			<div class="beg-login-main">

				<form  class="layui-form" id="userform" method="post">
					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe612;</i>
                    	</label>

						<input type="text" id="username" name="userid" lay-verify="userName" autocomplete="off" placeholder="这里输入用户id" class="layui-input">
					</div>

					<div class="layui-form-item">
						<label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    	</label>
						<input type="password" name="password" id="password" lay-verify="password" autocomplete="off" placeholder="这里输入密码" class="layui-input">
					</div>

					<div class="layui-form-item">
						<div class="beg-pull-right" style="margin-top: 20px;">
							<!-- <div class="beg-pull-right" style="margin-left: 82px;">
									<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
		                            <i class="layui-icon" style="width: 100px;border-radius:20px">&#xe650;</i> 登录
		                        	</button>
                        	</div>
                        	<div class="beg-pull-right">
                        		 <button type="button" class="layui-btn layui-btn-primary" action="register.php" lay-filter="login">
		                            <i class="layui-icon" style="width: 100px;border-radius:20px">&#xe609;</i> 注册
		                        </button>
                        	</div>
 -->
							<input type="submit" class="layui-btn layui-btn-primary" value="登录" style="width: 100px;border-radius:20px">
                            <input  type="button" onclick="javascript:window.location.href='register.php'" class="layui-btn layui-btn-primary" value="注册" style="width: 100px;margin-left: 60px;border-radius:20px ">
                        	
						</div>
<!-- 						<div class="beg-clear"></div> -->
					</div>
				</form>
			</div>
			<footer>
				<p style="color: #660033;">Copyright © 2017 BeiFengTZ</p>
			</footer>
		</div>
</div>
	<?php
	// 导入链接数据库文件
	include "./connect.php";
	if (isset($_COOKIE['userid'])) {
		header("Location:user_index.php");
	}
	if(isset($_POST['userid']) && isset($_POST['password']) && $_POST['userid']!=""){
	//从数据库里查找用户名是否存在
	$_sql1 = "SELECT user_id,password FROM user WHERE user_id='{$_POST['userid']}'";
	$result = _fetch_array($_sql1);
	// var_dump($result);//打印结果，方便调试
	if(!empty($result[0])){
		//echo '有这个用户';
		if($result[0]['password']==$_POST['password']){
			// echo '登陆成功';
			setcookie('userid',$_POST['userid']);//创建cookie
			 ?>
		<script>
			location.href="user_login.php";
		</script>
		<?php
		}else{
			// _alert('密码错误');
			?>
		<script>
			layer.open({
                  title: '提示'
                  ,content: "密码错误！"     
                });
		</script>
		<?php
		}
	}else{
		// _alert('用户名不存在');
		?>
		<script>
			layer.open({
                  title: '提示'
                  ,content: "用户名ID不存在！" 

                });
		</script>
		<?php
	}
	_close();
	exit;
}
?>
</body>
</html>
