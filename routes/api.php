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
	Route::get('findUserDetailsByToken','AuthController@findUserDetailsByToken');

	//職缺相關
    Route::post('createJobOpening','Job_openingController@createJobOpening');//新增職缺
    Route::put('editJobOpening','Job_openingController@editJobOpening');//修改職缺
    Route::put('deleteJobOpening','Job_openingController@deleteJobOpening');//新增職缺
    Route::put('reviewJobOpening','Job_openingController@reviewJobOpening');//審核
    Route::get('getJobOpeningbyAccount','Stu_resumeController@getJobOpeningbyAccount');//廠商帳號取得該廠商所有職缺資料
    Route::get('getJobOpeningbyId','Stu_resumeController@getJobOpeningbyId');//廠商帳號取得該廠商所有職缺資料


    //履歷新增相關
    Route::post('createEduDataById/{id}', 'Stu_resumeController@createEduDataById');
    Route::post('createJobExperienceById/{id}', 'Stu_resumeController@createJobExperienceById');
    Route::post('createLicenseById/{id}', 'Stu_resumeController@createLicenseById');
    Route::post('createWorksDataById/{id}', 'Stu_resumeController@createWorksDataById');
    Route::post('createRelativeDataById/{id}', 'Stu_resumeController@createRelativeDataById');
    //修改履歷相關
    Route::put('editBasicDataById/{id}', 'Stu_resumeController@editBasicDataById');
    Route::put('editEduDataById/{edu_id}', 'Stu_resumeController@editEduDataById');
    Route::put('editJobExperienceById/{jid}', 'Stu_resumeController@editJobExperienceById');
    Route::put('editLicenseById/{lid}', 'Stu_resumeController@editLicenseById');
    Route::put('editWorksDataById/{wid}', 'Stu_resumeController@editWorksDataById');
    Route::put('editLanguageById/{id}', 'Stu_resumeController@editLanguageById');
    Route::put('editAbilityById/{id}', 'Stu_resumeController@editAbilityById');
    Route::put('editRelativeDataById/{rid}', 'Stu_resumeController@editRelativeDataById');
    //取得履歷資料
    Route::get('findResumeDataById/{id}', 'Stu_resumeController@findResumeDataById');
});

Route::group(['middleware'=>'jwt','student'],function() {

});
Route::post('Logout','AuthController@getLogout');//登出