<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>註冊</title>
    <link rel="stylesheet" href="../public/Packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/Packages/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/Register.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="../public/jQuery/jquery.signalR-2.2.1.js"></script>
    <script src="../public/Packages/bootstrap/js/bootstrap.min.js"></script>
    <script>
    $('#myTabs a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
    </script>
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
                <div class="col-xs-12 col-sm-6 col-md-4 registerimg">
                    <!-- <img src="Images/Login.png" alt=""> -->
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <form action="" class="register text-center">
                        <i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i><span> 註冊</span>
                        <div role="tabpanel" class="tab">
                            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active" style="width:50%;text-align:center;"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">校內註冊</a></li>
                                <li role="presentation" style="width:50%;text-align:center;"><a href="#enterprise" aria-controls="enterprise" role="tab" data-toggle="tab">企業註冊</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane " id="student">
                                <div class="col">
                                	<label class="lb">身分別</label>
                                	<select name="" id="">
                                		<option value="0">老師</option>
                                		<option value="1">學生</option>
                                	</select>
                                </div>
                                    <div class="col">
                                        <label class="lb">Email</label>
                                        <input type="text" placeholder="請輸入學校信箱">
                                    </div>
                                    <div class="col">
                                        <label class="lb">密碼</label>
                                        <input type="text" placeholder="請輸入6到20字元">
                                    </div>
                                    <div class="col">
                                        <label class="lb">確認密碼</label>
                                        <input type="text" placeholder="請再次輸入密碼">
                                    </div>
                                    <div class="col">
                                        <label class="lb">姓名</label>
                                        <input type="text">
                                    </div>
                                    <div class="col">
                                        <label class="lb">電話</label>
                                        <input type="text">
                                    </div>
                                    <div class="col">
                                        <button>註冊</button>
                                        <button><a href="Login.html">去登入</a></button>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="enterprise">
                                    <div class="col">
                                        <label class="lb">帳號</label>
                                        <input type="text" placeholder="請輸入統一編號">
                                    </div>
                                    <div class="col">
                                        <label class="lb">密碼</label>
                                        <input type="text" placeholder="請輸入6到20字元">
                                    </div>
                                    <div class="col">
                                        <label class="lb">確認密碼</label>
                                        <input type="text" placeholder="請再次輸入密碼">
                                    </div>
                                    <div class="col">
                                        <label class="lb">公司名稱</label>
                                        <input type="text">
                                    </div>
                                    <div class="col">
                                        <label class="lb">公司電話</label>
                                        <input type="text">
                                    </div>
                                    <div class="col">
                                        <label class="lb">Email</label>
                                        <input type="text">
                                    </div>
                                    <div class="col">
                                        <button>註冊</button>
                                        <button><a href="http://his.nutc.edu.tw/s1110234015/intern_system/public/">去登入</a></button>
                                    </div>
                                </div>
                            </div>
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
