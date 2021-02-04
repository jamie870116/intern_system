<?php

namespace App\Http\Controllers;

use App\Assessment_Teach;
use App\Course;
use App\Journal;
use App\Services\GradeServices;

use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

use App\Stu_course;
use App\User as UserEloquent;
use Log;
use Validator;

class GradeController extends Controller
{
    protected $GradeServices;

    public function __construct(GradeServices $GradeServices)
    {
        $this->middleware('company', ['only' => 'companyGetStudentListByJoId', 'companyGetStudentJournalListBySCid', 'companyScoreStudentJournal']);
        $this->middleware('teacher', ['only' => 'teacherUploadProfilePic', 'teacherGetStudentList', 'teacherGetStudentCourseList', 'teacherGetStudentJournalList', 'teacherScoreStudentJournal', 'teacherGetNotExpiredStudentList']);
        $this->middleware('admin', ['only' => 'adminGetStudentJournalListBySCid']);
        $this->GradeServices = $GradeServices;
    }

    //老師上傳頭貼
    public function teacherUploadProfilePic(Request $request)
    {

        $objValidator = Validator::make($request->all(), array(
            'profilePic' => 'required|image',
        ), array(
            'image' => '圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)',
            'required' => '請上傳圖片',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $file = $request->file('profilePic');
            $responses = $this->GradeServices->teacherUploadProfilePic_ser($request, $file);
            if ($responses == '上傳頭貼成功') {
                $r = array($responses);
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                $r = array($responses);
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }


    }


    //取得該企業或老師底下的所有課程名稱和學生(系辦抓全部
    public function getCourseList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($user->u_status == 1) {
            $TeaCourse = Stu_course::where('tid', $user->id)->get();
            $courses = array();
            $co=array();
            foreach ($TeaCourse as $t) {
                $course = Stu_course::find($t->SCid)->courses()->distinct()->first();
                if(!in_array($course->courseId,$co)){
                    $co[]=$course->courseId;
                }
            }
            foreach ($co as $c){
                $course = Course::where('courseId',$c)->first();
                $course->courseStart = Carbon::parse($course->courseStart)->format('Y/m/d');
                $course->courseEnd = Carbon::parse($course->courseEnd)->format('Y/m/d');
                $now = Carbon::now();
                if ($now < $course->courseEnd) {
                    $course->passDeadLine = false;
                } else {
                    $course->passDeadLine = true;
                }

                $stu_c = Stu_course::where('courseId', $course->courseId)->where('tid', $user->id)->get();
                foreach ($stu_c as $s) {
                    $stu = Stu_course::find($s->SCid)->user_stu()->first();
                    if (Carbon::now() > $course->courseEnd && $s->assessmentStatus = 0) {
                        $s->assessmentStatus = 1;
                        $s->save();
                    }
                    $s->stuName = $stu->u_name;
                    $s->stuId = $stu->id;
                    $s->stuAccount = $stu->account;
                    $stu_b = Stu_course::find($s->SCid)->stu_basic()->first();
                    $s->profilePic = $stu_b->profilePic;
                }
                $course->studentList = $stu_c;
                $courses[] = $course;
            }
            return response()->json(['CourseList' => $courses], 200, [], JSON_UNESCAPED_UNICODE);
        } elseif ($user->u_status == 2) {
            $TeaCourse = Stu_course::where('c_account', $user->account)->get();
            $courses = array();
            $co=array();
            foreach ($TeaCourse as $t) {
                $course = Stu_course::find($t->SCid)->courses()->distinct()->first();
                if(!in_array($course->courseId,$co)){
                    $co[]=$course->courseId;
                }
            }

            foreach ($co as $c){
                $course = Course::where('courseId',$c)->first();
                $course->courseStart = Carbon::parse($course->courseStart)->format('Y/m/d');
                $course->courseEnd = Carbon::parse($course->courseEnd)->format('Y/m/d');
                $now = Carbon::now();
                if ($now < $course->courseEnd) {
                    $course->passDeadLine = false;
                } else {
                    $course->passDeadLine = true;
                }

                $stu_c = Stu_course::where('courseId', $course->courseId)->where('c_account', $user->account)->get();
                foreach ($stu_c as $s) {
                    $stu = Stu_course::find($s->SCid)->user_stu()->first();
                    if (Carbon::now() > $course->courseEnd && $s->assessmentStatus = 0) {
                        $s->assessmentStatus = 1;
                        $s->save();
                    }
                    $s->stuName = $stu->u_name;
                    $s->stuId = $stu->id;
                    $s->stuAccount = $stu->account;
                    $stu_b = Stu_course::find($s->SCid)->stu_basic()->first();
                    $s->profilePic = $stu_b->profilePic;
                }
                $course->studentList = $stu_c;
                $courses[] = $course;
            }
            return response()->json(['CourseList' => $courses], 200, [], JSON_UNESCAPED_UNICODE);
        } elseif ($user->u_status == 3) {
            $TeaCourse = Stu_course::all();
            $courses = array();
            $co=array();
            foreach ($TeaCourse as $t) {
                $course = Stu_course::find($t->SCid)->courses()->distinct()->first();
                if(!in_array($course->courseId,$co)){
                    $co[]=$course->courseId;
                }
            }
            foreach ($co as $c){
                $course = Course::where('courseId',$c)->first();
                $course->courseStart = Carbon::parse($course->courseStart)->format('Y/m/d');
                    $course->courseEnd = Carbon::parse($course->courseEnd)->format('Y/m/d');
                    $now = Carbon::now();
                    if ($now < $course->courseEnd) {
                        $course->passDeadLine = false;
                    } else {
                        $course->passDeadLine = true;
                    }

                    $stu_c = Stu_course::where('courseId', $course->courseId)->get();
                    foreach ($stu_c as $s) {
                        $stu = Stu_course::find($s->SCid)->user_stu()->first();
                        if (Carbon::now() > $course->courseEnd && $s->assessmentStatus = 0) {
                            $s->assessmentStatus = 1;
                            $s->save();
                        }
                        $s->stuName = $stu->u_name;
                        $s->stuId = $stu->id;
                        $s->stuAccount = $stu->account;
                        $stu_b = Stu_course::find($s->SCid)->stu_basic()->first();
                        $s->profilePic = $stu_b->profilePic;
                    }
                    $course->studentList = $stu_c;
                $courses[] = $course;
            }
            return response()->json(['CourseList' => $courses], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(array('非老師或企業'), 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //老師取得學生列表
    public function teacherGetStudentList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_course::where('tid', $user->id)->get();
        $student_list = array();
        foreach ($stu_course as $stu_cour) {
            $studentName = UserEloquent::where('id', $stu_cour->sid)->first();
            $list = array($studentName->u_name, $studentName->id);
            $student_list[] = $list;
        }
        return response()->json(['student_list' => $student_list], 200, [], JSON_UNESCAPED_UNICODE);
    }

    //老師取得未過期學生列表
    public function teacherGetNotExpiredStudentList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $TeaCourse = Stu_course::where('tid', $user->id)->get();
        $student_list = array();
        $stu_id = array();
        foreach ($TeaCourse as $t) {
            $course = Stu_course::find($t->SCid)->courses()->distinct()->first();
            $course->courseStart = Carbon::parse($course->courseStart)->format('Y/m/d');
            $course->courseEnd = Carbon::parse($course->courseEnd)->format('Y/m/d');
            $now = Carbon::now();
            if ($now < $course->courseEnd) {
                // $course->passDeadLine=false;
                $stu_c = Stu_course::where('courseId', $course->courseId)->where('tid', $user->id)->get();
                foreach ($stu_c as $s) {
                    if (!in_array($s->sid, $stu_id)) {
                        $stu_id[] = $s->sid;
                        $stu = Stu_course::find($s->SCid)->user_stu()->first();
                        $stu_b = Stu_course::find($s->SCid)->stu_basic()->first();
                        $stu->profilePic = $stu_b->profilePic;
                        $stu->SCid =$stu_c->SCid;
                        $student_list[] = $stu;
                    }
                }
            }
        }
        return response()->json(['student_list' => $student_list], 200, [], JSON_UNESCAPED_UNICODE);
    }

    //老師取得特定學生之課程列表
    public function teacherGetStudentCourseList(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'sid' => 'required|integer',
        ), array(
            'sid.required' => '請輸入學生ID',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->teacherGetStudentCourseList_ser($re);
            if ($responses != '取得學生課程列表失敗') {
                return response()->json(['studentCoursesList' => $responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //老師取得特定學生的某一課程之週誌列表
    public function teacherGetStudentJournalList(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入學生ID',
            'integer' => '請輸入整數',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->teacherGetStudentJournalList_ser($re);
            if ($responses != '取得週誌列表失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array('$responses'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //老師批改學生週誌
    public function teacherScoreStudentJournal(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'journalID' => 'required|integer',
            'journalComments_teacher' => 'required',
            'grade_teacher' => 'required|numeric|max:100|min:0',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'journalComments_teacher.required' => '請輸入週誌評語',
            'grade_teacher.required' => '請輸入週誌成績',
            'integer' => '請輸入整數',
            'numeric' => '請輸入數字',
            'max' => '請輸入最多100分',
            'min' => '請輸入最少0分',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->teacherScoreStudentJournal_ser($re);
            if ($responses == '批改週誌成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //廠商取得學生列表透過joid
    public function companyGetStudentListByJoId(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'joid' => 'required|integer',
        ), array(
            'joid.required' => '請輸入職缺ID',
            'integer' => '請輸入整數',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $token = JWTAuth::getToken();
            $user = JWTAuth::toUser($token);
            $stu_course = Stu_course::where('c_account', $user->account)->get();
            $student_list = array();
            foreach ($stu_course as $stu_cour) {
                $match = Stu_course::find($stu_cour->SCid)->match()->get();
                foreach ($match as $m) {
                    if ($m->joid == $re['joid']) {
                        Log::error($m);
                        $studentName = UserEloquent::where('id', $stu_cour->sid)->first();
                        $list = array('studentName' => $studentName->u_name, 'studentId' => $studentName->id, 'SCid' => $stu_cour->SCid);
                        $student_list[] = $list;
                    }
                }
            }
            return response()->json(['student_list' => $student_list], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //廠商取得特定學生的某一課程之週誌列表
    public function companyGetStudentJournalListBySCid(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入學生ID',
            'integer' => '請輸入整數',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->companyGetStudentJournalListBySCid_ser($re);
            if ($responses != '取得週誌列表失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array('$responses'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //廠商批改學生週誌
    public function companyScoreStudentJournal(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'journalID' => 'required|integer',
            'journalComments_ins' => 'required',
            'grade_ins' => 'required|numeric|max:100|min:0',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'journalComments_ins.required' => '請輸入週誌評語',
            'grade_ins.required' => '請輸入週誌成績',
            'integer' => '請輸入整數',
            'numeric' => '請輸入數字',
            'max' => '請輸入最多100分',
            'min' => '請輸入最少0分',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->companyScoreStudentJournal_ser($re);
            if ($responses == '批改週誌成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得特定週誌
    public function getStudentJournalDetailByJournalID(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'journalID' => 'required|integer',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $journal = Journal::where('journalID', $re['journalID'])->first();
            $course = Stu_course::find($journal->SCid)->courses()->first();
            $stu = Stu_course::find($journal->SCid)->user_stu()->first();
            $com = Stu_course::find($journal->SCid)->user_com()->first();
            $tea = Stu_course::find($journal->SCid)->user_tea()->first();
            $now = Carbon::now();
            if ($now < $course->courseEnd) {
                $passDeadLine = false;
            } else {
                $passDeadLine = true;
            }
            if (!$journal) {
                return response()->json(array('找不到週誌'), 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                $journal->stuName = $stu->u_name;
                $journal->stuNum = $stu->account;
                $journal->comName = $com->u_name;
                $journal->teaName = $tea->u_name;
                $journal->journalStart = Carbon::parse($journal->journalStart)->format('Y-m-d');
                $journal->journalEnd = Carbon::parse($journal->journalEnd)->format('Y-m-d');
                $journal->passDeadLine = $passDeadLine;


                return response()->json(['journalList' => $journal], 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得該課程的成績
    public function getStuCourseGradeBySCid(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $journal = Stu_course::find($re['SCid'])->journals;
            if ($journal) {
                $JGrade = array();
                foreach ($journal as $j) {
                    $journalGrade = array('journalId' => $j->journalID, 'grade_teacher' => $j->grade_teacher, 'grade_ins' => $j->grade_ins);
                    $JGrade[] = $journalGrade;
                }
                $total = Assessment_Teach::where('SCid', $re['SCid'])->first();
                if ($total) {
                    $JGrade[] =$total->totalScore;
                }else{
                    $JGrade[] =null;
                }
                return response()->json(['Grade' => $JGrade], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return '取得週誌列表失敗';
            }
        }
    }


    //系辦取得特定學生的某一課程之週誌列表
    public function adminGetStudentJournalListBySCid(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入學生ID',
            'integer' => '請輸入整數',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->GradeServices->adminGetStudentJournalListBySCid_ser($re);
            if ($responses != '取得週誌列表失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array('$responses'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}





