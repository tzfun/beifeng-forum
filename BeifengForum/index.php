<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<title>首页</title>
	<link rel="shortcut icon" href="images/LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="css/inputbutton.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="plugins/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="css/login.css" />
	<style>
	*{
			margin: 0;
		}
	body, html {
		width: 100%;
		height: 100%;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: 0;
		padding: 0;
		overflow-x:hidden;
		overflow-y:hidden;
	}
/* 	div{
		border:1px solid red;
	} */
	#background {
		position: fixed;
		top: 0;
		left: 0;
		z-index: -100;
	}
	#main{
		position: relative;
		width: 300px;
		height: 20px;
		left: 50%;
		margin-left: -150px;
		margin-top: 48%;
	}
	.list{
		width: 200px;
		height: 80px;
		border-radius: 5px;
		margin:0 auto;
	}
	@keyframes box{
                0%{transform: rotateZ(0deg);}
                20%{transform:  rotateZ(72deg);}
                40%{transform:  rotateZ(144deg);}
                60%{transform: rotateZ(216deg);}
                80%{transform: rotateZ(288deg);}
                100%{transform: rotateZ(360deg);}
        }
	#box1{
		width: 140px;
		height: 60px;
		float: left;
		font-size: 25px;
		color: #003333;
	}
	#box1 input{
		width: 140px;
		height: 60px;
	}
	#box1:hover{
		background-color: #666666;
		color: #993300;
		float: left;
		font-size: 25px;
	}
	#box2{
		width: 140px;
		height: 60px;
		margin-left: 20px;
		float: left;
		font-size: 25px;
		color: #003333;
	}
	#box2 input{
		width: 140px;
		height: 60px;
	}
	#box2:hover{
		background-color: #666666;
		color: #993300;
		margin-left: 20px;
		float: left;
		font-size: 25px;
	}
	 @keyframes FontTurn{
                0%{transform: rotateY(0deg);}
                100%{transform: rotateY(360deg);}
        }
	.font{
		top:100px;
	    font-size: 3em;
	    text-align: center;
	    margin-top: calc(50vh - 43px);
	    position: absolute;
	    margin-top: 20px;
	    width: 100%;
	    z-index: 1000;
	    animation: FontTurn 1s linear infinite;
	    animation-iteration-count:1;
	    color: #fff;
	}
	.copyright{
		text-align: center;
		font-size: 20px;
		margin:0 auto;
		margin-top: 80px;
	}
	#bg{
		position: fixed;
		width: 100%;
		height: 100%;
		background-repeat: no-repeat;
		z-index: -100;
	}
	#main_body{
		position: relative;
		width: 40%;
		height: 100%;
		float: right;
		background: rgba(153, 255, 204, 0.8);
		filter: url(blur.svg#blur);
	}
	#content{
		width: 40%;
		height: 100%;
		float: left;
		z-index: 100;
	}
</style>
</head>
<body>
	<img src="images/bg.jpg" id="bg">
		<div id="main_body">
		<div class="font">欢 迎 来 到 北 风 论 坛</div>
			<!-- 判断游客角色 -->
			<div id="main">
					<form action="index_.php" method="post" accept-charset="utf-8">
						<div id="box1"><input type="submit" name="role" value="admin" checked class="list" style="background: rgba(102,255,255,0.85);"></div>

						<div id="box2"><input type="submit" name="role" value="user" checked class="list" style="background: rgba(102,255,255,0.85);"></div>
					</form>
			</div>
			<div class="copyright"> Copyright © 2017 BeiFengTZ</div>
	</div>
</body>
</html>