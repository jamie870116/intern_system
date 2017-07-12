$(document).ready(function() {
    $('#Login_Bt').click(Login);
    $("#Login").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            Login();
        }
    });
});

//登入
function Login() {
    var url = "/s1110234015/intern_system/public/api/Login?" + $('#Login').find('input').serialize();
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        statusCode: {
            200: function(res) {
                $('#account').val("");
                $('#password').val("");
                //取得使用者資料
                //跳轉首頁
               findUserDetailsByToken(res)
            },
            400: function(resStr) {
                console.log("bb");
                $('#snackbar').empty();
                $('#snackbar').append();
                $('#snackbar').addClass('show');
                setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
                $('#Login_Password').val("");
                $('#Login_CaptchaCode').val("");
            }
        }

    });
}

//取得使用者資料
var identity;
function findUserDetailsByToken(token) {
    var url = "/s1110234015/intern_system/public/api/findUserDetailsByToken";
    $.ajax({
        type: "GET",
        url: url,
        headers: {
            "Authorization": "Bearer "+token
        },
        dataType: "json",
        statusCode: {
            200: function(res) {
                identity=res;
            },
            400: function(resStr) {
                console.log("bb");
                $('#snackbar').empty();
                $('#snackbar').append();
                $('#snackbar').addClass('show');
                setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
                $('#Login_Password').val("");
                $('#Login_CaptchaCode').val("");
            }
        }

    });
}
