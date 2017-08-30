<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>會員驗證信</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/VerificationLetter.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
        <h2><i class="fa fa-handshake-o" aria-hidden="true"></i></h2>
        <h2 style="font-weight:bold;">感謝您的註冊</h2>
        <h2>請點擊下方連結進行驗證</h2>
        <h3><a href="http://tsaiweb.southeastasia.cloudapp.azure.com/jamie/public/api//check_code?code={{$code}}">http://tsaiweb.southeastasia.cloudapp.azure.com/jamie/public/api//check_code?code={{$code}}</a></h3>
        </div>
    </div>
    <script src="https://use.fontawesome.com/47c3283935.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
