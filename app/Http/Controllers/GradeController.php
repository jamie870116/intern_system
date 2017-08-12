<?php

namespace App\Http\Controllers;
use App\Services\GradeServices;

use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

use App\Stu_course;
use App\User as UserEloquent;
use App\Course as CourseEloquent;
use Validator;

class GradeController extends Controller
{
    protected $GradeServices;

    public function __construct(GradeServices $GradeServices)
    {
//        $this->middleware('company');
        $this->middleware('teacher',['only'=>'teacherGetStudentList','teacherGetStudentCourseList','teacherGetStudentJournalList']);
        $this->GradeServices = $GradeServices;
    }

    //老師取得學生列表
    public function teacherGetStudentList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_course::where('tid', $user->id)->get();
        $student_list = array();
        foreach ($stu_course as $stu_cour) {
            $studentName=UserEloquent::where('id',$stu_cour->sid)->first();
            $list = array($studentName->u_name,$studentName->id);
            $student_list[] = $list;
        }
        return response()->json($student_list, 200, [], JSON_UNESCAPED_UNICODE);
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
            if($responses!='取得學生課程列表失敗'){
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(array('$responses'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //老師取得特定學生的某一課程之週誌列表
    public function teacherGetStudentJournalList(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'sid' => 'required|integer',
            'courseId' => 'required|integer',
        ), array(
            'sid.required' => '請輸入學生ID',
            'courseId.required' => '請輸入課程ID',
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
            if($responses!='取得週誌列表失敗'){
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
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
        ), array(
            'journalID.required' => '請輸入週誌ID',
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
            if($responses!='批改失敗'){
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(array('$responses'), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}



