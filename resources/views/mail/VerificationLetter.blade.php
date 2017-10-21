{{--<!DOCTYPE html>--}}
{{--<html>--}}

{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<title>會員驗證信</title>--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="css/VerificationLetter.css">--}}
{{--</head>--}}

{{--<body>--}}
    {{--<div class="container">--}}
        {{--<div class="wrapper">--}}
        {{--<h2><i class="fa fa-handshake-o" aria-hidden="true"></i></h2>--}}
        {{--<h2 style="font-weight:bold;">感謝您的註冊</h2>--}}
        {{--<h2>請點擊下方連結進行驗證</h2>--}}
        {{--<h3><a href="http://tsaiweb.southeastasia.cloudapp.azure.com/jamie/public/api//check_code?code={{$code}}">http://tsaiweb.southeastasia.cloudapp.azure.com/jamie/public/api//check_code?code={{$code}}</a></h3>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<script src="https://use.fontawesome.com/47c3283935.js"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>--}}
{{--</body>--}}

{{--</html>--}}
!DOCTYPE html>
<html >

<head>
    <meta charset="UTF-8">
    <title>會員驗證信</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
    * {
        font-family: Arial, Microsoft Jhenghei;
        margin: 0px;
        padding: 0px;
    }
    html{
        font-size: 18px;
    }
    ::selection {
        background: #000;
        color: #fff;
    }
    body{
        background-image: url(../images/homebg.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: center center;
    }
    a {
        color:#3085d6;
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
        color: #aaa;
    }

    .wrapper {
        width: 500px;
        margin: 250px auto 0px auto;
        padding: 50px;
        text-align: center;
        border: 2px solid #ccc;
        box-shadow: 3px 3px 3px #999;
        word-break: break-all;
        background-color:#fff;
    }
    .wrapper i{
        color:#337ab7;
        font-size:5rem;
    }
    @media screen and (max-width: 750px){
        .wrapper {
            width:400px;
            padding: 40px;
        }
    }
    @media screen and (max-width: 550px){
        .wrapper {
            width:300px;
        }
    }
    @media screen and (max-width: 450px){
        .wrapper {
            width:270px;
            padding: 20px;

        }
    }
</style>
<body>
<div class="container">
    <div class="wrapper">
        <h2><i class="fa fa-handshake-o" aria-hidden="true"></i></h2>
        <h2 style="font-weight:bold;">感謝您的註冊</h2>
        <h2>請點擊下方連結進行驗證</h2>
        <h3><a href="http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/#Page=Login?code={{$code}}">http://tsaiweb.southeastasia.cloudapp.azure.com/aa9453aa/#Page=Login?code={{$code}}</a></h3>
    </div>
</div>

</body>

</html>

