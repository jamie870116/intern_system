<?php

namespace App\Http\Controllers;

use App\Job_opening;
use App\Services\MatchServices;

use Illuminate\Http\Request;

use App\Match as MatchEloquent;
use App\Stu_basic as stuBasicEloquent;
use App\Stu_edu as stuEduEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_relatives as stuRelativesEloquent;
use App\Stu_works as stuWorksEloquent;

use Validator;

class MatchController extends Controller
{
    protected $MatchServices;

    public function __construct(MatchServices $MatchServices)
    {
//        $this->middleware('company', ['only' => '', '']);
//        $this->middleware('student', ['only' => '', '']);
//        $this->middleware('admin', ['only' => '', '']);
        $this->MatchServices = $MatchServices;
    }

    //投遞履歷resume
    public function studentSubmitResume(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'c_account' => 'required',
            'sid' => 'required|integer',
            'joid' => 'required|integer'
        ), array(
            'c_account.required' => '請輸入廠商帳號(統一編號)',
            'sid.required' => '請輸入學生ID',
            'joid.required' => '請輸入職缺ID',
            'integer' => 'int格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->studentSubmitResume_ser($re);
            if ($responses == '新增媒合資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }


    }

    //廠商取得投遞的履歷
    public function companyGetResumeByAccount(Request $request)
    {
        $re = $request->all();

        $match = MatchEloquent::where('c_account', $re['c_account'])->get();
        if ($match) {
            $response = array();
            foreach ($match as $m) {
                $id = $m->sid;
                $mid = $m->mid;
                $stuBas = stuBasicEloquent::where('sid', $id)->get();
                $stuEdu = stuEduEloquent::where('sid', $id)->get();
                $stuJExp = stuJExpEloquent::where('sid', $id)->get();
                $stuLic = stulicenceEloquent::where('sid', $id)->get();
                $stuRel = stuRelativesEloquent::where('sid', $id)->get();
                $stuWor = stuWorksEloquent::where('sid', $id)->get();
                $stdRe = array($mid,$stuBas, $stuEdu, $stuJExp, $stuLic, $stuRel, $stuWor);
                $response[] = $stdRe;
            }

            return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //廠商回應履歷-拒絕
    public function companyRejectResume(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
            'mfailedreason'=>'nullable'
        ), array(
            'mid.required' => '請輸入媒合ID',
            'mid.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companyRejectResume_ser($re);
            if ($responses == '拒絕媒合成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //廠商回應履歷-接受
    public function companyAcceptResume(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
            'mstatus'=>'required|integer' //傳入1==去面試，其他是直接接受
        ), array(
            'mid.required' => '請輸入媒合ID',
            'mstatus.required' => '請回傳1，讓他來面試或回傳2直接接受',
            'integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companyAcceptResume_ser($re);
            if ($responses == '接受媒合成功，直接錄取成功'||$responses == '接受媒合成功，去填寫面試通知吧') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得廠商聯絡資訊
    public function companyGetJobOpeningContactByMid(Request $request){
        $re=$request->all();

        $match = MatchEloquent::where('mid', $re['mid'])->first();
        if ($match) {
            $joid=$match->joid;
            $jo=Job_opening::where('joid',$joid)->first();
            $contact=array($jo->jcontact_name,$jo->jcontact_phone,$jo->jcontact_email);
            return response()->json($contact, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }
    //面試通知
    public function companySendInterviewNotice(Request $request){
        $re=$request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid'=>'required',
            'inadress' => 'required',
            'intime' => 'required|date',
            'jcontact_email' => 'required|email',
            'jcontact_phone' => 'required',
            'innotice' => 'required',
            'jcontact_name' => 'required'
        ), array(
            'mid.required'=>'請輸入媒合ID',
            'inadress.required' => '請輸入面試地點',
            'intime.required' => '請輸入面試時間',
            'jcontact_email.required' => '請輸入聯絡信箱',
            'jcontact_phone.required' => '請輸入連絡電話',
            'innotice.required' => '請填寫面試注意事項',
            'jcontact_name.required' => '請輸入聯絡人姓名',
            'integer' => 'int格式錯誤',
            'date'=>'日期時間格式錯誤',
            'email'=>'信箱格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companySendInterviewNotice_ser($re);
            if ($responses == '成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //
    //學生是否接受面試
    public function studentAcceptInterview(Request $request){
        $re=$request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid'=>'required',
            'mstatus' => 'required|integer',

        ), array(
            'mid.required'=>'請輸入媒合ID',
            'mstatus.required'=>'請回傳1，去面試或回傳2拒絕', //傳入1==去面試，其他是拒絕
            'integer' => 'int格式錯誤',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->studentAcceptInterview_ser($re);
            if ($responses == '接受面試成功'||$responses == '接受面試失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //面試失敗
//    public function interviewFailed(Request $request){
//        $re=$request->all();
//
//        $objValidator = Validator::make($request->all(), array(
//            'mid'=>'required',
//            'mstatus' => 'required|integer',
//
//        ), array(
//            'mid.required'=>'請輸入媒合ID',
//            'mstatus.required'=>'請選擇是否接受', //傳入1==去面試，其他是拒絕
//            'integer' => 'int格式錯誤',
//
//        ));
//        if ($objValidator->fails()) {
//            $errors = $objValidator->errors();
//            $error = array();
//            foreach ($errors->all() as $message) {
//                $error[] = $message;
//            }
//            return response()->json($error, 400);//422
//        } else {
//            $responses = $this->MatchServices->acceptInterview_ser($re);
//            if ($responses == '成功') {
//                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
//            } else {
//                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
//            }
//        }
//    }

//面試成功
//    public function interviewSuccess(Request $request){
//        $re=$request->all();
//
//        $objValidator = Validator::make($request->all(), array(
//            'mid'=>'required',
//            'mstatus' => 'required|integer',
//
//        ), array(
//            'mid.required'=>'請輸入媒合ID',
//            'mstatus.required'=>'請選擇是否接受', //傳入1==去面試，其他是拒絕
//            'integer' => 'int格式錯誤',
//
//        ));
//        if ($objValidator->fails()) {
//            $errors = $objValidator->errors();
//            $error = array();
//            foreach ($errors->all() as $message) {
//                $error[] = $message;
//            }
//            return response()->json($error, 400);//422
//        } else {
//            $responses = $this->MatchServices->acceptInterview_ser($re);
//            if ($responses == '成功') {
//                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
//            } else {
//                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
//            }
//        }
//    }
}
