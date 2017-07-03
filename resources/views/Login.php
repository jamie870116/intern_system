<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登入</title>
    <link rel="stylesheet" href="../public/Packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/Packages/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/Login.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="../public/jQuery/jquery.signalR-2.2.1.js"></script>
    <script src="../public/Packages/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
        	<div class="col-xs-12 col-sm-12 col-md-12 header text-center">
        		<h3>實習平台</h3>
        	</div>
        </div>
        <div class="row">
            <div class="wrapper">
                <div class="col-xs-12 col-sm-12 col-md-2">
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 loginimg">
                    <!-- <img src="Images/Login.png" alt=""> -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <form action="" class="login text-center">
                        <i class="fa fa-home fa-2x" aria-hidden="true"></i><span> 登入</span>
                        <hr/>
                        <div class="col">
                            <label class="lb">帳號</label>
                            <input type="text">
                        </div>
                        <div class="col">
                            <label class="lb">密碼</label>
                            <input type="text">
                        </div>
                        <div class="col">
                            <img src="https://api.fnkr.net/testimg/90x40/888888/FFF/?text=8888">
                            <input type="text" placeholder="請輸入驗證碼">
                        </div>
                        <div class="row">
                            <!-- <div class="col-xs-6 col-sm-6 col-md-6 remember">
                                <input type="checkbox">
                                <label>記住我</label>
                            </div> -->
                            <div class="col-xs-6 col-sm-6 col-md-6 forget">
                                <a href="Password.html">忘記密碼?</a>
                            </div>
                        </div>
                        <div class="col">
                            <button>登入</button>
                            <button><a href="http://his.nutc.edu.tw/s1110234015/intern_system/public/register">去註冊</a></button>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-12 col-sm-12 col-md-12 footer text-center">
        		<p>2017 &copy; 實習平台</p>
        	</div>
        </div>
    </div>
</body>

</html>
