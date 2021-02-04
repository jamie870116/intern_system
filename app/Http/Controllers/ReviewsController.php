<?php

namespace App\Http\Controllers;

use App\Services\ReviewsServices;
use Illuminate\Http\Request;
use Validator;

class ReviewsController extends Controller
{
    protected $ReviewsServices;

    public function __construct(ReviewsServices $ReviewsServices)
    {
        $this->middleware('student',['only'=>'createReview','showReviewByReId']);
        $this->ReviewsServices = $ReviewsServices;
    }

    //數字數
    public function countText(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'reContent' => 'required'
        ), array(
            'reContent.required' => '請輸入實習心得',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses=mb_strlen($re['reContent']);
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //新增實習心得
    public function createReview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer|unique:reviews,SCid',
            'reContent' => 'required|max:1000|min:700'
        ), array(
            'SCid.required' => '請輸入SCid',
            'reContent.required' => '請輸入實習心得',
            'integer' => 'int格式錯誤',
            'max' => '字數過多，800字為原則。',
            'min' => '字數過少，800字為原則。',
            'unique' => '心得已存在',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ReviewsServices->createReview_ser($re);
            if ($responses == '新增心得成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //修改實習心得
    public function editReview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'reId' => 'required|integer',
            'reContent' => 'required|max:1000|min:700'
        ), array(
            'reId.required' => '請輸入reId',
            'reContent.required' => '請輸入實習心得',
            'max' => '字數過多，800字為原則。',
            'min' => '字數過少，800字為原則。',
            'integer' => 'int格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                if($message=='字數過多，800字為原則。'||$message=='字數過少，800字為原則。'){
                    $len=mb_strlen($re['reContent']);
                    $message .='(現在字數為:'.$len.'字)';
                }
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ReviewsServices->editReview_ser($re);
            if ($responses == '修改心得成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //顯示實習心得ByReId
    public function getReviewByReId(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'reId' => 'required|integer',
        ), array(
            'reId.required' => '請輸入reId',
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
            $responses = $this->ReviewsServices->getReviewByReId_ser($re['reId']);
            if ($responses != '找不到此心得') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //顯示實習心得BySCid
    public function getReviewBySCid(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
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
            $responses = $this->ReviewsServices->getReviewBySCid_ser($re['SCid']);
            if ($responses != '找不到此心得') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //老師查閱實習心得
    public function teacherAccessReviewBySCid(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
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
            $responses = $this->ReviewsServices->teacherAccessReviewBySCid_ser($re['SCid']);
            if ($responses == '已查閱'||$responses == '更改為未查閱') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
