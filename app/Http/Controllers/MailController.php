<?php

namespace App\Http\Controllers;

use App\Services\MailServices;
use App\Station_Letter;
use Illuminate\Http\Request;

use JWTAuth;

use Validator;

class MailController extends Controller
{
    protected $MailServices;

    public function __construct(MailServices $MailServices)
    {
//        $this->middleware('company', ['only' => 'getMailTitleByC_account']);
        $this->middleware('student', ['only' => 'sendMail']);
//        $this->middleware('admin', ['only' => 'adminGetSuccessMatch', 'adminGetTeacherData', 'adminFillInTeacher']);
        $this->MailServices = $MailServices;
    }

    //取得信件(收件)
    public function getMailByToken()
    {
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=Station_Letter::where('lRecipient',$users->account)->SortByUpdates_DESC()->get();
        if($mail){
            return response()->json(['MailList'=>$mail], 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json('', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得送件
    public function getSentMailByToken(){
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=Station_Letter::where('lSender',$users->account)->SortByUpdates_DESC()->get();
        if($mail){
            return response()->json(['SentMailList'=>$mail], 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json('', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //關鍵字用以查詢廠商名稱或帳號
    public function getCompanyByNameOrAccount(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'comp' => 'required',

        ), array(
            'comp.required' => '請輸入關鍵字用以查詢廠商名稱或帳號',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $keyword = '%' . $re['comp'] . '%';
            $responses = $this->MailServices->getCompanyByNameOrAccount_ser($keyword);
            $r=array($responses);
            if ($responses == '送出信件成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //寄信
    public function sendMail(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'lRecipient' => 'required',
            'lTitle' => 'required',
            'lContent' => 'required',

        ), array(
            'lRecipient.required' => '請輸入收件人帳號',
            'lTitle.required' => '請輸入標題',
            'lContent.required' => '請輸入內容',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->sendMail_ser($re);
            $r=array($responses);
            if ($responses == '送出信件成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //回覆信件
    public function replyMailById(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required',
            'lContent' => 'required',

        ), array(
            'slId.required' => '請輸入欲回覆之信件ID',
            'lContent.required' => '請輸入內容',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->replyMailById_ser($re);
            $r=array($responses);
            if ($responses == '回覆信件成功') {
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
//    //取得學生信件
//    public function getMailTitleBySid()
//    {
//
//            $token = JWTAuth::getToken();
//            $users = JWTAuth::toUser($token);
//            $match = MatchEloquent::where('sid', $users->id)->get();
//
//
//            if (!$match) {
//                return response()->json('取得媒合資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//            }else{
//                $response = array();
//                $stu_name = $users->u_name;
//
//                foreach ($match as $m) {
//                    $com = UserEloquent::where('account', $m->c_account)->first();
//                    if (!$com) {
//                        return response()->json('取得廠商資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                    }
//                    $com_name = $com->u_name;
//                    $logs = MatchLogEloquent::where('mid', $m->mid)->whereIn('mstatus', array(2, 3, 6, 7, 8, 11))->SortByUpdates_DESC()->get();
//                    if (!$match) {
//                        return response()->json('取得信件內容錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                    }
//                    $job = JopOpEloquent::where('joid', $m->joid)->first();
//                    if (!$match) {
//                        return response()->json('取得該職缺資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                    }
//                    foreach ($logs as $log) {
//                        $mailData = array($stu_name, $com_name, $log, $job);
//                        $response[] = $mailData;
//                    }
//                }
//                return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
//            }
//
//
//        }


//    //取得企業信件
//    public function getMailTitleByC_account()
//    {
//
//        $token = JWTAuth::getToken();
//        $users = JWTAuth::toUser($token);
//
//
//        if ($users) {
//            $match = MatchEloquent::where('c_account', $users->account)->get();
//
//            if (!$match) {
//                return response()->json('取得媒合資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//            }
//            $response = array();
//            $com_name = $users->u_name;
//
//            foreach ($match as $m) {
//                $stu = UserEloquent::where('id', $m->sid)->first();
//                if (!$stu) {
//                    return response()->json('取得廠商資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                }
//                $stu_name = $stu->u_name;
//                $logs = MatchLogEloquent::where('mid', $m->mid)->whereIn('mstatus', array(1, 4, 5, 9, 10, 11))->SortByUpdates_DESC()->get();
//                if (!$match) {
//                    return response()->json('取得信件內容錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                }
//                $job = JopOpEloquent::where('joid', $m->joid)->first();
//                if (!$match) {
//                    return response()->json('取得該職缺資料錯誤', 400, [], JSON_UNESCAPED_UNICODE);
//                }
//                foreach ($logs as $log) {
//                    $mailData = array($com_name, $stu_name, $log, $job);
//                    $response[] = $mailData;
//                }
//            }
//            return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
//
//        } else {
//            return response()->json('error', 400);
//        }
//    }

    //已讀信件
    public function getMailDetails(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required|integer'
        ), array(
            'slId.required' => '請輸入信件ID',
            'slId.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $mail=Station_Letter::where('slId',$re['slId'])->first();

            if ($mail) {
                return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['查無此信件資料'], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //刪除信件
    public function mailDeleted(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required|integer'
        ), array(
            'slId.required' => '請輸入信件ID',
            'slId.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->mailDeleted_ser($re['slId']);
            if ($responses == '刪除信件成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得回收信件
    public function getTrashFolder()
    {
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=Station_Letter::onlyTrashed()->where('lRecipient',$users->account)->orWhere('lSender',$users->account)->get();
        if($mail){
            return response()->json(['MailList'=>$mail], 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json('', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //永久刪除信件
    public function mailForceDeleted(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required|integer'
        ), array(
            'slId.required' => '請輸入信件ID',
            'slId.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->mailForceDeleted_ser($re['slId']);
            if ($responses == '永久刪除信件成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //回復刪除信件
    public function mailRestoreDeleted(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required|integer'
        ), array(
            'slId.required' => '請輸入信件ID',
            'slId.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->mailRestoreDeleted_ser($re['slId']);
            if ($responses == '回復刪除信件成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //加信件到最愛
    public function favouriteMail(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'slId' => 'required|integer'
        ), array(
            'slId.required' => '請輸入信件ID',
            'slId.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MailServices->favouriteMail_ser($re['slId']);
            if ($responses != '查無此信件資料') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
