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
    public function createEduDataById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'school' => 'required',
            'department' => 'required',
            'enterDate' => 'required|date',
            'exitDate' => 'nullable|date',
            'graduate' => 'required|integer'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->newEduDataById($re, $id);
            if ($responses == '新增學歷資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createJobExperienceById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'required' => '此欄位不可為空白'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->newJobExperienceById($re, $id);
            if ($responses == '新增工作資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createLicenseById(Request $request, $id)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'agency' => 'required',
            'lname' => 'required',
            'ldate' => 'required|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->newLicenseById($re, $id);
            if ($responses == '新增證照資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createWorksDataById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->newWorksDataById($re, $id);
            if ($responses == '新增作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function createRelativeDataById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'rType' => 'required',
            'rName' => 'required'
        ), array(
            'required' => '此欄位不可為空白'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->newRelativeDataById($re, $id);
            if ($responses == '新增親屬資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //新增履歷結束

    //取得履歷開始
    public function findResumeDataById($id)
    {
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $stuBas = stuBasicEloquent::where('sid', $id)->get();
        $stuEdu = stuEduEloquent::where('sid', $id)->get();
        $stuJExp = stuJExpEloquent::where('sid', $id)->get();
        $stuLic = stulicenceEloquent::where('sid', $id)->get();
        $stuRel = stuRelativesEloquent::where('sid', $id)->get();
        $stuWor = stuWorksEloquent::where('sid', $id)->get();
        $stdRe = array($stuBas, $stuEdu, $stuJExp, $stuLic, $stuRel, $stuWor);
        return response()->json(['stdRe' => $stdRe], 200, $headers, JSON_UNESCAPED_UNICODE);
    }
    //取得履歷結束
    //
    //修改履歷開始
    public function editBasicDataById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
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
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤',
            'email' => '信箱格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->editBasicDataById_ser($re, $id);
            if ($responses == '修改基本資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editEduDataById(Request $request, $edu_id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'school' => 'required',
            'department' => 'required',
            'enterDate' => 'required|date',
            'exitDate' => 'nullable|date',
            'graduate' => 'required'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editEduDataById_ser($re, $edu_id);
            if ($responses == '修改學歷資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editJobExperienceById(Request $request, $jid)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'semester' => 'required',
            'jobTitle' => 'required'
        ), array(
            'required' => '此欄位不可為空白'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editJobExperienceById_ser($re, $jid);
            if ($responses == '修改工作資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editLicenseById(Request $request, $lid)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'agency' => 'required',
            'lname' => 'required',
            'ldate' => 'required|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editLicenseById_ser($re, $lid);
            if ($responses == '修改證照資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editLanguageById(Request $request, $id)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
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
            'required' => '此欄位不可為空白',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editLanguageById_ser($re, $id);
            if ($responses == '修改語言能力成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editAbilityById(Request $request, $id)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'dataBase' => 'required|integer',
            'programmingLanguage' => 'required|integer',
            'document' => 'required|integer',
            'webDesign' => 'required|integer',
            'imageProcessing' => 'required|integer',
            'drawingSoftware' => 'required|integer',
            'animation' => 'required|integer',
            'OS' => 'required|integer',
            'musicEditor' => 'required|integer',

        ), array(
            'required' => '此欄位不可為空白',
            'integer' => 'int格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editAbilityById_ser($re, $id);
            if ($responses == '修改電腦技術資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editWorksDataById(Request $request, $wid)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'wName' => 'required',
            'wCreatedDate' => 'nullable|date'
        ), array(
            'required' => '此欄位不可為空白',
            'date' => '日期格式錯誤'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);
        } else {
            $responses = $this->ResumeServices->editWorksDataById_ser($re, $wid);
            if ($responses == '修改作品資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function editRelativeDataById(Request $request, $rid)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'rType' => 'required',
            'rName' => 'required'
        ), array(
            'required' => '此欄位不可為空白'
        ));
        if ($objValidator->fails()) {
            return response()->json($objValidator->errors(), 400);//422
        } else {
            $responses = $this->ResumeServices->editRelativeDataById_ser($re, $rid);
            if ($responses == '修改親屬資料成功') {
                return response()->json($responses, 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json($responses, 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
    //修改履歷結束
}
