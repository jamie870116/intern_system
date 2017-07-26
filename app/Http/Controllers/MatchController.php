<?php

namespace App\Http\Controllers;

use App\Job_opening;
use App\Services\MatchServices;

use Illuminate\Http\Request;

use App\Match as MatchEloquent;
use App\Stu_basic as stuBasicEloquent;
use App\Stu_edu as stuEduEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_relatives as stuRelativesEloquent;
use App\Stu_works as stuWorksEloquent;
use App\User as UserElopuent;
use JWTAuth;
use Validator;

class MatchController extends Controller
{
    protected $MatchServices;

    public function __construct(MatchServices $MatchServices)
    {
        $this->middleware('company', ['only' => 'companyGetResumeByAccount', 'companyRejectResume', 'companyAcceptResume',
            'companyGetJobOpeningContactByMid', 'companySendInterviewNotice', 'companyFailedInterview','companyPassInterview']);
        $this->middleware('student', ['only' => 'studentSubmitResume', 'studentAcceptInterview', 'studentAcceptJob']);
        $this->middleware('admin', ['only' => 'adminGetSuccessMatch', 'adminGetTeacherData', 'adminFillInTeacher']);
        $this->MatchServices = $MatchServices;
    }

    //投遞履歷resume
    public function studentSubmitResume(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'joid' => 'required|integer'
        ), array(
            'joid.required' => '請輸入職缺ID',
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
            $responses = $this->MatchServices->studentSubmitResume_ser($re);
            if ($responses == '學生送出媒合資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }


    }

    //廠商取得投遞的履歷
    public function companyGetResumeByAccount()
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $match = MatchEloquent::where('c_account', $user->account)->get();
        if ($match) {
            $response = array();
            foreach ($match as $m) {
                $id = $m->sid;
                $mid = $m->mid;
                $stuBas = stuBasicEloquent::where('sid', $id)->get();
                $stuEdu = stuEduEloquent::where('sid', $id)->get();
                $stuJExp = stuJExpEloquent::where('sid', $id)->get();
                $stuLic = stulicenceEloquent::where('sid', $id)->get();
                $stuRel = stuRelativesEloquent::where('sid', $id)->get();
                $stuWor = stuWorksEloquent::where('sid', $id)->get();
                $stdRe = array($mid, $stuBas, $stuEdu, $stuJExp, $stuLic, $stuRel, $stuWor);
                $response[] = $stdRe;
            }

            return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //廠商回應履歷-拒絕
    public function companyRejectResume(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
            'mfailedreason' => 'nullable'
        ), array(
            'mid.required' => '請輸入媒合ID',
            'mid.integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companyRejectResume_ser($re);
            if ($responses == '廠商拒絕媒合成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //廠商回應履歷-接受
    public function companyAcceptResume(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
            'mstatus' => 'required|integer' //傳入1==去面試，其他是直接接受
        ), array(
            'mid.required' => '請輸入媒合ID',
            'mstatus.required' => '請回傳1，讓他來面試或回傳2直接接受',
            'integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companyAcceptResume_ser($re);
            if ($responses == '廠商直接錄取成功' || $responses == '廠商接受面試成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //取得廠商聯絡資訊
    public function companyGetJobOpeningContactByMid(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
        ), array(
            'mid.required' => '請輸入媒合ID',
            'integer' => '請輸入int格式',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $match = MatchEloquent::where('mid', $re['mid'])->first();
            if ($match) {
                $joid = $match->joid;
                $jo = Job_opening::where('joid', $joid)->first();
                $contact = array($jo->jcontact_name, $jo->jcontact_phone, $jo->jcontact_email);
                return response()->json($contact, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //面試通知
    public function companySendInterviewNotice(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',
            'inadress' => 'required',
            'intime' => 'required|date',
            'jcontact_email' => 'required|email',
            'jcontact_phone' => 'required',
            'innotice' => 'required',
            'jcontact_name' => 'required'
        ), array(
            'mid.required' => '請輸入媒合ID',
            'inadress.required' => '請輸入面試地點',
            'intime.required' => '請輸入面試時間',
            'jcontact_email.required' => '請輸入聯絡信箱',
            'jcontact_phone.required' => '請輸入連絡電話',
            'innotice.required' => '請填寫面試注意事項',
            'jcontact_name.required' => '請輸入聯絡人姓名',
            'integer' => 'int格式錯誤',
            'date' => '日期時間格式錯誤',
            'email' => '信箱格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companySendInterviewNotice_ser($re);
            if ($responses == '成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //學生是否接受面試
    public function studentAcceptInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',
            'mstatus' => 'required|integer',

        ), array(
            'mid.required' => '請輸入媒合ID',
            'mstatus.required' => '請回傳1，去面試或回傳2拒絕', //傳入1==去面試，其他是拒絕
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
            $responses = $this->MatchServices->studentAcceptJob_ser($re);
            if ($responses == '接受面試成功' || $responses == '拒絕面試成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //面試失敗
    public function companyFailedInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required|integer',
            'mfailedreason' => 'nullable'
        ), array(
            'mid.required' => '請輸入媒合ID',
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
            $responses = $this->MatchServices->companyFailedInterview_ser($re);
            if ($responses == '廠商通知學生未綠取成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //面試成功
    public function companyPassInterview(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',

        ), array(
            'mid.required' => '請輸入媒合ID',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->MatchServices->companyPassInterview_ser($re);
            if ($responses == '廠商通知學生綠取成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //學生是否接受入職
    public function studentAcceptJob(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',
            'mstatus' => 'required|integer',

        ), array(
            'mid.required' => '請輸入媒合ID',
            'mstatus.required' => '請回傳1，接受或回傳2拒絕', //傳入1==去面試，其他是拒絕
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
            $responses = $this->MatchServices->studentAcceptJob_ser($re);
            if ($responses == '接受工作成功' || $responses == '拒絕工作成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    //系辦取得已成功的媒合資料
    public function adminGetSuccessMatch()
    {
        $match = MatchEloquent::where('mstatus', 9)->SortByUpdates_DESC()->paginate(4);
        if ($match) {
            return response()->json($match, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //系辦取得所有老師資訊
    public function adminGetTeacherData()
    {
        $user = UserElopuent::where('u_status', 1)->get();
        if ($user) {
            return response()->json($user, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json('取得資料失敗', 400, [], JSON_UNESCAPED_UNICODE);
        }
    }

    //系辦選擇實習老師
    public function adminFillInTeacher(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'mid' => 'required',
            'id' => 'required|integer',

        ), array(
            'mid.required' => '請輸入媒合ID',
            'id.required' => '請回傳老師ID', //傳入1==去面試，其他是拒絕
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
            $responses = $this->MatchServices->adminFillInTeacher_ser($re);
            if ($responses == '選擇實習老師成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
