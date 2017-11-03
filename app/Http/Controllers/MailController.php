<?php

namespace App\Http\Controllers;

use App\Match;
use App\SendMailBC;
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

        $mail=Station_Letter::where('lRecipient',$users->account)->SortByUpdates_DESC()->paginate(12);
        foreach ($mail as $m){
            if($m->read==0){
                $m->read=false;
            }else{
                $m->read=true;
            }
            if($m->favourite==0){
                $m->favourite=false;
            }else{
                $m->favourite=true;
            }
            $ms=$m->lStatus;
            if($m->lNotes!=null){
                $mid=(int)$m->lNotes;
                $match=Match::where('mid',$mid)->first();
                if($match){
                    if($match->mstatus==$ms){
                        $m->expired=false;
                    }else{
                        $m->expired=true;
                    }
                }

            }else{
                $m->expired=false;
            }
        }
        if($mail){
            return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得送件
    public function getSentMailByToken(){
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=SendMailBC::where('lSender',$users->account)->SortByUpdates_DESC()->paginate(12);
         foreach ($mail as $m){
             $m->read=true;
            $m->favourite=false;
        }

        if($mail){
            return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
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

    //寄信-學生對廠商
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
            $token = JWTAuth::getToken();
            $users = JWTAuth::toUser($token);
            $mail=Station_Letter::where('slId',$re['slId'])->first();

            if($mail->lSender==$users->account||$mail->lRecipient==$users->account){
                $mail->read=true;
                $mail->save();

                $mail->read=true;
                if($mail->favourite==0){
                    $mail->favourite=false;
                }else{
                    $mail->favourite=true;
                }
                if ($mail) {
                    return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
                } else {
                    return response()->json(['查無此信件資料'], 400, [], JSON_UNESCAPED_UNICODE);
                }
            }else{
                return response()->json(['這不是你的信'], 400, [], JSON_UNESCAPED_UNICODE);
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
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //刪除寄件備份之信件-硬刪除
    public function sendMailDeleted(Request $request)
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
            $responses = $this->MailServices->sendMailDeleted_ser($re['slId']);
            if ($responses == '刪除信件成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得回收信件
    public function getTrashFolder()
    {
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=Station_Letter::onlyTrashed()->where('lRecipient',$users->account)->paginate(12);
         foreach ($mail as $m){
            if($m->read==0){
                $m->read=false;
            }else{
                $m->read=true;
            }
            if($m->favourite==0){
                $m->favourite=false;
            }else{
                $m->favourite=true;
            }
        }
        if($mail){
            return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
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
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
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
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
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
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得我的最愛
    public function getFavouriteFolder()
    {
        $token = JWTAuth::getToken();
        $users = JWTAuth::toUser($token);

        $mail=Station_Letter::where('lRecipient',$users->account)->where('favourite',true)->orWhere('lSender',$users->account)->where('favourite',true)->paginate(12);
        foreach ($mail as $m){
            if($m->read==0){
                $m->read=false;
            }else{
                $m->read=true;
            }
            if($m->favourite==0){
                $m->favourite=false;
            }else{
                $m->favourite=true;
            }
        }
        if($mail){
            return response()->json($mail, 200, [], JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['取得失敗'], 400, [], JSON_UNESCAPED_UNICODE);
        }
    }



}
