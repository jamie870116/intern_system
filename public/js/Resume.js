$(document).ready(function() {
	
});

//新增學歷資料
function createEduDataById() {
	var headerData='';
    var createEduData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/createEduDataById",
        data: createEduData,
        dataType: "json",
        async: false,
        200: function(resStr) {

        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//新增工作經歷
function createJobExperienceById() {
	var headerData='';
    var createJobData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/createJobExperienceById",
        data: createJobData,
        dataType: "json",
        async: false,
        200: function(resStr) {

        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//新增證照
function createLicenseById() {
	var headerData='';
    var createLicenseData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/createLicenseById",
        data: createLicenseData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//新增專題及參賽作品
function createWorksDataById() {
	var headerData='';
    var createWorksData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/createWorksDataById",
        data: createWorksData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//新增親屬關係
function createRelativeDataById() {
	var headerData='';
    var createRelativeData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/createRelativeDataById",
        data: createRelativeData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改基本資料
function editBasicDataById() {
	var headerData='';
    var editBasicData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editBasicDataById",
        data: editBasicData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改學歷資料
function editEduDataById() {
	var headerData='';
    var editEduData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editEduDataById",
        data: editEduData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改工作經歷
function editJobExperienceById() {
	var headerData='';
    var editJobData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editJobExperienceById",
        data: editJobData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改證照資料
function editLicenseById() {
	var headerData='';
    var editLicenseData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editLicenseById",
        data: editLicenseData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}


//修改語文能力資料
function editLanguageById() {
	var headerData='';
    var editLanguageData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editLanguageById",
        data: editLanguageData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改電腦語言及技術資料
function editAbilityById() {
	var headerData='';
    var editAbilityData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editAbilityById",
        data: editAbilityData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改專題及參賽作品資料
function editWorksDataById() {
	var headerData='';
    var editWorksData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editWorksDataById",
        data: editWorksData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}

//修改親屬關係資料
function editRelativeDataById() {
	var headerData='';
    var editRelativeData = $('').find('.data').serialize();
    $.ajax({
        type: "POST",
        headers:{
        	"":headerData
        }
        url: "/s1110234015/intern_system/public/api/editRelativeDataById",
        data: editRelativeData,
        dataType: "json",
        async: false,
        200: function(resStr) {
        	
        },
        400: function(resStr) {
            // $('#snackbar').empty();
            // $('#snackbar').append(resStr.responseText);
            // $('#snackbar').addClass('show');
            // setTimeout(function() { $('#snackbar').removeClass('show'); }, 3000);
            // $('#Register_Password').val("");
            // $('#Register_PasswordCheck').val("");
        }
    });
}