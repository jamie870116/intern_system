$(document).ready(function() {
    $('.Register_Bt').click(Register);
    $(document).delegate('#Pagestudent', 'click', function() {
        SEPage = 1;
        console.log(SEPage);
    });
    $(document).delegate('#Pageenterprise', 'click', function() {
        SEPage = 2;
        console.log(SEPage);
    });
    $("#Register").keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            Register();
        }
    });
});
var SEPage = 1;
//註冊
function Register() {
    var registerData = '';
    if (SEPage == 1) {
        registerData = $('#student').find('.data').serialize();
    } else if (SEPage == 2) {
        registerData = $('#enterprise').find('.data').serialize() + "&u_status=2";
    }
    console.log(SEPage);
    console.log(registerData);
    $.ajax({
        type: "POST",
        url: "/s1110234015/intern_system/public/api/Register",
        data: registerData,
        dataType: "json",
        async: false,
        success: function(resStr) {
            console.log("aaaa");
            console.log(resStr.responseText);
            if (SEPage == 1) {
                $('#Su_status option[value="-1"]').attr('selected', true);
                $('#Saccount').val("");
                $('#Spassword').val("");
                $('#Sconf_pass').val("");
                $('#Su_name').val("");
                $('#Su_tel').val("");
            } else if (SEPage == 2) {
                $('#Eaccount').val("");
                $('#Epassword').val("");
                $('#Econf_pass').val("");
                $('#Eu_name').val("");
                $('#Eu_tel').val("");
                $('#Eemail').val("");
            }
            // $('#snackbar').empty();
            // snackbar.append("<p>請前往驗證信箱進行帳號驗證，以開通帳號</p>");
            // snackbar.className = "show";
            // setTimeout(function() { snackbar.className = snackbar.className.replace("show", ""); }, 3000);
        },
        error: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}
