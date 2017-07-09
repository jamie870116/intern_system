<?php

namespace App\Http\Controllers;

use App\Services\JobopeningServices;
use Illuminate\Http\Request;
use App\Job_opening as job_opEloquent;
use Validator;

class Job_openingController extends Controller
{

    protected $JobopeningServices;

    public function __construct(JobopeningServices $JobopeningServices)
    {
        $this->middleware('company',['except'=>'reviewJobOpening']);
        $this->middleware('admin',['only'=>'reviewJobOpening']);
        $this->JobopeningServices = $JobopeningServices;
    }

//新增職缺資料
    public function createJobOpening(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',
            'c_account' => 'required',
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required|email',
            'jsalary' => 'required'
            ), array(
            'required' => '此欄位不可為空白',
            'integer' => 'int格式錯誤',
            'email'=>'email格式錯誤'
            ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses=$this->JobopeningServices->createJobOpening_ser($re);
            if ($responses == '新增職缺資料成功，待審核') {
             return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
         } else {
             return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
         }
     }
 }
//修改職缺
 public function editJobOpening(Request $request,$joid){
    $re = $request->all();

    $objValidator = Validator::make($request->all(), array(
        'jtypes' => 'required|integer',
        'jduties' => 'required',
        'jdetails' => 'required',
        'jcontact_name' => 'required',
        'jcontact_phone' => 'required',
        'jcontact_email' => 'required|email',
        'jsalary' => 'required'
        ), array(
        'required' => '此欄位不可為空白',
        'integer' => 'int格式錯誤',
        'email'=>'email格式錯誤'
        ));
    if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses=$this->JobopeningServices->editJobOpening_ser($re,$joid);
            if ($responses == '修改職缺資料成功，職缺將撤下待重新審核') {
             return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
         } else {
             return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
         }
     }
 }
    //軟刪除
 public function deleteJobOpening(Request $request,$joid){
    $re = $request->all();

    $objValidator = Validator::make($request->all(), array(
        'jdelete_reason' => 'required'
        ), array(
        'required' => '此欄位不可為空白'
        ));
    if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses=$this->JobopeningServices->deleteJobOpening_ser($re,$joid);
            if ($responses == '職缺已刪除') {
             return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
         } else {
             return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
         }
     }
 }
//系辦審核
 public function reviewJobOpening(Request $request){
    $re = $request->all();

    $objValidator = Validator::make($request->all(), array(
        'joid' => 'required',
        'jstatus' => 'required|integer'
        ), array(
        'required' => '此欄位不可為空白',
        'integer' => 'int格式錯誤'
        ));
    if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses=$this->JobopeningServices->reviewJobOpening_ser($re);
            if ($responses == '職缺審核通過'||$responses == '職缺審核未通過') {
             return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
         } else {
             return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
         }
     }
 }

 //廠商取得自家職缺資料
    public function getJobOpeningbycompany(Request $request){
        $re=$request->all();
        $jobOp=job_opEloquent::where('c_account',$re['c_account']);
        if($jobOp){
            return response()->json($jobOp, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json('取得職缺資料失敗', 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
