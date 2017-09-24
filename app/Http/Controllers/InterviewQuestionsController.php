<?php

namespace App\Http\Controllers;


use App\Interviews_com_questions;
use App\Interviews_stu_questions;
use App\Services\QuestionsServices;
use Illuminate\Http\Request;
use Validator;

class InterviewQuestionsController extends Controller
{
    protected $QuestionsServices;

    public function __construct(QuestionsServices $QuestionsServices)
    {
        $this->middleware('admin');
        $this->QuestionsServices = $QuestionsServices;
    }

    //取得最新版本之學生訪談題目
    public function getInterviewsStuQuestions()
    {
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        if ($inSQ) {
            return response()->json(['InterviewsStuQuestionsList'=>$inSQ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(array('找不到題目'), 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得某版本之學生訪談題目
    public function getInterviewsStuQuestionsByVer(Request $request)
    {

        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insQuestionVer' => 'required|integer',
        ), array(
            'insQuestionVer.required' => '請輸入學生訪談題目版本號碼',
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
            $responses = $this->QuestionsServices->getInterviewsStuQuestionsByVer_ser($re['insQuestionVer']);
            if ($responses == '取得失敗') {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['InterviewsStuQuestionsList'=>$responses], 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得最新版本之廠商訪談題目
    public function getInterviewsComQuestions()
    {
        $inCQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($inCQ) {
            return response()->json($inCQ, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(array('找不到題目'), 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //取得某版本之廠商訪談題目
    public function getInterviewsComQuestionsByVer(Request $request)
    {

        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insCQuestionVer' => 'required|integer',
        ), array(
            'insCQuestionVer.required' => '請輸入廠商訪談題目版本號碼',
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
            $responses = $this->QuestionsServices->getInterviewsComQuestionsByVer_ser($re['insCQuestionVer']);
            if ($responses == '取得失敗') {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(['InterviewsComQuestionsList'=>$responses], 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //新增學生訪談題目
    public function createNewStuQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insQuestion' => 'required',
            'insAnswerType' => 'required|integer',
        ), array(
            'insQuestion.required' => '請輸入學生訪談題目',
            'insAnswerType.required' => '請輸入學生訪談題目答案類型',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->createNewStuQuestion_ser($re);
            if ($responses == '學生訪談題目新增成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //新增廠商訪談題目
    public function createNewComQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insCQuestion' => 'required',
            'insCAnswerType' => 'required',
        ), array(
            'insCQuestion.required' => '請輸入企業訪談題目',
            'insCAnswerType.required' => '請輸入企業訪談題目答案類型',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->createNewComQuestion_ser($re);
            if ($responses == '企業訪談題目新增成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //修改學生訪談題目
    public function editNewStuQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insQuestion' => 'required',//xxxxx,xxxxx,
            'insAnswerType' => 'required|',//1,0,
            'insQId' => 'required',//5,6,
        ), array(
            'insQuestion.required' => '請輸入學生訪談題目',
            'insQId.required' => '請輸入學生訪談題目ID',
            'insAnswerType.required' => '請輸入學生訪談題目答案類型',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->editNewStuQuestion_ser($re);
            if ($responses == '學生訪談題目修改成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //修改企業訪談題目
    public function editNewComQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insCQuestion' => 'required',
            'insCQId' => 'required',
            'insCAnswerType' => 'required',
        ), array(
            'insCQuestion.required' => '請輸入企業訪談題目',
            'insCQId.required' => '請輸入企業訪談題目ID',
            'insCAnswerType.required' => '請輸入企業訪談題目答案類型',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->editNewComQuestion_ser($re);
            if ($responses == '企業訪談題目修改成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //刪除企業訪談題目
    public function deleteComQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insCQId' => 'required|integer',
        ), array(
            'insCQId.required' => '請輸入企業訪談題目ID',
            'integer' => '請輸入int',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->editNewComQuestion_ser($re);
            if ($responses == '企業訪談題目刪除成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //刪除學生訪談題目
    public function deleteStuQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insQId' => 'required|integer',
        ), array(
            'insQId.required' => '請輸入學生訪談題目ID',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->deleteStuQuestion_ser($re);
            if ($responses == '刪除學生訪談題目成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
