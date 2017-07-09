
$('#Login').click(function(){
	var account=$("#account").val(), passwd=$("#password").val(), code=$("#code").val();
	if( code=='' || email=='' || passwd=='' ){
		swal({
			title: 'Error!',
			text: '所有欄位都要填寫才能登入喔!',
			type: 'error',
			confirmButtonText: '確定'
		})
		return false;
	}
});
$('#SRegister').click(function(){
	var account=$("#Saccount").val(),
	passwd=$("#Spassword").val(),
	Sconf_pass=$("#Sconf_pass").val(),
	Su_name=$("#Su_name").val(),
	Su_te=$("#Su_tel").val(),
	Su_status=$("#Su_status").val();
	if( account=='' || passwd=='' || conf_pass==''|| Su_name==''|| Su_te==''|| Su_status=='' ){
		swal({
			title: 'Error!',
			text: '所有欄位都要填寫才能完成註冊喔!',
			type: 'error',
			confirmButtonText: '確定'
		})
		return false;
	}
});
$('#ERegister').click(function(){
	var account=$("#Eaccount").val(),
	passwd=$("#Epassword").val(),
	Econf_pass=$("#Econf_pass").val(),
	Eu_name=$("#Eu_name").val(),
	Eu_te=$("#Eu_tel").val(),
	Eemail=$("#Eemail").val();
	if( account=='' || passwd=='' || Econf_pass==''|| Eu_name==''|| Eu_te==''|| Eemail=='' ){
		swal({
			title: 'Error!',
			text: '所有欄位都要填寫才能完成註冊喔!',
			type: 'error',
			confirmButtonText: '確定'
		})
		return false;
	}
});
$('.AddEdu').click(function(){
	$('.EduInput').after('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="date" name="" ></td>'+
		'<td><input type="date" name="" ></td>'+
		'<td>'+
		'<select>'+
		'<option value="0"> 畢業</option>'+
		'<option value="1"> 肄業</option>'+
		'<option value="2"> 在學中</option>'+
		'</select>'+
		'</td>'+
		'</tr>');
});
$('.AddJob').click(function(){
	$('.JobInput').after('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'</tr>');
});
$('.AddLic').click(function(){
	$('.LicInput').after('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="date" name=""></td>'+
		'</tr>');
});
$('.AddWork').click(function(){
	$('.WorkInput').after('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="text" name=""></td>'+
		'</tr>');
});
$('.AddRel').click(function(){
	$('.RelInput').after('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="text" name=""></td>'+
		'<td>'+
		'<select>'+
		'<option value="0">國小</option>'+
		'<option value="1">國中</option>'+
		'<option value="2">高中</option>'+
		'<option value="3">大專院校</option>'+
		'<option value="4">學士</option>'+
		'<option value="5">碩士</option>'+
		'<option value="6">博士</option>'+
		'<option value="7">其他</option>'+
		'</select>'+
		'</td>'+
		'<td><input type="text" name="" required></td>'+
		'</tr>');
});