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
Route::post('Login', 'AuthController@postLogin');//登入
Route::post('Register', 'AuthController@register');//註冊
Route::post('Logout', 'AuthController@getLogout');//登出
Route::get('Check_code', 'AuthController@check_code');//驗證信

Route::group(['middleware' => 'jwt'], function () {
    //取得使用者資料
    Route::get('findUserDetailsByToken', 'AuthController@findUserDetailsByToken');

    //職缺相關
    Route::post('createJobOpening', 'Job_openingController@createJobOpening');//新增職缺
    Route::put('editJobOpening', 'Job_openingController@editJobOpening');//修改職缺
    Route::put('deleteJobOpeningByAdmin', 'Job_openingController@deleteJobOpeningByAdmin');//刪除職缺 系辦
    Route::put('deleteJobOpeningByCom', 'Job_openingController@deleteJobOpeningByCom');//刪除職缺 廠商

    Route::get('getJobOpeningbyAccount', 'Job_openingController@getJobOpeningbyAccount');//廠商帳號取得該廠商所有職缺資料
    Route::get('getJobOpeningbyId', 'Job_openingController@getJobOpeningbyId');//取得某一職缺細項
    Route::get('getJobOpeningAll', 'Job_openingController@getJobOpeningAll');//取得所有職缺(截止日期未到期的
    Route::get('getJobOpeningAll_ASC', 'Job_openingController@getJobOpeningAll_ASC');//取得所有職缺(截止日期未到期的 時間由舊到新
    Route::get('getJobOpeningBySearch', 'Job_openingController@getJobOpeningBySearch');//職缺條件排序-DESC
    Route::get('getJobOpeningBySearch_ASC', 'Job_openingController@getJobOpeningBySearch_ASC');//職缺條件排序-ASC

    //媒合相關
    Route::post('studentSubmitResume', 'MatchController@studentSubmitResume');//投遞履歷resume
    Route::get('companyGetResumeByAccount', 'MatchController@companyGetResumeByAccount');//廠商取得投遞的履歷
    Route::put('companyRejectResume', 'MatchController@companyRejectResume');//廠商回應履歷-拒絕
    Route::put('companyAcceptResume', 'MatchController@companyAcceptResume');// //廠商回應履歷-接受
    Route::get('companyGetJobOpeningContactByMid', 'MatchController@companyGetJobOpeningContactByMid');//取得廠商聯絡資訊
    Route::post('companySendInterviewNotice', 'MatchController@companySendInterviewNotice'); //面試通知
    Route::post('studentAcceptInterview', 'MatchController@studentAcceptInterview'); //學生是否接受面試
    Route::post('companyFailedInterview', 'MatchController@companyFailedInterview'); //面試失敗
    Route::post('companyPassInterview', 'MatchController@companyPassInterview'); //面試成功
    Route::post('studentAcceptJob', 'MatchController@studentAcceptJob'); //學生是否接受入職
    Route::get('adminGetSuccessMatch', 'MatchController@adminGetSuccessMatch'); //系辦取得已成功的媒合資料
    Route::get('adminGetTeacherData', 'MatchController@adminGetTeacherData'); //系辦取得所有老師資訊
    Route::post('adminFillInTeacher', 'MatchController@adminFillInTeacher'); //系辦選擇實習老師

    //履歷新增相關
    Route::post('createEduDataById', 'Stu_resumeController@createEduDataById');
    Route::post('createJobExperienceById', 'Stu_resumeController@createJobExperienceById');
    Route::post('createLicenseById', 'Stu_resumeController@createLicenseById');
    Route::post('createWorksDataById', 'Stu_resumeController@createWorksDataById');
    Route::post('createRelativeDataById', 'Stu_resumeController@createRelativeDataById');

    //修改履歷相關
    Route::put('editBasicDataById', 'Stu_resumeController@editBasicDataById');
    Route::put('editEduDataById', 'Stu_resumeController@editEduDataById');
    Route::put('editJobExperienceById', 'Stu_resumeController@editJobExperienceById');
    Route::put('editLicenseById', 'Stu_resumeController@editLicenseById');
    Route::put('editWorksDataById', 'Stu_resumeController@editWorksDataById');
    Route::put('editLanguageById', 'Stu_resumeController@editLanguageById');
    Route::put('editAbilityById', 'Stu_resumeController@editAbilityById');
    Route::put('editRelativeDataById/', 'Stu_resumeController@editRelativeDataById');

    //取得履歷資料
    Route::get('findResumeDataById', 'Stu_resumeController@findResumeDataById');

    //站內信相關
    Route::get('getMailTitleBySid', 'MailController@getMailTitleBySid');//取得學生信件
    Route::get('getMailTitleByC_account', 'MailController@getMailTitleByC_account');//取得企業信件
    Route::get('getMailDetails', 'MailController@getMailDetails');//已讀信件
    Route::post('mailDeleted', 'MailController@mailDeleted');//刪除信件
    Route::post('favouriteMail', 'MailController@favouriteMail');//加到最愛信件

});
