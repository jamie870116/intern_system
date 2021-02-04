<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_jExp as stuJExpEloquent;

use App\Stu_works as stuWorksEloquent;
use App\Stu_ability as stuAbilityEloquent;
use App\Services\ResumeServices as ResumeServices;

use JWTAuth;
use Storage;
use Validator;


class Stu_resumeController extends Controller
{
    protected $ResumeServices;

    public function __construct(ResumeServices $ResumeServices)
    {
        $this->middleware('student',['except'=>'getResumeDataBySid']);
        $this->ResumeServices = $ResumeServices;
    }

    //新增履歷開始
    public function createJobExperienceById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'comName' => 'required',
            'jobTitle' => 'required'
        ), array(
            'comName.required' => '請輸入公司名稱',
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
            if ($responses != '新增工作資料失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    public function createWorksDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date',
            'wLink' => 'nullable'
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
            if ($responses != '新增作品資料失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
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
            'integer' => '請輸入integer'
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
            if ($responses != '新增能力資料失敗') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
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
        $stuBas = stuBasicEloquent::where('sid', $id)->first();
        $stuJExp = stuJExpEloquent::where('sid', $id)->get();
        $stuWor = stuWorksEloquent::where('sid', $id)->get();
        $stuA=stuAbilityEloquent::where('sid', $id)->get();
        $stdRe = array('stu_basic'=>$stuBas,'stu_jobExperience'=> $stuJExp,'stu_works'=> $stuWor,'stu_ability'=>$stuA);
        return response()->json($stdRe, 200, [], JSON_UNESCAPED_UNICODE);
    }
    //取得自己的履歷結束

    //取得學生履歷
    public function getResumeDataBySid(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'sid' => 'required|integer',
        ), array(
            'sid.required' => '請輸入sid',
            'integer' => '請輸入int'

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
            $user = JWTAuth::toUser($token);
            if($user->u_status!=0){
                $id = $re['sid'];
                $stuBas = stuBasicEloquent::where('sid', $id)->first();
                $stuJExp = stuJExpEloquent::where('sid', $id)->get();
                $stuWor = stuWorksEloquent::where('sid', $id)->get();
                $stuA=stuAbilityEloquent::where('sid', $id)->get();
                $stdRe = array('stu_basic'=>$stuBas,'stu_jobExperience'=> $stuJExp,'stu_works'=> $stuWor,'stu_ability'=>$stuA);
                return response()->json($stdRe, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(['你沒有權限觀看他人履歷'], 200, [], JSON_UNESCAPED_UNICODE);
            }

        }

    }

    //修改履歷開始
    public function editBasicDataById(Request $request)
    {

        $objValidator = Validator::make($request->all(), array(
            'chiName' => 'required',
            'engName' => 'required',
            'bornedPlace' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required|integer',//1，男生 2，女生
            'address' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'eTypes' => 'required|integer',//0，五專 1，二技 2，四技 3，研究所
            'ES' => 'required|integer',
            'ER' => 'required|integer',
            'EW' => 'required|integer',
            'TOEIC'=>'nullable|integer',
            'TOEFL'=>'nullable|integer',
            'Oname'=>'nullable', //第二外語名稱
            'OS'=>'nullable|integer',
            'OR'=>'nullable|integer',
            'OW'=>'nullable|integer',
            'graduateYear' => 'required|integer',
            'autobiography' => 'required',//自傳
            'graduatedSchool' => 'required',
            'department' => 'nullable',//系
            'section' => 'nullable',//科(高中高職等的科)
            'profilePic'=>'nullable|image',
            'licenceFile'=>'nullable'
        ), array(
            'chiName.required' => '請輸入中文姓名',
            'engName.required' => '請輸入英文姓名',
            'bornedPlace.required' => '請輸入出生地',
            'birthday.required' => '請輸入生日日期',
            'gender.required' => '請選擇性別',
            'email.required' => '請輸入電子信箱',
            'address.required' => '請輸入地址',
            'contact.required' => '請輸入連絡電話',
            'eTypes.required' => '請選擇目前學制',
            'ES.required' => '請選擇英語會話能力',
            'ER.required' => '請選擇英語閱讀能力',
            'EW.required' => '請選擇英語書寫能力',
            'graduateYear.required' => '請輸入畢業年',
            'autobiography.required' => '請輸入自傳',
            'graduatedSchool.required' => '請輸入畢業學校',
            'date' => '日期格式錯誤',
            'integer' => '請輸入數字',
            'email' => '信箱格式錯誤',
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)',
            'mimes'=>'檔案格式錯誤(副檔名須為pdf或docx)'
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
            $l_file=$request->file('licenceFile');
            $responses = $this->ResumeServices->editBasicDataById_ser($request,$file,$l_file);
            if ($responses == '修改基本資料成功') {
                $r=array($responses);
                return response()->json($r, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                $r=array($responses);
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
//學生上傳證照檔案
    public function studentUploadLicenceFile(Request $request){
        $objValidator = Validator::make($request->all(), array(
            'licenceFile'=>'required|mimes:docx,pdf,doc'
        ), array(
            'mimes'=>'檔案格式錯誤(副檔名須為pdf或docx)',
            'required'=>'請上傳圖片'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $file=$request->file('licenceFile');
            $responses = $this->ResumeServices->studentUploadLicenceFile_ser($request,$file);
            if ($responses == '頭貼上傳失敗') {
                $r=array($responses);
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }
    //學生上傳頭貼
    public function studentUploadProfilePic(Request $request){
        $objValidator = Validator::make($request->all(), array(
            'profilePic'=>'required|image'
        ), array(
            'image'=>'圖檔格式錯誤(副檔名須為jpg ,jpeg, png, bmp, gif, or svg)',
            'required'=>'請上傳圖片'
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
            $responses = $this->ResumeServices->studentUploadProfilePic_ser($request,$file);
            if ($responses == '頭貼上傳失敗') {
                $r=array($responses);
                return response()->json($r, 400, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    public function deleteJobExperienceById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'jid' => 'required|integer',
        ), array(
            'jid.required' => '請輸入jid',
            'integer' => '請輸入int'

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->deleteJobExperienceById_ser($re);
            if ($responses == '刪除工作資料成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    public function deleteWorksDataById(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'wid' => 'required|integer',
        ), array(
            'wid.required' => '請輸入wid',
            'integer' => '請輸入int'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->deleteWorksDataById_ser($re);
            if ($responses == '刪除作品資料成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }


    public function deleteAbilityById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'abiid' => 'required|integer',
        ), array(
            'abiid.required' => '請回傳能力ID',
            'integer' => '請輸入int'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->ResumeServices->deleteAbilityById_ser($re);
            if ($responses == '刪除能力資料成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //修改履歷結束

    //下載證照範例檔
    public function downloadLicenseFile(){
        $path = storage_path().'/'.'app/'.'public/user-upload/licences/example.docx';
//        $file_path = 'public/user-upload/licences/example.docx';
        $l_file=Storage::exists($path);

        if(file_exists($path)){
            $files = Storage::files('public/user-upload/licences');
            return response()->download($path);
        }else{
            return response()->json(array('下載失敗'), 400, [], JSON_UNESCAPED_UNICODE);
        }

    }
    //取得自己已投遞的履歷狀態

}
