<?php

namespace App\Http\Controllers;

use App\Services\Assessment_TeachServices;
use App\Stu_course as Stu_courseEloquent;
use App\Assessment_Teach as Assessment_TeachEloquent;
use App\User as UserEloquent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;



class Assessment_TeachController extends Controller
{

    protected $Assessment_TeachServices;

    public function __construct(Assessment_TeachServices $Assessment_TeachServices)
    {
        $this->middleware('teacher');
        $this->Assessment_TeachServices = $Assessment_TeachServices;
    }

    //老師取得可輸入成績之學生列表，當assessmentStatus=2
    public function teacherGetAssessmentList(){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_courseEloquent::where('tid', $user->id)->get();
        $Assessment_list = array();
        foreach($stu_course as $stu_cour){
            $stu = UserEloquent::where('id',$stu_cour->sid)->first();
            $list = array($stu->u_name,$stu_course->SCid,$stu_cour->assessmentStatus);
            $Assessment_list[] = $list;
        }
        return response()->json($Assessment_list, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //老師輸入成績
    public function teacherCreateAssessment(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|unique:assessment_com,SCid',
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
            if ($responses != '新增成果評量失敗') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //顯示老師所輸入之成績
    public function getTeacherAssessmentById(Request $request)
    {
        $re = $request->all();
        $Assessment_Teach=Assessment_TeachEloquent::where('asTId',$re['asTId'])->first();
        if ($Assessment_Teach) {
            return response()->json($Assessment_Teach, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
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









