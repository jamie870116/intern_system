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
		$this->middleware('company',['only'=>'createCompany','editCompany']);
		$this->middleware('admin',['only'=>'adminDeleteCompany']);
		$this->CompanyServices = $CompanyServices;
	}
    //新增廠商資料
	public function createCompany(Request $request){
		$re = $request->all();

		$objValidator = Validator::make($request->all(), array(
			'ctypes' => 'required|integer',
			'caddress' => 'required',
            'cintroduction' =>'nullable',
            'cempolyee_num' =>'nullable|integer'
			), array(
			'c_account.required' => '請輸入廠商帳號(統一編號)',
            'ctypes.required' => '請輸入行業類別',
            'caddress.required' => '請輸入公司地址',
			'integer' => 'int格式錯誤'
			));
		if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
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
    		'ctypes' => 'required|integer',
    		'caddress' => 'required',
            'cintroduction' =>'nullable',
            'cempolyee_num' =>'nullable|integer'
    		), array(
            'ctypes.required' => '請輸入行業類別',
            'caddress.required' => '請輸入公司地址',
    		'integer' => 'int格式錯誤'
    		));
    	if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
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
    public function adminDeleteCompany(Request $request){
    	$re = $request->all();

    	$objValidator = Validator::make($request->all(), array(
    		'c_account' => 'required',
    		'cdeleteReason' => 'required'
    		), array(
            'c_account.required' => '請輸入廠商帳號',
            'cdeleteReason.required' => '請填寫刪除之理由'
    		));
    	if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
        	$responses=$this->CompanyServices->adminDeleteCompany_ser($re);
        	if ($responses == '刪除廠商成功') {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

    // 依帳號查詢廠商資料
    public function getCompanyDetailsByAccount(Request $request){
    	$re = $request->all();

    	$objValidator = Validator::make($request->all(), array(
    		'c_account' => 'required'
    		), array(
    		'c_account.required' => '請輸入廠商帳號'
    		));
    	if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
        	$responses=$this->CompanyServices->getCompanyDetailsByAccount_ser($re);
        	if ($responses == '取得廠商失敗') {
        		return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

}
