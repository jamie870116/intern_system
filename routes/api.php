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
Route::post('resetPassword', 'AuthController@resetPassword');//忘記密碼後，重設密碼

Route::get('getAnnouncement','AnnouncementController@getAnnouncement');//取得公告
Route::get('getAnnouncementByKeywords','AnnouncementController@getAnnouncementByKeywords');//關鍵字搜尋公告
Route::get('getCompanyList', 'Com_basicController@getCompanyList');//取得所有廠商列表
Route::get('downloadAnnouncementFileByFileName','AnnouncementController@downloadAnnouncementFileByFileName');//下載公告附檔
//以上是不需登入即可使用之api


Route::group(['middleware' => 'jwt'], function () {

    //取得使用者資料
    Route::get('findUserDetailsByToken', 'AuthController@findUserDetailsByToken');
    //使用者自主重設密碼
    Route::put('userResetPassword', 'AuthController@userResetPassword');

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
    Route::get('getCompanyDetailsByAccount', 'Com_basicController@getCompanyDetailsByAccount');//依帳號查詢廠商介紹

    //媒合相關-學生與廠商
    Route::post('studentSubmitResume', 'MatchController@studentSubmitResume');//投遞履歷resume
    Route::get('companyGetResumeByAccount', 'MatchController@companyGetResumeByAccount');//廠商取得投遞的履歷
    Route::put('companyRejectResume', 'MatchController@companyRejectResume');//廠商回應履歷-拒絕
    Route::put('companyAcceptResume', 'MatchController@companyAcceptResume');// //廠商回應履歷-接受
    Route::get('companyGetJobOpeningContactByMid', 'MatchController@companyGetJobOpeningContactByMid');//取得廠商聯絡資訊，用在廠商輸入面試通知時
    Route::post('companySendInterviewNotice', 'MatchController@companySendInterviewNotice'); //廠商填寫面試通知並寄出
    Route::post('studentAcceptInterview', 'MatchController@studentAcceptInterview'); //學生是否接受面試
    Route::post('companyFailedInterview', 'MatchController@companyFailedInterview'); //廠商回應-面試失敗
    Route::post('companyPassInterview', 'MatchController@companyPassInterview'); //廠商回應-面試成功
    Route::post('companyResponseInterview', 'MatchController@companyResponseInterview'); //廠商回應面試(上面兩個API合而為一)
    Route::post('studentAcceptJob', 'MatchController@studentAcceptJob'); //學生是否接受入職

    //履歷新增相關
    Route::post('createJobExperienceById', 'Stu_resumeController@createJobExperienceById');
    Route::post('createWorksDataById', 'Stu_resumeController@createWorksDataById');
    Route::post('createAbilityById', 'Stu_resumeController@createAbilityById');

    //修改、刪除履歷相關
    Route::post('editBasicDataById', 'Stu_resumeController@editBasicDataById');
    Route::post('studentUploadProfilePic', 'Stu_resumeController@studentUploadProfilePic');//學生上傳頭貼
    Route::delete('deleteJobExperienceById', 'Stu_resumeController@deleteJobExperienceById');
    Route::delete('deleteWorksDataById', 'Stu_resumeController@deleteWorksDataById');
    Route::delete('deleteAbilityById', 'Stu_resumeController@deleteAbilityById');

    //取得履歷資料
    Route::get('findResumeDataById', 'Stu_resumeController@findResumeDataById');//學生取自己的
    Route::get('getResumeDataBySid', 'Stu_resumeController@getResumeDataBySid');//其他人取


    //下載證照範例檔
    Route::get('downloadLicenseFile','Stu_resumeController@downloadLicenseFile');

    //課程相關-系辦
    Route::post('adminCreateCourse', 'CourseController@adminCreateCourse');//系辦新增課程
    Route::put('adminEditCourseByCourseID', 'CourseController@adminEditCourseByCourseID');//系辦修改課程內容
    Route::delete('adminDeleteCourse', 'CourseController@adminDeleteCourse');//系辦刪除課程
    Route::get('adminGetSuccessMatch', 'CourseController@adminGetSuccessMatch'); //系辦取得全部已成功的媒合資料
    Route::get('adminGetSuccessMatchByStudent', 'CourseController@adminGetSuccessMatchByStudent'); //系辦以學生姓名或學號取得已成功的媒合資料
    Route::get('adminGetSuccessMatchByCourseId', 'CourseController@adminGetSuccessMatchByCourseId'); //系辦依照課程取得符合學制且已成功的媒合資料
    Route::get('adminGetTeacherData', 'CourseController@adminGetTeacherData'); //系辦取得所有老師資訊
    Route::get('adminGetAllCourse', 'CourseController@adminGetAllCourse'); //系辦取得全部課程資料
    Route::get('adminGetCourse', 'CourseController@adminGetCourse'); //系辦取得時限內課程資料
    Route::post('adminAddStudentToCourse', 'CourseController@adminAddStudentToCourse'); //系辦將學生加入課程並給予實習老師
    Route::get('adminGetStudentByCourseId', 'CourseController@adminGetStudentByCourseId'); //取得某課程中的學生
    Route::delete('adminDeleteStudentFromCourse', 'CourseController@adminDeleteStudentFromCourse'); //系辦將學生從課程中刪除

    //週誌相關-學生
    Route::get('studentGetInternList','JournalController@studentGetInternList');  //該學生實習列表
    Route::get('studentGetJournalList','JournalController@studentGetJournalList');//該學生週誌列表
    Route::get('getJournalDetailsBeforeInput','JournalController@getJournalDetailsBeforeInput');//在學生輸入週誌之前的顯示
    Route::put('studentEditJournal','JournalController@studentEditJournal');//學生輸入週誌內容
    Route::get('getJournalDetailsByJournalID','JournalController@getJournalDetailsByJournalID');//取得特定週誌

    //週誌成績管理相關-廠商與老師
    Route::get('getCourseList','GradeController@getCourseList');//取得該企業或老師底下的所有課程名稱和學生(系辦抓全部
    Route::get('teacherGetStudentJournalList','GradeController@teacherGetStudentJournalList');//老師取得特定學生的某一課程之週誌列表
    Route::post('teacherScoreStudentJournal','GradeController@teacherScoreStudentJournal');//老師批改學生週誌
    Route::post('companyScoreStudentJournal','GradeController@companyScoreStudentJournal');//廠商批改學生週誌
    Route::get('getStudentJournalDetailByJournalID','GradeController@getStudentJournalDetailByJournalID');//取得特定週誌
    Route::get('teacherGetNotExpiredStudentList','GradeController@teacherGetNotExpiredStudentList');//老師取得未過期學生列表
    Route::post('teacherUploadProfilePic','GradeController@teacherUploadProfilePic');//老師上傳頭貼
    Route::get('adminGetStudentJournalListBySCid','GradeController@adminGetStudentJournalListBySCid');//系辦取得特定學生的某一課程之週誌列表
    Route::get('teacherGetStudentList','GradeController@teacherGetStudentList');//老師取得學生列表
    Route::get('teacherGetStudentCourseList','GradeController@teacherGetStudentCourseList');//老師取得特定學生之課程列表
    Route::get('companyGetStudentListByJoId','GradeController@companyGetStudentListByJoId');//廠商取得學生列表透過joid
    Route::get('companyGetStudentJournalListBySCid','GradeController@companyGetStudentJournalListBySCid');//廠商取得特定學生的某一課程之週誌列表
    Route::get('getStuCourseGradeBySCid','GradeController@getStuCourseGradeBySCid');//取得該課程的成績

    //訪談紀錄-老師
    Route::post('teacherCreateComInterview','InterviewAnswerController@teacherCreateComInterview');//老師輸入對企業問卷
    Route::put('teacherEditComInterview','InterviewAnswerController@teacherEditComInterview');//老師修改對企業問卷
    Route::post('teacherCreateStuInterview','InterviewAnswerController@teacherCreateStuInterview');//老師輸入對學生問卷
    Route::put('teacherEditStuInterview','InterviewAnswerController@teacherEditStuInterview');//老師修改對學生問卷
    Route::get('getInternStudentList','InterviewAnswerController@getInternStudentList');//取得該老師所有指導生列表
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
    Route::get('teacherGetComAssessmentById','Assessment_TeachController@teacherGetComAssessmentById');//顯示廠商打的成績_老師

    //週誌心得管理-學生
    Route::post('createReview','ReviewsController@createReview');//新增實習心得
    Route::put('editReview','ReviewsController@editReview');//修改實習心得
    Route::get('getReviewByReId','ReviewsController@getReviewByReId');//顯示實習心得ByReId
    Route::get('getReviewBySCid','ReviewsController@getReviewBySCid');//顯示實習心得BySCid

    Route::get('teacherAccessReviewBySCid','ReviewsController@teacherAccessReviewBySCid');//老師查閱實習心得

    //訪談紀錄之問題管理-系辦
    Route::get('getInterviewsStuQuestions','InterviewQuestionsController@getInterviewsStuQuestions');//取得最新版本之學生訪談題目
    Route::get('getInterviewsStuQuestionsByVer','InterviewQuestionsController@getInterviewsStuQuestionsByVer');//取得某版本之學生訪談題目
    Route::get('getInterviewsComQuestions','InterviewQuestionsController@getInterviewsComQuestions');//取得最新版本之廠商訪談題目
    Route::get('getInterviewsComQuestionsByVer','InterviewQuestionsController@getInterviewsComQuestionsByVer');//取得某版本之廠商訪談題目
    Route::post('createNewStuQuestion','InterviewQuestionsController@createNewStuQuestion');//新增學生訪談題目
    Route::post('createNewComQuestion','InterviewQuestionsController@createNewComQuestion');//新增廠商訪談題目
    Route::put('editNewStuQuestion','InterviewQuestionsController@editNewStuQuestion');//修改學生訪談題目
    Route::put('editNewComQuestion','InterviewQuestionsController@editNewComQuestion');//修改企業訪談題目
    Route::delete('deleteComQuestion','InterviewQuestionsController@deleteComQuestion');//刪除企業訪談題目
    Route::delete('deleteStuQuestion','InterviewQuestionsController@deleteStuQuestion');//刪除學生訪談題目

    //站內信相關-學生與廠商
    Route::get('getMailDetails', 'MailController@getMailDetails');//已讀信件，即取得信件詳細資料
    Route::get('getMailByToken', 'MailController@getMailByToken');//取得信件(收件匣)
    Route::get('getSentMailByToken', 'MailController@getSentMailByToken');//取得送件匣
    Route::delete('mailDeleted', 'MailController@mailDeleted');//刪除信件
    Route::delete('sendMailDeleted', 'MailController@sendMailDeleted');//刪除寄件備份之信件-硬刪除
    Route::get('getTrashFolder', 'MailController@getTrashFolder');//取得回收信件
    Route::delete('mailForceDeleted', 'MailController@mailForceDeleted');//永久刪除信件
    Route::post('mailRestoreDeleted', 'MailController@mailRestoreDeleted');//回復刪除信件
    Route::post('sendMail', 'MailController@sendMail');//寄信-學生對廠商
    Route::post('replyMailById', 'MailController@replyMailById');//回覆信件
    Route::post('favouriteMail', 'MailController@favouriteMail');//加到最愛信件
    Route::get('getFavouriteFolder', 'MailController@getFavouriteFolder');//取得我的最愛

    //系辦帳號管理相關
    Route::get('getAllUserList','AccountController@getAllUserList');//取得所有使用者資料
    Route::get('searchAllUserByKeyword','AccountController@searchAllUserByKeyword');//搜尋使用者資料
    Route::get('getAllStudentList','AccountController@getAllStudentList');//取得所有學生資料
    Route::get('getAllTeacherList','AccountController@getAllTeacherList');//取得所有老師資料
    Route::get('getAllCompanyList','AccountController@getAllCompanyList');//取得所有廠商資料
    Route::get('searchAllCompanyByKeyword','AccountController@searchAllCompanyByKeyword');//搜尋廠商名稱(全部)
    Route::get('getReviewedCompanyList','AccountController@getReviewedCompanyList');//取得已審核廠商資料
    Route::get('searchReviewedCompanyByKeyword','AccountController@searchReviewedCompanyByKeyword');//搜尋廠商名稱(已審核)
    Route::get('getNoReviewedCompanyList','AccountController@getNoReviewedCompanyList');//取得已通過驗證未審核的廠商資料
    Route::get('searchNoReviewedCompanyByKeyword','AccountController@searchNoReviewedCompanyByKeyword');//搜尋廠商名稱(未審核)
    Route::get('adminGetStudentResumeById','AccountController@adminGetStudentResumeById');//取得某學生履歷
    Route::get('adminGetCompanyDetailsById','AccountController@adminGetCompanyDetailsById');//取得某廠商基本資料
    Route::get('getDisabledUsersList','AccountController@getDisabledUsersList');//取得停用中的帳號
    Route::post('adminReviewCompanyById','AccountController@adminReviewCompanyById');//系辦審核廠商
    Route::post('adminDisableUserById','AccountController@adminDisableUserById');//系辦停用帳號
    Route::post('adminReEnableUserById','AccountController@adminReEnableUserById');//系辦重新啟用用帳號

    //系辦追蹤
    //所有廠商中：廠商尚未處理履歷(1)、廠商已拒絕人數(2+8)、正在面試流程(3+4)、學生拒絕媒合(5+10)、
    //公司已錄取等待回復(6+7)、等待系辦加入課程(9)、已完成媒合等待實習開始(11)
    Route::get('adminGetAllMatchStatus','TrackController@adminGetAllMatchStatus');//取得所有使用者資料

    //特定廠商：廠商尚未處理履歷(1)、廠商已拒絕人數(2+8)、正在面試流程(3+4)、學生拒絕媒合(5+10)、
    //公司已錄取等待回復(6+7)、等待系辦加入課程(9)、已完成媒合等待實習開始(11)
    Route::get('adminGetMatchStatusByC_account','TrackController@adminGetMatchStatusByC_account');

    //公告
    Route::post('createAnnouncement','AnnouncementController@createAnnouncement');//新增公告
    Route::post('editAnnouncement','AnnouncementController@editAnnouncement');//修改公告
    Route::delete('deleteAnnouncement','AnnouncementController@deleteAnnouncement');//刪除公告

    //業師輔導成果
    Route::get('getCounselingResultBySCid','Counseling_resultController@getCounselingResultBySCid');//以SCid取得業師輔導成果表，如果沒填寫過則傳回帶預設值表單
    Route::post('createCounselingResultBySCid','Counseling_resultController@createCounselingResultBySCid');//以SCid新增業師輔導成果表
    Route::post('createCounselingResultPic','Counseling_resultController@createCounselingResultPic');//新增業師輔導成果表的圖片
    Route::put('editCounselingResultBySCid','Counseling_resultController@editCounselingResultBySCid');//以SCid編輯業師輔導成果表

    //實習計劃書相關
    Route::get('getInternProposalBySCid','Counseling_resultController@getInternProposalBySCid');//取得實習計畫書
    Route::post('createProposalBySCid','Counseling_resultController@createProposalBySCid');//新增實習計畫書
    Route::put('editProposalBySCid','Counseling_resultController@editProposalBySCid');//修改實習計畫書


});
