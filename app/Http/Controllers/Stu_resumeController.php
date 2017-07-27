<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_works as stuWorksEloquent;
use App\Services\ResumeServices as ResumeServices;

use JWTAuth;
use Validator;


class Stu_resumeController extends Controller
{
    protected $ResumeServices;

    public function __construct(ResumeServices $ResumeServices)
    {
        $this->middleware('student');
        $this->ResumeServices = $ResumeServices;
    }

    //新增履歷開始

    public function createJobExperienceById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required',
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'id.required' => '請輸入學生ID',
            'semester.required' => '請輸入學期',
            'jobTitle.required' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->newJobExperienceById($re);
            if ($responses == '新增工作資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createLicenseById(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'id' => 'required',
            'agency' => 'required',
            'lname' => 'required',
            'ldate' => 'required|date'
        ), array(
            'ldate.required' => '請輸入發證日期',
            'id.required' => '請輸入學生ID',
            'agency.required' => '請輸入發照單位',
            'lname.required' => '請輸入證照名稱',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->newLicenseById($re);
            if ($responses == '新增證照資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createWorksDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id' => 'required',
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'id.required' => '請輸入學生ID',
            'wName.required' => '請輸入作品名稱',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->newWorksDataById($re);
            if ($responses == '新增作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //新增履歷結束

    //取得自己的履歷開始
    public function findResumeDataById()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $stuBas = stuBasicEloquent::where('sid', $id)->get();
        $stuJExp = stuJExpEloquent::where('sid', $id)->get();
        $stuLic = stulicenceEloquent::where('sid', $id)->get();
        $stuWor = stuWorksEloquent::where('sid', $id)->get();
        $stdRe = array($stuBas, $stuJExp, $stuLic, $stuWor);
        return response()->json(['stdRe' => $stdRe], 200, [], JSON_UNESCAPED_UNICODE);
    }
    //取得自己的履歷結束

    //修改履歷開始
    public function editBasicDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'chiName' => 'required',
            'engName' => 'required',
            'bornedPlace' => 'required',
            'nativePlace' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'ES' => 'required|integer',
            'ER' => 'required|integer',
            'EW' => 'required|integer',
            'TOEIC'=>'nullable|integer',
            'TOEFL'=>'nullable|integer',
            'Oname'=>'nullable',
            'OS'=>'nullable',
            'OR'=>'nullable',
            'OW'=>'nullable',
            'eduSystem' => 'required',
            'graduateYear' => 'required',
            'autobiography' => 'required',
            'graduatedSchool' => 'required',
            'department' => 'nullable',
            'section' => 'nullable',
        ), array(
            'chiName.required' => '請輸入中文姓名',
            'engName.required' => '請輸入英文姓名',
            'bornedPlace.required' => '請輸入出生地',
            'nativePlace.required' => '請輸入籍貫',
            'birthday.required' => '請輸入生日日期',
            'gender.required' => '請選擇性別',
            'email.required' => '請輸入電子信箱',
            'contact.required' => '請輸入連絡電話',
            'ES.required' => '請輸入英語會話能力',
            'ER.required' => '請輸入英語閱讀能力',
            'EW.required' => '請輸入英語書寫能力',
            'eduSystem.required' => '請輸入學制',
            'graduateYear.required' => '請輸入畢業年',
            'autobiography.required' => '請輸入自傳',
            'graduatedSchool.required' => '請輸入畢業學校',
            'date' => '日期格式錯誤',
            'integer' => '請輸入數字',
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
            $responses = $this->ResumeServices->editBasicDataById_ser($re);
            if ($responses == '修改基本資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }


    }


    public function editJobExperienceById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jid' => 'required',
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'jid.required' => '請輸入jid',
            'semester.required' => '請輸入學期',
            'jobTitle.required' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->editJobExperienceById_ser($re);
            if ($responses == '修改工作資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editLicenseById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'lid' => 'required',
            'agency' => 'required',
            'lname' => 'required',
            'ldate' => 'required|date'
        ), array(
            'ldate.required' => '請輸入發證日期',
            'lid.required' => '請輸入lid',
            'agency.required' => '請輸入發照單位',
            'lname.required' => '請輸入證照名稱',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->editLicenseById_ser($re);
            if ($responses == '修改證照資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    public function editWorksDataById(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'wid' => 'required',
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->editWorksDataById_ser($re);
            if ($responses == '修改作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //修改履歷結束
}
