<!DOCTYPE>
<html>

<head>
    <meta charset="UTF-8">
    <title>重設密碼信</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <div class="wrapper" style="">
        <h3><i class="fa fa-handshake-o" aria-hidden="true"></i></h3>
        <h3 style="font-weight:bold;">{{$userName}}您好</h3>
        <h3 style="font-weight:bold;">由於忘記密碼，您於{{$time}}申請重新設定密碼</h3>
        <h3 style="font-weight:bold;">您的確認碼為:{{$token}}}</h3>
        <h3 style="font-weight:bold;">請點擊下方連結後輸入該確認碼以重新設定密碼</h3>
        <h3><a href="http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/" style="a{color:#337ab7;} a:hover{color:#0b5a9e;}">http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/</a></h3>
        <h4 style="color:#888;">台中科技大學資訊管理系敬上</h4>
    </div>
</div>

</body>

</html>