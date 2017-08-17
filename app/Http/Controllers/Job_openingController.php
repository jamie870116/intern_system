<?php

namespace App\Http\Controllers;

use App\Match;
use App\Services\JobopeningServices;
use App\Transformers\JopOpenTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Job_opening as job_opEloquent;

use JWTAuth;

use Validator;

class Job_openingController extends Controller
{

    protected $JobopeningServices;

    public function __construct(JobopeningServices $JobopeningServices)
    {
        $this->middleware('company', ['only' => 'createJobOpening', 'editJobOpening', 'deleteJobOpeningByCom', 'getJobOpeningbyAccount']);
        $this->middleware('admin', ['only' => 'reviewJobOpening', 'deleteJobOpeningByAdmin']);
        $this->JobopeningServices = $JobopeningServices;
    }

//新增職缺資料
    public function createJobOpening(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',//3，正職 2，工讀 0，暑期實習 1，學期實習
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required|email',
            'jsalary_up' => 'nullable|integer|min:0',
            'jsalary_low' => 'nullable|integer',
            'jEndDutyTime' => 'nullable|date',
            'jStartDutyTime' => 'nullable|date',
            'jaddress' => 'required',
            'jdeadline' => 'required|date',
            'jDutyTime' => 'required',
            'jNOP' => 'required|integer|min:0',
        ), array(
            'jtypes.required' => '請選擇職缺類型',
            'jduties.required' => '請輸入職稱',
            'jdetails.required' => '請填寫職務詳細內容',
            'jcontact_name.required' => '請輸入聯絡人姓名',
            'jcontact_phone.required' => '請輸入聯絡人電話',
            'jcontact_email.required' => '請輸入聯絡人信箱',
            'jsalary_low.required' => '請輸入薪水',
            'jaddress.required' => '請輸入工作地點',
            'jdeadline.required' => '請輸入截止日期',
            'jNOP.required' => '請輸入需求人數',
            'jDutyTime.required' => '請輸入工作時間',
            'integer' => 'int格式錯誤',
            'min' => '不得輸入低於0的數字',
            'date' => '日期時間格式錯誤',
            'email' => 'email格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->JobopeningServices->createJobOpening_ser($re);
            if ($responses == '新增職缺資料失敗') {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //修改職缺
    public function editJobOpening(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',//3，正職 2，工讀 0，暑期實習 1，學期實習
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required|email',
            'jsalary_up' => 'nullable|integer|min:0',
            'jsalary_low' => 'required|integer',
            'jaddress' => 'required',
            'jEndDutyTime' => 'nullable|date',
            'jStartDutyTime' => 'nullable|date',
            'jdeadline' => 'nullable|date',
            'jNOP' => 'required|integer|min:0',
            'joid' => 'required'
        ), array(
            'jtypes.required' => '請選擇職缺類型',
            'jduties.required' => '請輸入職稱',
            'jdetails.required' => '請填寫職務詳細內容',
            'jcontact_name.required' => '請輸入聯絡人姓名',
            'jcontact_phone.required' => '請輸入聯絡人電話',
            'jcontact_email.required' => '請輸入聯絡人信箱',
            'jsalary_low.required' => '請輸入薪水',
            'jaddress.required' => '請輸入工作地點',
            'jdeadline.required' => '請輸入截止日期',
            'jNOP.required' => '請輸入需求人數',
            'c_account.required' => '請輸入廠商帳號',
            'integer' => 'int格式錯誤',
            'min' => '不得輸入低於0的數字',
            'date' => '日期格式錯誤',
            'email' => 'email格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->JobopeningServices->editJobOpening_ser($re);
            if ($responses == '修改職缺資料成功，職缺將撤下待重新審核') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //軟刪除
    public function deleteJobOpeningByAdmin(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'joid' => 'required',
            'jdelete_reason' => 'required'
        ), array(
            'joid.required' => '請輸入職缺ID',
            'jdelete_reason.required' => '請填寫刪除該職缺之原因'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->JobopeningServices->deleteJobOpeningByAdmin_ser($re);
            if ($responses == '職缺已刪除') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //軟刪除
    public function deleteJobOpeningByCom(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'joid' => 'required'
        ), array(
            'joid.required' => '請輸入職缺ID'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->JobopeningServices->deleteJobOpeningByCom_ser($re);
            if ($responses == '職缺已刪除') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    //廠商帳號取得該廠商所有職缺資料
    public function getJobOpeningbyAccount()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $jobOp = job_opEloquent::where('c_account', $user->account)->SortByUpdates_DESC()->paginate(12);
        foreach ($jobOp as $j){
            $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
            $j->jResume_num=Match::where('joid',$j->joid)->count();
        }
        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['取得職缺資料失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得某一職缺細項
    public function getJobOpeningbyId(Request $request)
    {
        $re = $request->all();
        $jobOp = job_opEloquent::where('joid', $re['joid'])->first();
        $jobOp->jResume_num=Match::where('joid',$jobOp->joid)->count();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if($user->u_status==0){
            $match=Match::where('joid',$re['joid'])->where('sid',$user->id)->first();
            if($match){
                $jobOp->jResume_submitted=true;
            }else{
                $jobOp->jResume_submitted=false;
            }
        }
        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['取得職缺資料失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }


    //條件排序
    public function getJobOpeningBySearch(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'keyword' => 'nullable',
            'jtypes' => 'required', //1，正職 2，工讀 3，暑期實習 4，學期實習 0，全部(預設)
            'jsalary_lows' => 'nullable',
            'sortBy' => 'required', //1,時間DESC(預設) 2，時間ASC 3，薪水DESC 4，薪水ASC
        ), array(
            'sortBy.required' => '請選擇排序方式',
            'jtypes.required' => '請選擇種類',
            'integer' => '請回傳INT格式'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {

            if ($re['sortBy'] == 1) {
                $responses = $this->JobopeningServices->sortByTime_DESC($re);
                if($responses!='取得職缺資料失敗'){
                    return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
                }else{
                    return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
                }
            } elseif ($re['sortBy'] == 2) {
                $responses = $this->JobopeningServices->sortByTime_ASC($re);
                if($responses!='取得職缺資料失敗'){
                    return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
                }else{
                    return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
                }
            } elseif ($re['sortBy'] == 3) {
                $responses = $this->JobopeningServices->sortBySalary_DESC($re);
                if($responses!='取得職缺資料失敗'){
                    return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
                }else{
                    return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
                }
            } else {
                $responses = $this->JobopeningServices->sortBySalary_ASC($re);
                if($responses!='取得職缺資料失敗'){
                    return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
                }else{
                    return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
                }
            }

        }

    }

}
