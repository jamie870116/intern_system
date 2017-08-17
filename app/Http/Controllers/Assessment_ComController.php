<?php

namespace App\Http\Controllers;

use App\Stu_course as Stu_courseEloquent;
use App\Services\Assessment_ComServices;
use App\User as UserEloquent;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

class Assessment_ComController extends Controller
{
    protected $Assessment_ComServices;

    public function __construct(Assessment_ComServices $Assessment_ComServices)
    {
        $this->middleware('student');
        $this->Assessment_ComServices = $Assessment_ComServices;
    }
    //取得待輸入之學生成績列表
    public function companyGetAssessmentList(){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_courseEloquent::where('c_account', $user->account)->get();
        $Assessment_list = array();
        foreach($stu_course as $stu_cour){
            $stu = UserEloquent::where('id',$stu_cour->sid)->first();
            $list = array($stu->u_name,$stu_course->SCid);
            $Assessment_list[] = $list;
        }
        return response()->json($Assessment_list, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //廠商在輸入成績前的預設資料
    public function getAssessmentBeforeInput(Request $request){
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
            $stu=Stu_courseEloquent::find($re['SCid'])->user_stu()->first();
            $tea=Stu_courseEloquent::find($re['SCid'])->user_tea()->first();
            $basic=Stu_courseEloquent::find($re['SCid'])->stu_basic()->first();
            $list = array($stu->u_name, $tea->u_name, $basic->profilePic);
        }
        return response()->json($list, 200, [], JSON_UNESCAPED_UNICODE);
    }

    //廠商輸入成績
    public function companyCreateAssessment(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required',
            'asStart' => 'required|date',
            'asEnd' => 'required|date',
            'asDepartment' => 'required',
            'asStuName' => 'required',
            'asComName' => 'required',
            'asGrade1' => 'required|integer',
            'asGrade2' => 'required|integer',
            'asGrade3' => 'required|integer',
            'asGrade4' => 'required|integer',
            'asGrade5' => 'required|integer',
            'asComment1' => 'required',
            'asComment2' => 'required',
            'asComment3' => 'required',
            'asComment4' => 'required',
            'asComment5' => 'required',
            'comment' => 'required',
            'asSickLeave_days' => 'required|integer',
            'asSickLeave_hours' => 'required|integer',
            'asOfficialLeave_days' => 'required|integer',
            'asOfficialLeave_hours' => 'required|integer',
            'asCasualLeave_days' => 'required|integer',
            'asCasualLeave_hours' => 'required|integer',
            'asMourningLeave_days' => 'required|integer',
            'asMourningLeave_hours' => 'required|integer',
            'asAbsenteeism_days' => 'required|integer',
            'asAbsenteeism_hours' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'asStart.required' => '請輸入實習開始時間',
            'asEnd.required' => '請輸入實習結束時間',
            'asDepartment.required' => '請輸入實習部門',
            'asStuName.required' => '請輸入實習生姓名',
            'asComName.required' => '請輸入實習單位',
            'asGrade1.required' => '請輸入成績',
            'asGrade2.required' => '請輸入成績',
            'asGrade3.required' => '請輸入成績',
            'asGrade4.required' => '請輸入成績',
            'asGrade5.required' => '請輸入成績',
            'asComment1.required' => '請輸入評論',
            'asComment2.required' => '請輸入評論',
            'asComment3.required' => '請輸入評論',
            'asComment4.required' => '請輸入評論',
            'asComment5.required' => '請輸入評論',
            'comment.required' => '請輸入總評',
            'asSickLeave_days.required' => '請輸入病假天數',
            'asSickLeave_hours.required' => '請輸入病假時數',
            'asOfficialLeave_days.required' => '請輸入公假天數',
            'asOfficialLeave_hours.required' => '請輸入公假時數',
            'asCasualLeave_days.required' => '請輸入事假天數',
            'asCasualLeave_hours.required' => '請輸入事假時數',
            'asMourningLeave_days.required' => '請輸入喪假天數',
            'asMourningLeave_hours.required' => '請輸入喪假時數',
            'asAbsenteeism_days.required' => '請輸入曠職天數',
            'asAbsenteeism_hours.required' => '請輸入曠職時數',
            'date' => '請輸入日期',
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
            $responses = $this->Assessment_ComServices->companyCreateAssessment_ser($re);
            if ($responses == '週誌輸入成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}


