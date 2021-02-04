
<!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    <title>會員驗證信</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="wrapper" style="">
        <h3><i class="fa fa-handshake-o" aria-hidden="true"></i></h3>
        <h3 style="font-weight:bold;">{{$userName}}您好</h3>
        <h3 style="font-weight:bold;">感謝您的註冊</h3>
        <h3 style="font-weight:bold;">歡迎加入IM Internship System實習管理系統</h3>
        <h3 style="font-weight:bold;">請確認帳號是否正確</h3>
        <h3 style="font-weight:bold;">您的帳號為:{{$account}}</h3>
        <h3 style="font-weight:bold;">請點擊下方連結完成驗證程序以啟用您的帳號</h3>
        <h3><a href='http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/#Page=VerificationSuccess&checkcode={{$code}}'>http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/#Page=VerificationSuccess&checkcode={{$code}}</a></h3>
        <h4 style="color:#888;">請勿直接回覆此郵件，台中科技大學資訊管理系敬上</h4>
    </div>
</div>

</body>

</html>

