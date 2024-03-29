<?php

namespace App\Http\Controllers;

use App\Services\CompanyServices;
use App\User;
use Illuminate\Http\Request;
use App\Com_basic as comEloquent;
use JWTAuth;
use Validator;

class Com_basicController extends Controller
{
	protected $CompanyServices;

	public function __construct(CompanyServices $CompanyServices)
	{
		$this->middleware('company',['only'=>'editCompany','getCompanyDetailsByToken']);
//		$this->middleware('admin',['only'=>'adminDeleteCompany']);
		$this->CompanyServices = $CompanyServices;
	}

    //依帳號取得廠商相片
    public function getCompanyProfilePictureByC_account(Request $request){

        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'c_account' => 'required',
        ), array(
            'c_account.required'=>'請輸入廠商帳號',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $com=comEloquent::where('c_account',$re['c_account'])->first();
            if($com){
                 return response()->json(['c_account'=>$re['c_account'],'profilePic'=>$com->profilePic], 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得所有廠商相片
    public function getCompanyProfilePicture(){
            $com=comEloquent::all();
            if($com){
                $res=array();
                foreach ($com as $c) {
                    $cb=['c_account'=>$c->c_account,'profilePic'=>$c->profilePic];
                    $res[]=$cb;
                }
                 return response()->json($res, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
            }
    }

    //廠商上傳頭貼
    public function companyUploadProfilePic(Request $request){
        $objValidator = Validator::make($request->all(), array(
            'profilePic'=>'required|image'
        ), array(
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)',
            'required'=>'請上傳圖片'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $file=$request->file('profilePic');
            $responses = $this->CompanyServices->companyUploadProfilePic_ser($request,$file);
            if ($responses == '頭貼上傳失敗') {
                $r=array($responses);
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //上傳圖片
    public function uploadPhoto(Request $request){

        $objValidator = Validator::make($request->all(), array(
            'filename.*' => 'required|file|image',//可上傳多個
        ), array(
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp)',
            'filename.required'=>'請選擇欲上傳之檔案',
            'file'=>'請上傳檔案',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {

            $responses=$this->CompanyServices->uploadPhoto_ser($request);
            if ( is_array ( $responses )) {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    // 取得廠商自己的簡介
    public function getCompanyDetailsByToken(){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $com = comEloquent::where('c_account', $user->account)->first();
        if($com){
            $com->tel=$user->u_tel;
            return response()->json($com, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //修改廠商資料
    public function editCompanyDetails(Request $request){


    	$objValidator = Validator::make($request->all(), array(
    		'ctypes' => 'required',
    		'c_name' => 'required',
    		'caddress' => 'required',
    		'cfax' => 'required',
    		'u_tel' => 'required',
            'cintroduction' =>'nullable',
            'cempolyee_num' =>'nullable|integer',
            'profilePic' =>'nullable|image',
            'introductionPic' =>'nullable|image',
            'introductionPicFilenameOnly' =>'nullable',
    		), array(
            'ctypes.required' => '請輸入行業類別',
            'c_name.required' => '請輸入廠商名稱',
            'u_tel.required' => '請輸入廠商電話',
            'cfax.required' => '請輸入傳真',
            'caddress.required' => '請輸入公司地址',
    		'integer' => 'int格式錯誤',
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)',
    		));
    	if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $file=$request->file('profilePic');


        	$responses=$this->CompanyServices->editCompanyDetails_ser($request,$file);
        	if ($responses == '修改廠商資料成功') {
        		return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

//    //軟刪除 廠商
//    public function adminDeleteCompany(Request $request){
//    	$re = $request->all();
//
//    	$objValidator = Validator::make($request->all(), array(
//    		'c_account' => 'required',
//    		'cdeleteReason' => 'required'
//    		), array(
//            'c_account.required' => '請輸入廠商帳號',
//            'cdeleteReason.required' => '請填寫刪除之理由'
//    		));
//    	if ($objValidator->fails()) {
//            $errors = $objValidator->errors();
//            $error=array();
//            foreach ($errors->all() as $message) {
//                $error[]=$message;
//            }
//            return response()->json($error,400);//422
//        } else {
//        	$responses=$this->CompanyServices->adminDeleteCompany_ser($re);
//        	if ($responses == '刪除廠商成功') {
//        		return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
//        	} else {
//        		return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
//        	}
//        }
//    }

    // 取得所有廠商列表
    public function getCompanyList(){
        $user=User::where('u_status',2)->where('started',1)->get();
        if($user){
            $company=array();
            foreach ($user as $u){
                $com=User::find($u->id)->company;
                $com->tel=$u->u_tel;
                $company[]=$com;
            }
            return response()->json(['CompanyList'=>$company], 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    // 依帳號查詢廠商介紹
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
        		return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
        	} else {
        		return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
        	}
        }
    }

}
