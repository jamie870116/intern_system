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
Route::post('forgetPassword', 'AuthController@forgetPassword');//忘記密碼
Route::post('resetPassword', 'AuthController@resetPassword');//重設密碼

Route::get('getAnnouncement','AnnouncementController@getAnnouncement');//修改公告
Route::get('getAnnouncementByKeywords','AnnouncementController@getAnnouncementByKeywords');//關鍵字搜尋公告
Route::get('getCompanyList', 'Com_basicController@getCompanyList');//取得所有廠商列表
Route::get('downloadAnnouncementFileByFileName','AnnouncementController@downloadAnnouncementFileByFileName');//下載公告附檔

Route::group(['middleware' => 'jwt'], function () {
    //取得使用者資料
    Route::get('findUserDetailsByToken', 'AuthController@findUserDetailsByToken');

    //職缺相關
    Route::post('createJobOpening', 'Job_openingController@createJobOpening');//新增職缺
    Route::put('editJobOpening', 'Job_openingController@editJobOpening');//修改職缺
    Route::delete('deleteJobOpeningByAdmin', 'Job_openingController@deleteJobOpeningByAdmin');//刪除職缺 系辦
    Route::delete('deleteJobOpeningByCom', 'Job_openingController@deleteJobOpeningByCom');//刪除職缺 廠商

    Route::get('getJobOpeningByToken', 'Job_openingController@getJobOpeningByToken');//取得自家所有職缺資料
    Route::get('getJobOpeningByAccount', 'Job_openingController@getJobOpeningByAccount');//取得該廠商所有職缺資料
    Route::get('getJobOpeningById', 'Job_openingController@getJobOpeningById');//取得某一職缺細項
    Route::get('getJobOpeningBySearch', 'Job_openingController@getJobOpeningBySearch');//職缺條件排序

    //廠商基本資料相關
    Route::get('getCompanyDetailsByToken', 'Com_basicController@getCompanyDetailsByToken');//取得廠商自己的簡介
    Route::post('editCompanyDetails', 'Com_basicController@editCompanyDetails');//修改廠商資料
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

    //修改、刪除履歷相關
    Route::post('editBasicDataById', 'Stu_resumeController@editBasicDataById');
    Route::delete('deleteJobExperienceById', 'Stu_resumeController@deleteJobExperienceById');
    Route::delete('deleteWorksDataById', 'Stu_resumeController@deleteWorksDataById');
    Route::delete('deleteAbilityById', 'Stu_resumeController@deleteAbilityById');

    //取得履歷資料
    Route::get('findResumeDataById', 'Stu_resumeController@findResumeDataById');
    //下載證照範例檔
    Route::get('downloadLicenseFile','Stu_resumeController@downloadLicenseFile');

    //課程相關
    Route::post('adminCreateCourse', 'CourseController@adminCreateCourse');
    Route::put('adminEditCourseByCourseID', 'CourseController@adminEditCourseByCourseID');
    Route::delete('adminDeleteCourse', 'CourseController@adminDeleteCourse');
    Route::get('adminGetSuccessMatch', 'CourseController@adminGetSuccessMatch'); //系辦取得已成功的媒合資料
    Route::get('adminGetSuccessMatchByStudent', 'CourseController@adminGetSuccessMatchByStudent'); //系辦以學生姓名或學號取得已成功的媒合資料
    Route::get('adminGetTeacherData', 'CourseController@adminGetTeacherData'); //系辦取得所有老師資訊
    Route::get('adminGetCourse', 'CourseController@adminGetCourse'); //系辦取得課程資料
    Route::post('adminAddStudentToCourse', 'CourseController@adminAddStudentToCourse'); //系辦將學生加入課程並給予實習老師
    Route::get('adminGetStudentByCourseId', 'CourseController@adminGetStudentByCourseId'); //取得某課程中的學生
    Route::delete('adminDeleteStudentFromCourse', 'CourseController@adminDeleteStudentFromCourse'); //系辦將學生從課程中刪除

    //週誌相關
    Route::get('studentGetInternList','JournalController@studentGetInternList');  //該學生實習列表
    Route::get('studentGetJournalList','JournalController@studentGetJournalList');//該學生週誌列表
    Route::get('getJournalDetailsBeforeInput','JournalController@getJournalDetailsBeforeInput');//在學生輸入週誌之前的顯示
    Route::put('studentEditJournal','JournalController@studentEditJournal');//學生輸入週誌內容

    //週誌成績管理相關
//    Route::get('teacherGetStudentList','GradeController@teacherGetStudentList');//老師取得學生列表
//    Route::get('teacherGetStudentCourseList','GradeController@teacherGetStudentCourseList');//老師取得特定學生之課程列表
    Route::get('getCourseList','GradeController@getCourseList');//取得該企業或老師底下的所有課程名稱和學生
    Route::get('teacherGetStudentJournalList','GradeController@teacherGetStudentJournalList');//老師取得特定學生的某一課程之週誌列表
    Route::post('teacherScoreStudentJournal','GradeController@teacherScoreStudentJournal');//老師批改學生週誌
//    Route::get('companyGetStudentListByJoId','GradeController@companyGetStudentListByJoId');//廠商取得學生列表透過joid
//    Route::get('companyGetStudentJournalListBySCid','GradeController@companyGetStudentJournalListBySCid');//廠商取得特定學生的某一課程之週誌列表
    Route::post('companyScoreStudentJournal','GradeController@companyScoreStudentJournal');//廠商批改學生週誌
    Route::get('getStudentJournalDetailByJournalID','GradeController@getStudentJournalDetailByJournalID');//取得特定週誌

    //訪談紀錄
    Route::post('teacherCreateComInterview','InterviewAnswerController@teacherCreateComInterview');//老師輸入對企業問卷
    Route::put('teacherEditComInterview','InterviewAnswerController@teacherEditComInterview');//老師修改對企業問卷
    Route::post('teacherCreateStuInterview','InterviewAnswerController@teacherCreateStuInterview');//老師輸入對學生問卷
    Route::put('teacherEditStuInterview','InterviewAnswerController@teacherEditStuInterview');//老師修改對學生問卷
//    Route::get('getInternStudentList','InterviewAnswerController@getInternStudentList');//取得該老師所有指導生列表
    Route::get('getNullComInterview','InterviewAnswerController@getNullComInterview');//取得填寫訪談紀錄前的預設資料(企業)
    Route::get('getNullStuInterview','InterviewAnswerController@getNullStuInterview');//取得填寫訪談紀錄前的預設資料(學生)
    Route::get('getInterviewBySCid','InterviewAnswerController@getInterviewBySCid');//取得填寫過的訪談紀錄

    //成果評量相關_廠商
//    Route::get('companyGetAssessmentList','Assessment_ComController@companyGetAssessmentList');//取得待輸入之學生成績列表
    Route::get('getAssessmentBeforeInput','Assessment_ComController@getAssessmentBeforeInput');//廠商在輸入成績前的預設資料
    Route::post('companyCreateAssessment','Assessment_ComController@companyCreateAssessment');//廠商輸入成績
    Route::put('companyEditAssessment','Assessment_ComController@companyEditAssessment');//廠商修改成績
    Route::get('getCompanyAssessmentById','Assessment_ComController@getCompanyAssessmentById');//取得廠商所輸入之成績

    //成果評量相關_老師
    Route::get('teacherGetAssessmentList','Assessment_TeachController@teacherGetAssessmentList');//老師取得可輸入成績之學生列表，當assessmentStatus=2
    Route::post('teacherCreateAssessment','Assessment_TeachController@teacherCreateAssessment');//老師輸入成績
    Route::put('teacherEditAssessment','Assessment_TeachController@teacherEditAssessment');//老師修改成績
    Route::get('getTeacherAssessmentById','Assessment_TeachController@getTeacherAssessmentById');//顯示老師所輸入之成績

    //週誌心得管理
    Route::post('createReview','ReviewsController@createReview');//新增實習心得
    Route::put('editReview','ReviewsController@editReview');//修改實習心得
    Route::get('getReviewByReId','ReviewsController@getReviewByReId');//顯示實習心得ByReId
    Route::get('getReviewBySCid','ReviewsController@getReviewBySCid');//顯示實習心得BySCid

    //訪談紀錄之問題管理
    Route::get('getInterviewsStuQuestions','InterviewQuestionsController@getInterviewsStuQuestions');//取得最新版本之學生訪談題目
    Route::get('getInterviewsStuQuestionsByVer','InterviewQuestionsController@getInterviewsStuQuestionsByVer');//取得某版本之學生訪談題目
    Route::get('getInterviewsComQuestions','InterviewQuestionsController@getInterviewsComQuestions');//取得最新版本之廠商訪談題目
    Route::get('getInterviewsComQuestionsByVer','InterviewQuestionsController@getInterviewsComQuestionsByVer');//取得某版本之廠商訪談題目
    Route::post('createNewStuQuestion','InterviewQuestionsController@createNewStuQuestion');//新增學生訪談題目
    Route::post('createNewComQuestion','InterviewQuestionsController@createNewComQuestion');//新增學生訪談題目
    Route::put('editNewStuQuestion','InterviewQuestionsController@editNewStuQuestion');//修改學生訪談題目
    Route::put('editNewComQuestion','InterviewQuestionsController@editNewComQuestion');//修改企業訪談題目


    //站內信相關
    Route::get('getMailDetails', 'MailController@getMailDetails');//已讀信件
    Route::get('getMailByToken', 'MailController@getMailByToken');//取得信件(收件)
    Route::get('getSentMailByToken', 'MailController@getSentMailByToken');//取得送件
    Route::get('getTrashFolder', 'MailController@getTrashFolder');//取得回收信件
    Route::delete('mailForceDeleted', 'MailController@mailForceDeleted');//永久刪除信件
    Route::post('mailRestoreDeleted', 'MailController@mailRestoreDeleted');//回復刪除信件
    Route::post('sendMail', 'MailController@sendMail');//寄信
    Route::post('replyMailById', 'MailController@replyMailById');//回覆信件
    Route::post('mailDeleted', 'MailController@mailDeleted');//刪除信件
    Route::post('favouriteMail', 'MailController@favouriteMail');//加到最愛信件


    //系辦帳號管理相關
    Route::get('getAllUserList','AccountController@getAllUserList');//取得所有使用者資料
    Route::get('getAllStudentList','AccountController@getAllStudentList');//取得所有學生資料
    Route::get('getAllTeacherList','AccountController@getAllTeacherList');//取得所有老師資料
    Route::get('getAllCompanyList','AccountController@getAllCompanyList');//取得所有廠商資料
    Route::get('getNoReviewedCompanyList','AccountController@getNoReviewedCompanyList');//取得已通過驗證未審核的廠商資料
    Route::get('adminGetStudentResumeById','AccountController@adminGetStudentResumeById');//取得某學生履歷
    Route::get('adminGetCompanyDetailsById','AccountController@adminGetCompanyDetailsById');//取得某廠商基本資料
    Route::get('getDisabledUsersList','AccountController@getDisabledUsersList');//取得停用中的帳號
    Route::post('adminReviewCompanyById','AccountController@adminReviewCompanyById');//系辦審核廠商
    Route::post('adminDisableUserById','AccountController@adminDisableUserById');//系辦停用帳號
    Route::post('adminReEnableUserById','AccountController@adminReEnableUserById');//系辦重新啟用用帳號

    //公告
    Route::post('createAnnouncement','AnnouncementController@createAnnouncement');//新增公告
    Route::post('editAnnouncement','AnnouncementController@editAnnouncement');//修改公告
    Route::delete('deleteAnnouncement','AnnouncementController@deleteAnnouncement');//刪除公告



});
