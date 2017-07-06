<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
Route::post('Login','AuthController@postLogin');//登入
Route::post('Register','AuthController@register');//註冊
Route::get('Check_code','AuthController@check_code');//驗證信
Route::group(['middleware'=>'jwt'],function(){
	//取得使用者資料
	Route::post('findUserDetailsByToken','Stu_resumeController@findUserDetailsByToken');
	//履歷新增相關
	Route::post('createEduDataById/{id}','Stu_resumeController@createEduDataById');
	Route::post('createJobExperienceById/{id}','Stu_resumeController@createJobExperienceById');
	Route::post('createLicenseById/{id}','Stu_resumeController@createLicenseById');
	Route::post('createWorksDataById/{id}','Stu_resumeController@createWorksDataById');
	Route::post('createRelativeDataById/{id}','Stu_resumeController@createRelativeDataById');
	//修改履歷相關
	Route::post('editBasicDataById/{id}','Stu_resumeController@editBasicDataById');
	Route::post('editEduDataById/{edu_id}','Stu_resumeController@editEduDataById');
	Route::post('editJobExperienceById/{jid}','Stu_resumeController@editJobExperienceById');
	Route::post('editLicenseById/{lid}','Stu_resumeController@editLicenseById');
	Route::post('editWorksDataById/{wid}','Stu_resumeController@editWorksDataById');
	Route::post('editLanguageById/{id}','Stu_resumeController@editLanguageById');
	Route::post('editAbilityById/{id}','Stu_resumeController@editAbilityById');
	Route::post('editRelativeDataById/{rid}','Stu_resumeController@editRelativeDataById');
	//取得履歷資料
	Route::get('findResumeDataById/{id}','Stu_resumeController@findResumeDataById');

});
Route::get('Logout','AuthController@getLogout');//登出