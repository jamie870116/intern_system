<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_works as stuWorksEloquent;
use App\Stu_ability as stuAbilityEloquent;
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
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
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
            'agency' => 'required',
            'lname' => 'required',
            'ldate' => 'required|date'
        ), array(
            'ldate.required' => '請輸入發證日期',
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
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
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

    public function createAbilityById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'abiType' => 'required|integer',
            'abiName' => 'required'
        ), array(
            'abiType.required' => '請選擇能力種類',
            'abiName.required' => '請描述該能力',
            'integer' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->newAbilityById($re);
            if ($responses == '新增能力資料成功') {
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
        $stuA=stuAbilityEloquent::where('sid', $id)->get();
        $stdRe = array($stuBas, $stuJExp, $stuLic, $stuWor,$stuA);
        return response()->json($stdRe, 200, [], JSON_UNESCAPED_UNICODE);
    }
    //取得自己的履歷結束

    //修改履歷開始
    public function editBasicDataById(Request $request)
    {

        $objValidator = Validator::make($request->all(), array(
            'chiName' => 'required',
            'engName' => 'required',
            'bornedPlace' => 'required',
            'nativePlace' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required|integer',//1，男生 2，女生
            'address' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'ES' => 'required|integer',
            'ER' => 'required|integer',
            'EW' => 'required|integer',
            'TOEIC'=>'nullable|integer',
            'TOEFL'=>'nullable|integer',
            'Oname'=>'nullable', //第二外語名稱
            'OS'=>'nullable|integer',
            'OR'=>'nullable|integer',
            'OW'=>'nullable|integer',
            'eduSystem' => 'required|integer',//學制
            'graduateYear' => 'required',
            'autobiography' => 'required',//自傳
            'graduatedSchool' => 'required',
            'department' => 'nullable',//系
            'section' => 'nullable',//科(高中高職等的科)
            'profilePic'=>'nullable|image',
        ), array(
            'chiName.required' => '請輸入中文姓名',
            'engName.required' => '請輸入英文姓名',
            'bornedPlace.required' => '請輸入出生地',
            'nativePlace.required' => '請輸入籍貫',
            'birthday.required' => '請輸入生日日期',
            'gender.required' => '請選擇性別',
            'email.required' => '請輸入電子信箱',
            'address.required' => '請輸入地址',
            'contact.required' => '請輸入連絡電話',
            'ES.required' => '請選擇英語會話能力',
            'ER.required' => '請選擇英語閱讀能力',
            'EW.required' => '請選擇英語書寫能力',
            'eduSystem.required' => '請選擇學制',
            'graduateYear.required' => '請輸入畢業年',
            'autobiography.required' => '請輸入自傳',
            'graduatedSchool.required' => '請輸入畢業學校',
            'date' => '日期格式錯誤',
            'integer' => '請輸入數字',
            'email' => '信箱格式錯誤',
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)'
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
            $responses = $this->ResumeServices->editBasicDataById_ser($request,$file);
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
            'wCreatedDate' => 'nullable|date',
            'wLink' => 'nullable|date',

        ), array(
            'wName.required' => '請輸入作品名稱',
            'wid.required' => '請輸入wid',
            'wLink.required' => '請輸入作品網址',
            'wCreatedDate.required' => '請輸入作品完成日期',
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


    public function editAbilityById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'abiType' => 'required|integer',
            'abiid' => 'required|integer',
            'abiName' => 'required'
        ), array(
            'abiType.required' => '請選擇能力種類',
            'abiid.required' => '請回傳能力ID',
            'abiName.required' => '請描述該能力',
            'integer' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->editAbilityById_ser($re);
            if ($responses == '修改能力資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //修改履歷結束
}
