<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="https://use.fontawesome.com/47c3283935.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
	<script src="../public/js/Login.js"></script>
</head>
<body>
	<div class="container">
		<div class="sidebar">
			<nav class="menu">
				<ul>
					<li class="item"><a href="#announcement">訊息公告</a></li>
					<li class="item"><a href="#cooperation">合作廠商</a></li>
					<li class="item"><a href="#job">目前職缺</a></li>
					<li class="item"><a href="#download">表單下載</a></li>
					<li class="item"><a href="#contact">關於我們</a></li>
				</ul>
				<hr/>
				<ul>
					<li class="function"><a href="#top" class="top"><i class="fa fa-arrow-up" aria-hidden="true"></i> BACK TO TOP</a></li>
					<li class="function"><a href="#join"><i class="fa fa-user" aria-hidden="true"></i> JOIN US</a></li>
				</ul>
			</nav>
		</div>
		<div class="hamburger">MENU</div>
		<div class="wrapper">
			<div class="form" id='Login'>
				<span class="log">L</span><span class="in">OG IN</span>
				<div class="col" data-toggle="tooltip" data-placement="right" title="請輸入學號或學校信箱">
					<input type="text" required id='account' name='account'  >
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>帳 號</label>
				</div>

				<div class="col" >
					<input type="text" required id='password' name='password' >
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>密 碼</label>
				</div>
				<div class="col">
					<img src="https://api.fnkr.net/testimg/300x60/888888/FFF/?text=8888">
				</div>
				<div class="col">      
					<input type="text" required>
					<span class="highlight"></span>
					<span class="bar"></span>
					<label>驗證碼</label>
				</div>
				<div class="col">
					<a href="password.html">忘記密碼?</a>
				</div>
				<div class="col">
					<button type="submit" id='Login_Bt'>登入</button>
					<a href="http://his.nutc.edu.tw/s1110234015/intern_system/public/register"><button type="submit">去註冊</button></a>
				</div>
			</div>
			<div class="footer">
				Copyright &copy; 2017
			</div>
		</div>
	</div>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		})
	</script>
</body>
</html>