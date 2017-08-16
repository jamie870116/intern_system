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
            return $inSQ;
        } else {
            return array('找不到題目');
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
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得最新版本之廠商訪談題目
    public function getInterviewsComQuestions()
    {
        $inCQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($inCQ) {
            return $inCQ;
        } else {
            return array('找不到題目');
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
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //新增學生訪談題目
    public function createNewStuQuestion(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'insQuestion' => 'required',
        ), array(
            'insQuestion.required' => '請輸入學生訪談題目',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->createNewStuQuestion_ser($re['insQuestion']);
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
        ), array(
            'insCQuestion.required' => '請輸入企業訪談題目',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->QuestionsServices->createNewComQuestion_ser($re['insCQuestion']);
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
            'insQuestion' => 'required',
            'insQId' => 'required',
        ), array(
            'insQuestion.required' => '請輸入學生訪談題目',
            'insQId.required' => '請輸入學生訪談題目ID',

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
        ), array(
            'insCQuestion.required' => '請輸入企業訪談題目',
            'insCQId.required' => '請輸入企業訪談題目ID',

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
}