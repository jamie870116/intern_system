<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_edu as stuEduEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_relatives as stuRelativesEloquent;
use App\Stu_works as stuWorksEloquent;

use App\Services\ResumeServices as ResumeServices;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
    public function createEduDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id'=>'required',
            'school' => 'required',
            'department' => 'required',
            'enterDate' => 'required|date',
            'exitDate' => 'nullable|date',
            'graduate' => 'required|integer'
        ), array(
            'id.required' => '請輸入學生ID',
            'school.required' => '請輸入學校名稱',
            'department.required' => '請輸入科系名稱',
            'enterDate.required' => '請輸入入學日期',
            'graduate.required' => '請選擇就讀狀態',
            'date' => '日期格式錯誤',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->newEduDataById($re);
            if ($responses == '新增學歷資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createJobExperienceById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id'=>'required',
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'id.required' => '請輸入學生ID',
            'semester.required' => '請輸入學期',
            'jobTitle.required' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
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
            'id'=>'required',
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
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
            'id'=>'required',
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'id.required' => '請輸入學生ID',
            'wName.required' => '請輸入作品名稱',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->newWorksDataById($re);
            if ($responses == '新增作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createRelativeDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id'=>'required',
            'rType' => 'required',
            'rName' => 'required'
        ), array(
            'id.required' => '請輸入學生ID',
            'rType.required' => '請選擇親屬關係',
            'rName.required' => '請輸入親屬姓名',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->newRelativeDataById($re);
            if ($responses == '新增親屬資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //新增履歷結束

    //取得履歷開始
    public function findResumeDataById(Request $request)
    {
        $re=$request->all();
        $id=$re['id'];
        $stuBas = stuBasicEloquent::where('sid', $id)->get();
        $stuEdu = stuEduEloquent::where('sid', $id)->get();
        $stuJExp = stuJExpEloquent::where('sid', $id)->get();
        $stuLic = stulicenceEloquent::where('sid', $id)->get();
        $stuRel = stuRelativesEloquent::where('sid', $id)->get();
        $stuWor = stuWorksEloquent::where('sid', $id)->get();
        $stdRe = array($stuBas, $stuEdu, $stuJExp, $stuLic, $stuRel, $stuWor);
        return response()->json(['stdRe' => $stdRe], 200, [], JSON_UNESCAPED_UNICODE);
    }
    //取得履歷結束
    //
    //修改履歷開始
    public function editBasicDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'id'=>'required',
            'chiName' => 'required',
            'engName' => 'required',
            'bornedPlace' => 'required',
            'nativePlace' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'bloodtype' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
        ), array(
            'id.required' => '請輸入學生ID',
            'chiName.required' => '請輸入中文姓名',
            'engName.required' => '請輸入英文姓名',
            'bornedPlace.required' => '請輸入出生地',
            'nativePlace.required' => '請輸入籍貫',
            'birthday.required' => '請輸入生日日期',
            'gender.required' => '請選擇性別',
            'height.required' => '請輸入身高(公分)',
            'weight.required' => '請輸入體重(公分)',
            'bloodtype.required' => '請選擇血型',
            'email.required' => '請輸入電子信箱',
            'contact.required' => '請輸入連絡電話',
            'date' => '日期格式錯誤',
            'email' => '信箱格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editBasicDataById_ser($re);
            if ($responses == '修改基本資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editEduDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'edu_id'=>'required',
            'school' => 'required',
            'department' => 'required',
            'enterDate' => 'required|date',
            'exitDate' => 'nullable|date',
            'graduate' => 'required'
        ), array(
            'edu_id.required' => '請輸入edu_id',
            'school.required' => '請輸入學校名稱',
            'department.required' => '請輸入科系名稱',
            'enterDate.required' => '請輸入入學日期',
            'graduate.required' => '請選擇就讀狀態',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editEduDataById_ser($re);
            if ($responses == '修改學歷資料成功') {
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
            'jid'=>'required',
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'jid.required' => '請輸入jid',
            'semester.required' => '請輸入學期',
            'jobTitle.required' => '請輸入職位名稱'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
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
            'lid'=>'required',
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
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editLicenseById_ser($re);
            if ($responses == '修改證照資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editLanguageById(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'id'=>'required',
            'cl' => 'required|integer',
            'cs' => 'required|integer',
            'cw' => 'required|integer',
            'cr' => 'required|integer',
            'el' => 'required|integer',
            'es' => 'required|integer',
            'ew' => 'required|integer',
            'er' => 'required|integer',
            'tl' => 'required|integer',
            'ts' => 'required|integer',
        ), array(
            'id.required' => '請輸入學生ID',
            'cl.required' => '請選擇中聽能力',
            'cs.required' => '請選擇中說能力',
            'cw.required' => '請選擇中寫能力',
            'cr.required' => '請選擇中讀能力',
            'el.required' => '請選擇英聽能力',
            'es.required' => '請選擇英說能力',
            'ew.required' => '請選擇英寫能力',
            'er.required' => '請選擇英讀能力',
            'tl.required' => '請選擇台聽能力',
            'ts.required' => '請選擇台說能力',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editLanguageById_ser($re);
            if ($responses == '修改語言能力成功') {
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
            'id'=>'required',
//            'dataBase' => 'required',
//            'programmingLanguage' => 'required',
//            'document' => 'required',
//            'webDesign' => 'requiredr',
//            'imageProcessing' => 'required',
//            'drawingSoftware' => 'required',
//            'animation' => 'required',
//            'OS' => 'required',
//            'musicEditor' => 'required',

        ), array(
            'id.required' => '請輸入學生ID',
//            'dataBase.required' => '請輸入學生ID',
//            'programmingLanguage.required' => '請輸入學生ID',
//            'document.required' => '請輸入學生ID',
//            'webDesign.required' => '請輸入學生ID',
//            'imageProcessing.required' => '請輸入學生ID',
//            'drawingSoftware.required' => '請輸入學生ID',
//            'animation.required' => '請輸入學生ID',
//            'OS.required' => '請輸入學生ID',
//            'musicEditor.required' => '請輸入學生ID',
//            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editAbilityById_ser($re);
            if ($responses == '修改電腦技術資料成功') {
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
            'wid'=>'required',
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editWorksDataById_ser($re);
            if ($responses == '修改作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editRelativeDataById(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'rid'=>'required',
            'rType' => 'required',
            'rName' => 'required'
        ), array(
            'rid.required' => '請輸入rid',
            'wName.required' => '請輸入作品名稱',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses = $this->ResumeServices->editRelativeDataById_ser($re);
            if ($responses == '修改親屬資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //修改履歷結束
}
