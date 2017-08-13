<?php

namespace App\Http\Controllers;
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
       $this->middleware('company',['only'=>'companyGetStudentListByJoId','companyGetStudentJournalListBySCid','companyScoreStudentJournal']);
        $this->middleware('teacher',['only'=>'teacherGetStudentList','teacherGetStudentCourseList','teacherGetStudentJournalList','teacherScoreStudentJournal']);
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
            'journalComments_teacher' => 'required',
            'grade_teacher' => 'required|numeric',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'journalComments_teacher.required' => '請輸入週誌評語',
            'grade_teacher.required' => '請輸入週誌成績',
            'integer' => '請輸入整數',
            'numeric' => '請輸入數字',
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
            if($responses=='批改週誌成功'){
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            }else{
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
                $match=Stu_course::find($stu_cour->SCid)->match()->get();
                foreach ($match as $m){
                    if($m->joid==$re['joid']){
                        Log::error($m);
                        $studentName=UserEloquent::where('id',$stu_cour->sid)->first();
                        $list = array($studentName->u_name,$studentName->id,$stu_cour->SCid);
                        $student_list[] = $list;
                    }
                }
            }
            return response()->json($student_list, 200, [], JSON_UNESCAPED_UNICODE);
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
            if($responses!='取得週誌列表失敗'){
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
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
            'grade_ins' => 'required|numeric',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'journalComments_ins.required' => '請輸入週誌評語',
            'grade_ins.required' => '請輸入週誌成績',
            'integer' => '請輸入整數',
            'numeric' => '請輸入數字',
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
            if($responses=='批改週誌成功'){
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            }else{
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
            $journal=Journal::where('journalID',$re['journalID'])->first();
            if(!$journal){
                return response()->json(array('找不到週誌列表'), 400, [], JSON_UNESCAPED_UNICODE);
            }else {

                $journal->journalStart=Carbon::parse($journal->journalStart)->format('Y/m/d');
                $journal->journalEnd=Carbon::parse($journal->journalEnd)->format('Y/m/d');

                return response()->json($journal, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}



