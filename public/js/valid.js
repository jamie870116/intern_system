
$('#LoginBtn').click(function(){
	var account=$("#account").val(), passwd=$("#password").val(), code=$("#code").val();
	if( code=='' || account=='' || passwd=='' ){
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
$('.AddAbi').click(function(){
	$('.AbiInput').before('<tr >'+
		'<td>'+
		'<select >'+
		'<option value="0">資料庫</option>'+
		'<option value="1">程式語言</option>'+
		'<option value="2">網頁設計</option>'+
		'<option value="3">文書處理</option>'+
		'<option value="4">影像剪輯</option>'+
		'<option value="5">繪圖軟體</option>'+
		'<option value="6">動畫製作</option>'+
		'<option value="7">作業系統</option>'+
		'<option value="8">音效剪輯</option>'+
		'</select>'+
		'</td>'+
		'<td><input type="text" name="" ></td>'+
		'<td><i class="fa fa-times closeBtn deltr" aria-hidden="true"></i></td></tr>');
});
$('.AddEdu').click(function(){
	$('.EduInput').before('<tr >'+
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
		'<td><i class="fa fa-times closeBtn" aria-hidden="true"></i></td></tr>');
});//<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
$('.AddJob').click(function(){
	$('.JobInput').before('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><i class="fa fa-times closeBtn deltr" aria-hidden="true"></i></td></tr>');
});

$('.AddLic').click(function(){
	$('.LicInput').before('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="date" name=""></td>'+
		'<td><i class="fa fa-times closeBtn deltr" aria-hidden="true"></i></td></tr>');
});
$('.AddWork').click(function(){
	$('.WorkInput').before('<tr >'+
		'<td><input type="text" name="" ></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><input type="text" name=""></td>'+
		'<td><i class="fa fa-times closeBtn deltr" aria-hidden="true"></i></td></tr>');
});
$('.AddRel').click(function(){
	$('.RelInput').before('<tr >'+
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
		'<td><i class="fa fa-times closeBtn deltr" aria-hidden="true"></i></td></tr>');
});
$(document).delegate('.deltr','click',function(){
	$(this).closest('tr').remove();
});