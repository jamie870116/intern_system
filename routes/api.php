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
    Route::get('getJobOpeningBySearch', 'Job_openingController@getJobOpeningBySearch');//職缺條件排序

    //廠商基本資料相關
    Route::put('editCompanyDetails', 'Com_basicController@editCompanyDetails');//修改廠商資料
//    Route::post('adminDeleteCompany', 'Com_basicController@adminDeleteCompany');//系辦刪除廠商
    Route::get('getCompanyDetailsByAccount', 'Com_basicController@getCompanyDetailsByAccount');//依帳號查詢廠商資料

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

    //履歷新增相關
    Route::post('createJobExperienceById', 'Stu_resumeController@createJobExperienceById');
    Route::post('createWorksDataById', 'Stu_resumeController@createWorksDataById');
    Route::post('createAbilityById', 'Stu_resumeController@createAbilityById');

    //修改履歷相關
    Route::post('editBasicDataById', 'Stu_resumeController@editBasicDataById');
    Route::put('editJobExperienceById', 'Stu_resumeController@editJobExperienceById');
    Route::put('editWorksDataById', 'Stu_resumeController@editWorksDataById');
    Route::put('editAbilityById', 'Stu_resumeController@editAbilityById');

    //取得履歷資料
    Route::get('findResumeDataById', 'Stu_resumeController@findResumeDataById');
    //下載證照範例檔
    Route::get('downloadLicenseFile','Stu_resumeController@downloadLicenseFile');

    //課程相關
    Route::post('adminCreateCourse', 'CourseController@adminCreateCourse');
    Route::put('adminEditCourseByCourseID', 'CourseController@adminEditCourseByCourseID');
    Route::post('adminDeleteCourse', 'CourseController@adminDeleteCourse');
    Route::get('adminGetSuccessMatch', 'CourseController@adminGetSuccessMatch'); //系辦取得已成功的媒合資料
    Route::get('adminGetTeacherData', 'CourseController@adminGetTeacherData'); //系辦取得所有老師資訊
    Route::get('adminGetCourse', 'CourseController@adminGetCourse'); //系辦取得課程資料
    Route::post('adminAddStudentToCourse', 'CourseController@adminAddStudentToCourse'); //系辦將學生加入課程並給予實習老師
    Route::get('adminGetStudentByCourseId', 'CourseController@adminGetStudentByCourseId'); //取得某課程中的學生
    Route::post('adminDeleteStudentFromCourse', 'CourseController@adminDeleteStudentFromCourse'); //系辦將學生從課程中刪除

    //週誌相關
    Route::get('studentGetInternList','JournalController@studentGetInternList');  //該學生實習列表
    Route::get('studentGetJournalList','JournalController@studentGetJournalList');//該學生週誌列表
    Route::get('defaultJournalBeforeInput','JournalController@defaultJournalBeforeInput');//在學生輸入週誌之前的顯示
    Route::put('studentEditJournal','JournalController@studentEditJournal');//學生輸入週誌內容

    //週誌成績管理相關
    Route::get('teacherGetStudentList','GradeController@teacherGetStudentList');//老師取得學生列表
    Route::get('teacherGetStudentCourseList','GradeController@teacherGetStudentCourseList');//老師取得特定學生之課程列表
    Route::get('teacherGetStudentJournalList','GradeController@teacherGetStudentJournalList');//老師取得特定學生的某一課程之週誌列表
    Route::post('teacherScoreStudentJournal','GradeController@teacherScoreStudentJournal');//老師批改學生週誌
    Route::get('companyGetStudentListByJoId','GradeController@companyGetStudentListByJoId');//廠商取得學生列表透過joid
    Route::get('companyGetStudentJournalListBySCid','GradeController@companyGetStudentJournalListBySCid');//廠商取得特定學生的某一課程之週誌列表
    Route::post('companyScoreStudentJournal','GradeController@companyScoreStudentJournal');//廠商批改學生週誌
    Route::get('getStudentJournalDetailByJournalID','GradeController@getStudentJournalDetailByJournalID');//取得特定週誌

    //週誌心得管理
    Route::post('createReview','ReviewsController@createReview');//新增實習心得
    Route::put('editReview','ReviewsController@editReview');//修改實習心得
    Route::get('getReviewByReId','ReviewsController@getReviewByReId');//顯示實習心得ByReId
    Route::get('getReviewBySCid','ReviewsController@getReviewBySCid');//顯示實習心得BySCid

    //站內信相關
    Route::get('getMailTitleBySid', 'MailController@getMailTitleBySid');//取得學生信件
    Route::get('getMailTitleByC_account', 'MailController@getMailTitleByC_account');//取得企業信件
    Route::get('getMailDetails', 'MailController@getMailDetails');//已讀信件
    Route::post('mailDeleted', 'MailController@mailDeleted');//刪除信件
    Route::post('favouriteMail', 'MailController@favouriteMail');//加到最愛信件

});
