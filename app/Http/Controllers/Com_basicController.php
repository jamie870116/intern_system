<?php

namespace App\Http\Controllers;

use App\Services\CompanyServices;
use Illuminate\Http\Request;
use App\Com_basic as comEloquent;
use Validator;

class Com_basicController extends Controller
{
	protected $CompanyServices;

	public function __construct(CompanyServices $CompanyServices)
	{
		$this->middleware('company',['except'=>'deleteCompany']);
		$this->middleware('admin',['only'=>'deleteCompany']);
		$this->CompanyServices = $CompanyServices;
	}
    //新增廠商資料
	public function createCompany(Request $request){
		$re = $request->all();

		$objValidator = Validator::make($request->all(), array(
			'c_account' => 'required',
			'ctypes' => 'required|integer',
			'caddress' => 'required'
			), array(
			'c_account.required' => '請輸入廠商帳號(統一編號)',
            'ctypes.required' => '此欄位不可為空白',
            'caddress.required' => '此欄位不可為空白',
			'integer' => 'int格式錯誤'
			));
		if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
        	$responses=$this->CompanyServices->createCompany_ser($re);
        	if ($responses == '新增廠商資料成功') {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

    //修改廠商資料
    public function editCompany(Request $request){
    	$re = $request->all();

    	$objValidator = Validator::make($request->all(), array(
    		'c_account' => 'required',
    		'ctypes' => 'required|integer',
    		'caddress' => 'required'
    		), array(
    		'required' => '此欄位不可為空白',
    		'integer' => 'int格式錯誤'
    		));
    	if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
        	$responses=$this->CompanyServices->editCompany_ser($re);
        	if ($responses == '修改廠商資料成功') {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

    //軟刪除 廠商
    public function deleteCompany(Request $request){
    	$re = $request->all();

    	$objValidator = Validator::make($request->all(), array(
    		'c_account' => 'required',
    		'cdeleteReason' => 'required'
    		), array(
    		'required' => '此欄位不可為空白'
    		));
    	if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
        	$responses=$this->CompanyServices->deleteCompany_ser($re);
        	if ($responses == '刪除廠商成功') {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

    // 依帳號查詢廠商資料
    public function getCompanyByAccount(Request $request){
    	$re = $request->all();

    	$objValidator = Validator::make($request->all(), array(
    		'c_account' => 'required'
    		), array(
    		'required' => '此欄位不可為空白'
    		));
    	if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
        	$responses=$this->CompanyServices->getCompanyByAccount_ser($re);
        	if ($responses == '取得廠商失敗') {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

}
