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
        $this->JobopeningServices = $JobopeningServices;
    }


    public function createJobOpening(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jtypes' => 'required|integer',
            'c_account' => 'required',
            'jduties' => 'required',
            'jdetails' => 'required',
            'jcontact_name' => 'required',
            'jcontact_phone' => 'required',
            'jcontact_email' => 'required',
            'jsalary' => 'required'
        ), array(
            'required' => '此欄位不可為空白',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {

//            if ($responses == '新增學歷資料成功') {
//                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
//            } else {
//                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
//            }
        }
    }
}
