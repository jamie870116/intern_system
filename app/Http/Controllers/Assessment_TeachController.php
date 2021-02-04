<?php

namespace App\Http\Controllers;

use App\Assessment_Com;
use App\Journal;
use App\Services\Assessment_TeachServices;
use App\Stu_course as Stu_courseEloquent;
use App\Assessment_Teach as Assessment_TeachEloquent;
use App\Stu_course;
use App\User as UserEloquent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;



class Assessment_TeachController extends Controller
{

    protected $Assessment_TeachServices;

    public function __construct(Assessment_TeachServices $Assessment_TeachServices)
    {
        $this->middleware('teacher',['except'=>'getTeacherAssessmentById']);
        $this->Assessment_TeachServices = $Assessment_TeachServices;
    }

    //老師取得可輸入成績之學生列表，當assessmentStatus=2
    public function teacherGetAssessmentList(){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_courseEloquent::where('tid', $user->id)->where('assessmentStatus',2)->get();
        $Assessment_list = array();
        foreach($stu_course as $stu_cour){
            $stu = UserEloquent::where('id',$stu_cour->sid)->first();
            $list = array('stuName'=>$stu->u_name,$stu_cour);
            $Assessment_list[] = $list;
        }
        return response()->json($Assessment_list, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //老師輸入成績
    public function teacherCreateAssessment(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|unique:assessment_teach,SCid',
            'teacherGrade1' => 'required|integer',
            'teacherGrade2' => 'required|integer',
            'teacherGrade3' => 'required|integer',
            'teacherGrade4' => 'required|integer',
            'teacherGrade5' => 'required|integer',
            'teacherGrade6' => 'required|integer',
            'teacherGrade7' => 'required|integer',
            'teacherGrade8' => 'required|integer',
            'teacherGrade9' => 'required|integer',
            'teacherGrade10' => 'required|integer',
            'comment' => 'required',
            'totalScore' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'teacherGrade1.required' => '請輸入成績',
            'teacherGrade2.required' => '請輸入成績',
            'teacherGrade3.required' => '請輸入成績',
            'teacherGrade4.required' => '請輸入成績',
            'teacherGrade5.required' => '請輸入成績',
            'teacherGrade6.required' => '請輸入成績',
            'teacherGrade7.required' => '請輸入成績',
            'teacherGrade8.required' => '請輸入成績',
            'teacherGrade9.required' => '請輸入成績',
            'teacherGrade10.required' => '請輸入成績',
            'comment.required' => '請輸入總評',
            'totalScore.required' => '請輸入總成績',
            'unique' => '重複新增',
            'integer' =>'請輸入數字',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->Assessment_TeachServices->teacherCreateAssessment_ser($re);
            if ($responses != '尚有未填寫資料，故無法進行評量'||$responses !='廠商尚未填寫資料，故無法進行評量') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //顯示廠商打的成績_老師
    public function teacherGetComAssessmentById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required',
        ), array(
            'SCid.required' => '請輸入SCid',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $Assessment_c=Assessment_Com::where('SCid',$re['SCid'])->first();
            if ($Assessment_c) {
                return response()->json($Assessment_c, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json('廠商尚未填寫成績資料', 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //顯示老師所輸入之成績
    public function getTeacherAssessmentById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required',
        ), array(
            'SCid.required' => '請輸入SCid',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $Assessment_Teaches=Assessment_TeachEloquent::where('SCid',$re['SCid'])->get();
            $Assessment_Teaches_fr=Assessment_TeachEloquent::where('SCid',$re['SCid'])->first();
            if ($Assessment_Teaches_fr) {
                foreach ($Assessment_Teaches as $Assessment_Teach){
                    $Assessment_c=Assessment_Com::where('SCid',$re['SCid'])->first();
                    $Assessment_Teach->asSickLeave_days=$Assessment_c->asSickLeave_days;
                    $Assessment_Teach->asSickLeave_hours=$Assessment_c->asSickLeave_hours;
                    $Assessment_Teach->asOfficialLeave_days=$Assessment_c->asOfficialLeave_days;
                    $Assessment_Teach->asOfficialLeave_hours=$Assessment_c->asOfficialLeave_hours;
                    $Assessment_Teach->asCasualLeave_days=$Assessment_c->asCasualLeave_days;
                    $Assessment_Teach->asCasualLeave_hours=$Assessment_c->asCasualLeave_hours;
                    $Assessment_Teach->asMourningLeave_days=$Assessment_c->asMourningLeave_days;
                    $Assessment_Teach->asMourningLeave_hours=$Assessment_c->asMourningLeave_hours;
                    $Assessment_Teach->asAbsenteeism_days=$Assessment_c->asAbsenteeism_days;
                    $Assessment_Teach->asAbsenteeism_hours=$Assessment_c->asAbsenteeism_hours;
                    $Assessment_Teach->asStart=$Assessment_c->asStart;
                    $Assessment_Teach->asEnd=$Assessment_c->asEnd;
                    $Assessment_Teach->asDepartment=$Assessment_c->asDepartment;
                    $journal=Journal::where('SCid',$re['SCid'])->first();
                    $Assessment_Teach->journalInstructor=$journal->journalInstructor;
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $Assessment_Teach->stuName=$stu->u_name;
                    $Assessment_Teach->comName=$com->u_name;
                }


                return response()->json($Assessment_Teaches, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json('無資料', 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //老師修改成績
    public function teacherEditAssessment(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required',
            'asTId' => 'required',
            'teacherGrade1' => 'required|integer',
            'teacherGrade2' => 'required|integer',
            'teacherGrade3' => 'required|integer',
            'teacherGrade4' => 'required|integer',
            'teacherGrade5' => 'required|integer',
            'teacherGrade6' => 'required|integer',
            'teacherGrade7' => 'required|integer',
            'teacherGrade8' => 'required|integer',
            'teacherGrade9' => 'required|integer',
            'teacherGrade10' => 'required|integer',
            'comment' => 'required',
            'totalScore' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'asTId.required' => '請輸入asTId',
            'teacherGrade1.required' => '請輸入成績',
            'teacherGrade2.required' => '請輸入成績',
            'teacherGrade3.required' => '請輸入成績',
            'teacherGrade4.required' => '請輸入成績',
            'teacherGrade5.required' => '請輸入成績',
            'teacherGrade6.required' => '請輸入成績',
            'teacherGrade7.required' => '請輸入成績',
            'teacherGrade8.required' => '請輸入成績',
            'teacherGrade9.required' => '請輸入成績',
            'teacherGrade10.required' => '請輸入成績',
            'comment.required' => '請輸入總評',
            'totalScore.required' => '請輸入總成績',
            'integer' =>'請輸入數字',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->Assessment_TeachServices->teacherEditAssessment_ser($re);
            if ($responses != '修改成果評量失敗') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}









