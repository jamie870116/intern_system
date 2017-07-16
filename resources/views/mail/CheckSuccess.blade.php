<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>審核結果通知信</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/CheckResult.css">
</head>

<body>
    <div class="container">
        <div class="wrapper">
<!--         	<i class="fa fa-check-square-o success" aria-hidden="true"></i>結果通過為success類別
        	<i class="fa fa-times-circle-o failed" aria-hidden="true"></i>結果不通過為failed類別 -->
            <h2><i class="fa fa-check-square-o success" aria-hidden="true"></i></h2>
            <h2>審核通過</h2>
            <h3>您的職缺編號為 :</h3>
            <h2>{{$contents}}</h2>
        </div>
    </div>
    <script src="https://use.fontawesome.com/47c3283935.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>

</html>
