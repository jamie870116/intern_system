<?php

namespace App\Http\Controllers;

use App\Services\CounselingServices;
use Illuminate\Http\Request;
use Validator;

class Counseling_resultController extends Controller
{
    protected $CounselingServices;

    public function __construct(CounselingServices $CounselingServices)
    {
        $this->middleware('teacher',['except'=>'getCounselingResultBySCid']);
        $this->CounselingServices = $CounselingServices;
    }

    //以SCid取得業師輔導成果表，如果沒填寫過則傳回帶預設值表單
    public function getCounselingResultBySCid(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'integer'=>'請輸入INT'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->CounselingServices->getCounselingResultBySCid_ser($re['SCid']);
            if ($responses) {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['錯誤'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //以SCid新增業師輔導成果表
    public function createCounselingResultBySCid(Request $request){

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
            'counselingAddress' => 'required',
            'counselingDate' => 'required|date',
            'cTeacherName' => 'required',
            'counselingContent' => 'required',
            'counselingPic' => 'nullable',
            'counselingText' => 'nullable',

        ), array(
            'SCid.required' => '請輸入SCid',
            'counselingAddress.required' => '請輸入實習機構輔導地址',
            'counselingDate.required' => '請輸入日期',
            'cTeacherName.required' => '請輸入實習機構輔導老師',
            'counselingContent.required' => '請輸入輔導內容',
            'counselingPic.required' => '請上傳圖片',
            'integer'=>'請輸入INT',
            'date'=>'請輸入日期格式',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {

            $responses=$this->CounselingServices->createCounselingResultBySCid_ser($request);
            if ($responses=='新增業師輔導成果表成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //新增業師輔導成果表的圖片
    public function createCounselingResultPic(Request $request){

        $objValidator = Validator::make($request->all(), array(
            'counselingPic.*' => 'required|image',//可上傳多個
        ), array(
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp)',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {

            $responses=$this->CounselingServices->createCounselingResultPic_ser($request);
            if ( is_array ( $responses )) {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

 //用檔名和SCid刪除業師輔導成果表的圖片
//    public function deleteCounselingResultPicByFilename(Request $request){
//
//        $objValidator = Validator::make($request->all(), array(
//            'SCid' => 'required|integer',
//            'filename' => 'required',//可上傳多個
//        ), array(
//            'SCid.required' => '請輸入SCid',
//
//        ));
//        if ($objValidator->fails()) {
//            $errors = $objValidator->errors();
//            $error=array();
//            foreach ($errors->all() as $message) {
//                $error[]=$message;
//            }
//            return response()->json($error,400);//422
//        } else {
//
//            $responses=$this->CounselingServices->createCounselingResultPicBySCid_ser($request);
//            if ( is_array ( $responses )) {
//                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
//            } else {
//                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
//            }
//        }
//    }

    //以SCid編輯業師輔導成果表
    public function editCounselingResultBySCid(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
            'counselingAddress' => 'required',
            'counselingDate' => 'required|date',
            'cTeacherName' => 'required',
            'counselingContent' => 'required',
            'counselingPic' => 'nullable|image',//可上傳多個
            'counselingText' => 'nullable',
        ), array(
            'SCid.required' => '請輸入SCid',
            'counselingAddress.required' => '請輸入實習機構輔導地址',
            'counselingDate.required' => '請輸入日期',
            'cTeacherName.required' => '請輸入實習機構輔導老師',
            'counselingContent.required' => '請輸入輔導內容',
            'integer'=>'請輸入INT',
            'date'=>'請輸入日期格式',
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
            $responses=$this->CounselingServices->createCounselingResultBySCid_ser($re);
            if ($responses=='修改業師輔導成果表成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
