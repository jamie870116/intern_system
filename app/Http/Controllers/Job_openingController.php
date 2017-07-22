<?php

namespace App\Http\Controllers;

use App\Services\JobopeningServices;
use Illuminate\Http\Request;
use App\Job_opening as job_opEloquent;

use Log;
use Validator;

class Job_openingController extends Controller
{

    protected $JobopeningServices;

    public function __construct(JobopeningServices $JobopeningServices)
    {
        $this->middleware('company', ['except' => 'reviewJobOpening', 'deleteJobOpeningByAdmin']);
        $this->middleware('admin', ['only' => 'reviewJobOpening', 'deleteJobOpeningByAdmin']);
        $this->JobopeningServices = $JobopeningServices;
    }

//新增職缺資料
    public function createJobOpening(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required|email',
            'jsalary_up' => 'nullable|integer|min:0',
            'jsalary_low' => 'required|integer',
            'jaddress' => 'required',
            'jdeadline' => 'required|date',
            'jNOP' => 'required|integer|min:0',
            'c_account' => 'required'
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->JobopeningServices->createJobOpening_ser($re);
            if ($responses == '新增職缺資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

//修改職缺
    public function editJobOpening(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required|email',
            'jsalary_up' => 'nullable|integer|min:0',
            'jsalary_low' => 'required|integer',
            'jaddress' => 'required',
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->JobopeningServices->editJobOpening_ser($re);
            if ($responses == '修改職缺資料成功，職缺將撤下待重新審核') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->JobopeningServices->deleteJobOpeningByAdmin_ser($re);
            if ($responses == '職缺已刪除') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->JobopeningServices->deleteJobOpeningByCom_ser($re);
            if ($responses == '職缺已刪除') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

////系辦審核
//    public function reviewJobOpening(Request $request)
//    {
//        $re = $request->all();
//
//        $objValidator = Validator::make($request->all(), array(
//            'joid' => 'required',
//            'jstatus' => 'required|integer'
//        ), array(
//            'required' => '此欄位不可為空白',
//            'integer' => 'int格式錯誤'
//        ));
//        if ($objValidator->fails()) {
//            return response()->json($objValidator->errors(), 400);//422
//        } else {
//            $responses = $this->JobopeningServices->reviewJobOpening_ser($re);
//            if ($responses == '職缺審核通過' || $responses == '職缺審核未通過') {
////                $this->JobopeningServices->sendResultMail($responses,$re['joid']);
//                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
//            } else {
//                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
//            }
//        }
//    }

    //廠商帳號取得該廠商所有職缺資料
    public function getJobOpeningbyAccount(Request $request)
    {
        $re = $request->all();
        $jobOp = job_opEloquent::where('c_account', $re['c_account'])->SortByUpdates_DESC()->get();
        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得某一職缺細項
    public function getJobOpeningbyId(Request $request)
    {
        $re = $request->all();
        $jobOp = job_opEloquent::where('joid', $re['joid'])->first();
        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得所有職缺(截止日期未到期的
    public function getJobOpeningAll()
    {
        $jobOp = job_opEloquent::GetAll()->SortByUpdates_DESC()->paginate(9);

        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得所有職缺(截止日期未到期的 時間由小到大
    public function getJobOpeningAll_ASC()
    {
        $jobOp = job_opEloquent::GetAll()->SortByUpdates_ASC()->get();

        if ($jobOp) {
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //條件排序
    public function getJobOpeningBySearch(Request $request)
    {
        $re = $request->all();
        $keyword = '%'.$re['keyword'].'%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];

        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp=job_opEloquent::GetAll()->where('jsalary_low','>=',$jsalary_lows)->ByTypes($jtypes);
                $jobOp=$jobOp->where('jduties','like',$keyword)->orWhere('jdetails','like',$keyword)->get();
                if ($jobOp) {
                    return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
                }
            } else {
                $jobOp=job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp=$jobOp->where('jduties','like',$keyword)->orWhere('jdetails','like',$keyword)->get();
                if ($jobOp) {
                    return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp=job_opEloquent::GetAll()->where('jsalary_low','>=',$jsalary_lows)->ByTypes($jtypes)->get();
                if ($jobOp) {
                    return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
                }
            } else {
                $jobOp=job_opEloquent::GetAll()->ByTypes($jtypes)->get();
                if ($jobOp) {
                    return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json('取得職缺資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
                }
            }
        }

    }


}
