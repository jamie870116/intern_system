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
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
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
            $stu_course = Stu_course::where('tid', $user->id)->where('sid',$re['sid'])->get();
            $courses=array();
            $courses[]=$re['sid'];
            foreach ($stu_course as $s){
                $course = Stu_course::find($s->SCid)->courses;
                $course->courseStart=Carbon::parse($course->courseStart)->format('Y/m/d');
                $course->courseEnd=Carbon::parse($course->courseEnd)->format('Y/m/d');
                $courses[]=$course;
            }

            return response()->json($courses, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //老師取得特定學生的某一課程之週誌列表
    public function teacherGetStudentJournalList(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
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
            $stu_course = Stu_course::where('tid', $user->id)->where('sid',$re['sid'])->where('courseId',$re['courseId'])->first();
            $journal= Stu_course::find($stu_course->SCid)->journals;
            foreach ($journal as $j){
                $j->journalStart=Carbon::parse($j->journalStart)->format('Y/m/d');
                $j->journalStart=Carbon::parse($j->journalStart)->format('Y/m/d');
            }
            return response()->json($journal, 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}



