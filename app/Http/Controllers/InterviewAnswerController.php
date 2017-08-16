<?php

namespace App\Http\Controllers;

use App\Services\InterviewAnswerServices;
use Illuminate\Http\Request;
use Validator;

class InterviewAnswerController extends Controller
{
    protected $InterviewAnswerServices;

    public function __construct(InterviewAnswerServices $InterviewAnswerServices)
    {
        $this->middleware('teacher');
        $this->InterviewAnswerServices = $InterviewAnswerServices;
    }

    //老師輸入對企業問卷
    public function teacherCreateComInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|unique:interview_com,SCid',
            'insCDate' => 'required|date',
            'insCNum' => 'required|integer',
            'insComName' => 'required',
            'insComTel' => 'required',
            'insAddress' => 'required',
            'insCVisitWay' => 'required|integer',
            'insCAns' => 'required',
            'insCQuestionVer' => 'required|integer',
            'insCComments' => 'required',
        ), array(
            'SCid.required' => '請輸入關聯的鍵值(SCid)',
            'insCDate.required' => '請輸入訪談日期',
            'insCNum.required' => '請輸入進用人數',
            'insComName.required' => '請輸入公司名稱',
            'insComTel.required' => '請輸入公司電話',
            'insAddress.required' => '請輸入公司住址',
            'insCVisitWay.required' => '請輸入訪談方式',
            'insCAns.required' => '請輸入訪談答案',
            'insCQuestionVer.required' => '請輸入訪談問卷版本',
            'insCComments.required' => '請輸入綜合評語',
            'date' => '請輸入日期',
            'integer' => '請輸入integer',
            'unique' => '已訪談過',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->InterviewAnswerServices->teacherCreateComInterview_ser($re);
            if ($responses == '訪談紀錄新增成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    //老師修改對企業問卷
    public function teacherEditComInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required',
            'insCId' => 'required',
            'insCDate' => 'required|date',
            'insCNum' => 'required|integer',
            'insComName' => 'required',
            'insComTel' => 'required',
            'insAddress' => 'required',
            'insCVisitWay' => 'required|integer',
            'insCAns' => 'required',
            'insCQuestionVer' => 'required|integer',
            'insCComments' => 'required',
        ), array(
            'SCid.required' => '請輸入關聯的鍵值(SCid)',
            'insCId.required' => '請輸入問卷的鍵值(insCId)',
            'insCDate.required' => '請輸入訪談日期',
            'insCNum.required' => '請輸入進用人數',
            'insComName.required' => '請輸入公司名稱',
            'insComTel.required' => '請輸入公司名稱',
            'insAddress.required' => '請輸入公司住址',
            'insCVisitWay.required' => '請輸入訪談方式',
            'insCAns.required' => '請輸入訪談答案',
            'insCQuestionVer.required' => '請輸入訪談問卷版本',
            'insCComments.required' => '請輸入綜合評語',
            'date' => '請輸入日期',
            'integer' => '請輸入integer',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->InterviewAnswerServices->teacherEditComInterview_ser($re);
            if ($responses == '訪談紀錄修改成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //老師輸入對學生問卷
    public function teacherCreateStuInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|unique:interview_com,SCid',
            'insDate' => 'required|date',
            'insNum' => 'required|integer',
            'insStuName' => 'required',
            'insStuClass' => 'required',
            'insAddress' => 'required',
            'insVisitWay' => 'required|integer',
            'insAns' => 'required',
            'insQuestionVer' => 'required|integer',
            'insComments' => 'required',
        ), array(
            'SCid.required' => '請輸入關聯的鍵值(SCid)',
            'insDate.required' => '請輸入訪談日期',
            'insNum.required' => '請輸入進用人數',
            'insStuName.required' => '請輸入學生名稱',
            'insStuClass.required' => '請輸入學生班級',
            'insAddress.required' => '請輸入實習地住址',
            'insVisitWay.required' => '請輸入訪談方式',
            'insAns.required' => '請輸入訪談答案',
            'insQuestionVer.required' => '請輸入訪談問卷版本',
            'insComments.required' => '請輸入綜合評語',
            'date' => '請輸入日期',
            'integer' => '請輸入integer',
            'unique' => '已訪談過',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->InterviewAnswerServices->teacherCreateStuInterview_ser($re);
            if ($responses == '訪談紀錄新增成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    //老師輸入對企業問卷
    public function teacherEditStuInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insId' => 'required',
            'SCid' => 'required|unique:interview_com,SCid',
            'insDate' => 'required|date',
            'insNum' => 'required|integer',
            'insStuName' => 'required',
            'insStuClass' => 'required',
            'insAddress' => 'required',
            'insVisitWay' => 'required|integer',
            'insAns' => 'required',
            'insQuestionVer' => 'required|integer',
            'insComments' => 'required',
        ), array(
            'SCid.required' => '請輸入關聯的鍵值(SCid)',
            'insDate.required' => '請輸入訪談日期',
            'insNum.required' => '請輸入進用人數',
            'insStuName.required' => '請輸入學生名稱',
            'insStuClass.required' => '請輸入學生班級',
            'insAddress.required' => '請輸入實習地住址',
            'insVisitWay.required' => '請輸入訪談方式',
            'insAns.required' => '請輸入訪談答案',
            'insQuestionVer.required' => '請輸入訪談問卷版本',
            'insComments.required' => '請輸入綜合評語',
            'date' => '請輸入日期',
            'integer' => '請輸入integer',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->InterviewAnswerServices->teacherEditStuInterview_ser($re);
            if ($responses == '訪談紀錄修改成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}