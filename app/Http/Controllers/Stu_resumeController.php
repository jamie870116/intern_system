<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_edu as stuEduEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_relatives as stuRelativesEloquent;
use App\Stu_works as stuWorksEloquent;

use App\Services\ResumeService as ResumeService;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Validator;
use Log;
class Stu_resumeController extends Controller
{
    protected $ResumeService;
    public function __construct(ResumeService $ResumeService){
        $this->newResumeService = $ResumeService;
    }

    public function findUserDetailsByToken(Request $request){
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        if($user){
            return response()->json(['result' => $user],200);
        }else{
            return response()->json('使用者不存在',400);
        }

    }
    //新增履歷開始
    public function createEduDataById(Request $request,$id){

        $re=$request->all();


        $objValidator = Validator::make($request->all(), array(
            'school'=>'required',
            'department'=>'required',
            'enterDate' => 'required|date',
            'exitDate'=>'nullable|date',
            'graduate'=>'required|integer'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤',
            'integer'=>'int格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $responses=$this->ResumeService->newEduDataById($re, $id);
            if($responses=='新增學歷資料成功'){
                return response()->json($responses,200,[], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json($responses,400,[], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    public function createJobExperienceById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $semester=$re['semester'];
        $jobTitle=$re['jobTitle'];

        $objValidator = Validator::make($request->all(), array(
            'semester'=>'required',
            'jobTitle'=>'required'
        ),array(
            'required'=>'此欄位不可為空白'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);
        }else{
            $stuJExp= new stuJExpEloquent();
            $stuJExp->sid=$id;
            $stuJExp->semester=$semester;
            $stuJExp->jobTitle=$jobTitle;
            $stuJExp->save();
            return response()->json("新增工作資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("新增工作資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function createLicenseById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $agency=$re['agency'];
        $lname=$re['lname'];
        $ldate=$re['ldate'];

        $objValidator = Validator::make($request->all(), array(
            'agency'=>'required',
            'lname'=>'required',
            'ldate' => 'required|date'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stulic= new stulicenceEloquent();
            $stulic->sid=$id;
            $stulic->agency=$agency;
            $stulic->lname=$lname;
            $stulic->ldate=$ldate;
            $stulic->save();
            return response()->json("新增證照資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("新增證照資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function createWorksDataById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $wName=$re['wName'];
        $wLink=$re['wLink'];
        $wCreatedDate=$re['wCreatedDate'];

        $objValidator = Validator::make($request->all(), array(
            'wName'=>'required',
            'wCreatedDate' => 'nullable|date'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuWor= new stuWorksEloquent();
            $stuWor->sid=$id;
            $stuWor->wName=$wName;
            $stuWor->wLink=$wLink;
            $stuWor->wCreatedDate=$wCreatedDate;
            $stuWor->save();
            return response()->json("新增作品資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("新增作品資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function createRelativeDataById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $rType=$re['rType'];
        $rName=$re['rName'];
        $rAge=$re['rAge'];
        $rEdu=$re['rEdu'];
        $rJob=$re['rJob'];

        $objValidator = Validator::make($request->all(), array(
            'rType'=>'required',
            'rName'=>'required'
        ),array(
            'required'=>'此欄位不可為空白'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $sturel= new stuRelativesEloquent();
            $sturel->sid=$id;
            $sturel->rType=$rType;
            $sturel->rName=$rName;
            $sturel->rAge=$rAge;
            $sturel->rEdu=$rEdu;
            $sturel->rJob=$rJob;
            $sturel->save();
            return response()->json("新增親屬資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("新增親屬資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }
    //新增履歷結束

    //取得履歷開始
    public function findResumeDataById($id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $stuBas =stuBasicEloquent::where('sid',$id)->get();
        $stuEdu =stuEduEloquent::where('sid',$id)->get();
        $stuJExp =stuJExpEloquent::where('sid',$id)->get();
        $stuLic =stulicenceEloquent::where('sid',$id)->get();
        $stuRel =stuRelativesEloquent::where('sid',$id)->get();
        $stuWor =stuWorksEloquent::where('sid',$id)->get();
        $stdRe=array($stuBas,$stuEdu,$stuJExp,$stuLic,$stuRel,$stuWor);
        return response()->json(['stdRe' => $stdRe],200,$headers, JSON_UNESCAPED_UNICODE);
    }
    //取得履歷結束
    //
    //修改履歷開始
    public function editBasicDataById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $stuBas =stuBasicEloquent::where('sid',$id)->get();
        $re=$request->all();
        $chiName=$re['chiName'];
        $engName=$re['engName'];
        $bornedPlace=$re['bornedPlace'];
        $nativePlace=$re['nativePlace'];
        $brithday=$re['brithday'];
        $gender=$re['gender'];
        $height=$re['height'];
        $weight=$re['weight'];
        $bloodtype=$re['bloodtype'];
        $address=$re['address'];
        $email=$re['email'];
        $contact=$re['contact'];

        $objValidator = Validator::make($request->all(), array(
            'chiName'=>'required',
            'engName'=>'required',
            'bornedPlace'=>'required',
            'nativePlace'=>'required',
            'brithday'=>'required|date',
            'gender'=>'required',
            'height'=>'required',
            'weight'=>'required',
            'bloodtype'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'contact'=>'required',
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤',
            'email'=>'信箱格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuBas->chiName=$chiName;
            $stuBas->engName=$engName;
            $stuBas->bornedPlace=$bornedPlace;
            $stuBas->nativePlace=$nativePlace;
            $stuBas->brithday=$brithday;
            $stuBas->gender=$gender;
            $stuBas->height=$height;
            $stuBas->weight=$weight;
            $stuBas->bloodtype=$bloodtype;
            $stuBas->address=$address;
            $stuBas->email=$email;
            $stuBas->contact=$contact;
            $stuBas->save();
            return response()->json("修改基本資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改基本資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editEduDataById(Request $request,$edu_id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stuEdu =stuEduEloquent::where('edu_id',$edu_id)->get();
        $school=$re['school'];
        $department=$re['department'];
        $degree=$re['degree'];
        $enterDate=$re['enterDate'];
        $exitDate=$re['exitDate'];
        $graduate=$re['graduate'];

        $objValidator = Validator::make($request->all(), array(
            'school'=>'required',
            'department'=>'required',
            'enterDate' => 'required|date',
            'exitDate'=>'nullable|date',
            'graduate'=>'required'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuEdu->school=$school;
            $stuEdu->department=$department;
            $stuEdu->degree=$degree;
            $stuEdu->enterDate=$enterDate;
            $stuEdu->exitDate=$exitDate;
            $stuEdu->graduate=$graduate;
            $stuEdu->save();
            return response()->json("修改學歷資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改學歷資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editJobExperienceById(Request $request,$jid){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stuJExp =stuJExpEloquent::where('jid',$jid)->get();
        $semester=$re['semester'];
        $jobTitle=$re['jobTitle'];

        $objValidator = Validator::make($request->all(), array(
            'semester'=>'required',
            'jobTitle'=>'required'
        ),array(
            'required'=>'此欄位不可為空白'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);
        }else{
            $stuJExp->semester=$semester;
            $stuJExp->jobTitle=$jobTitle;
            $stuJExp->save();
            return response()->json("修改工作資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改工作資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editLicenseById(Request $request,$lid){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stulic =stulicenceEloquent::where('lid',$lid)->get();
        $agency=$re['agency'];
        $lname=$re['lname'];
        $ldate=$re['ldate'];

        $objValidator = Validator::make($request->all(), array(
            'agency'=>'required',
            'lname'=>'required',
            'ldate' => 'required|date'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stulic->agency=$agency;
            $stulic->lname=$lname;
            $stulic->ldate=$ldate;
            $stulic->save();
            return response()->json("修改證照資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改證照資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editLanguageById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stuBas =stuBasicEloquent::where('sid',$id)->get();
        $CL=$re['cl'];
        $CS=$re['cs'];
        $CR=$re['cr'];
        $CW=$re['cw'];
        $EL=$re['el'];
        $ES=$re['es'];
        $ER=$re['er'];
        $EW=$re['ew'];
        $TL=$re['tl'];
        $TS=$re['ts'];

        $objValidator = Validator::make($request->all(), array(
            'cl'=>'required|integer',
            'cs'=>'required|integer',
            'cw'=>'required|integer',
            'cr'=>'required|integer',
            'el'=>'required|integer',
            'es'=>'required|integer',
            'ew'=>'required|integer',
            'er'=>'required|integer',
            'tl'=>'required|integer',
            'ts'=>'required|integer',
        ),array(
            'required'=>'此欄位不可為空白',
            'integer'=>'int格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuBas->CL=$CL;
            $stuBas->CS=$CS;
            $stuBas->CR=$CR;
            $stuBas->CW=$CW;
            $stuBas->EL=$EL;
            $stuBas->ES=$ES;
            $stuBas->ER=$ER;
            $stuBas->EW=$EW;
            $stuBas->TL=$TL;
            $stuBas->TS=$TS;
            $stuBas->save();
            return response()->json("修改語言能力成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改語言能力失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editAbilityById(Request $request,$id){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stuBas =stuBasicEloquent::where('sid',$id)->get();
        $dataBase=$re['dataBase'];
        $programmingLanguage=$re['programmingLanguage'];
        $webDesign=$re['webDesign'];
        $document=$re['document'];
        $imageProcessing=$re['imageProcessing'];
        $drawingSoftware=$re['drawingSoftware'];
        $animation=$re['animation'];
        $OS=$re['OS'];
        $musicEditor=$re['musicEditor'];

        $objValidator = Validator::make($request->all(), array(
            'dataBase'=>'required|integer',
            'programmingLanguage'=>'required|integer',
            'document'=>'required|integer',
            'webDesign'=>'required|integer',
            'imageProcessing'=>'required|integer',
            'drawingSoftware'=>'required|integer',
            'animation'=>'required|integer',
            'OS'=>'required|integer',
            'musicEditor'=>'required|integer',

        ),array(
            'required'=>'此欄位不可為空白',
            'integer'=>'int格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuBas->dataBase=$dataBase;
            $stuBas->programmingLanguage=$programmingLanguage;
            $stuBas->webDesign=$webDesign;
            $stuBas->document=$document;
            $stuBas->imageProcessing=$imageProcessing;
            $stuBas->drawingSoftware=$drawingSoftware;
            $stuBas->animation=$animation;
            $stuBas->OS=$OS;
            $stuBas->musicEditor=$musicEditor;
            $stuBas->save();
            return response()->json("修改電腦技術資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改電腦技術資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editWorksDataById(Request $request,$wid){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $stuWor =stuWorksEloquent::where('wid',$wid)->get();
        $wName=$re['wName'];
        $wLink=$re['wLink'];
        $wCreatedDate=$re['wCreatedDate'];

        $objValidator = Validator::make($request->all(), array(
            'wName'=>'required',
            'wCreatedDate' => 'nullable|date'
        ),array(
            'required'=>'此欄位不可為空白',
            'date'=>'日期格式錯誤'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $stuWor->wName=$wName;
            $stuWor->wLink=$wLink;
            $stuWor->wCreatedDate=$wCreatedDate;
            $stuWor->save();
            return response()->json("修改作品資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改作品資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }

    public function editRelativeDataById(Request $request,$rid){
        $headers = array('Content-Type' => 'application/json; <a href="http://superlevin.ifengyuan.tw/tag/charset/">charset</a>=utf-8');
        $re=$request->all();
        $sturel =stuRelativesEloquent::where('rid',$rid)->get();
        $rType=$re['rType'];
        $rName=$re['rName'];
        $rAge=$re['rAge'];
        $rEdu=$re['rEdu'];
        $rJob=$re['rJob'];

        $objValidator = Validator::make($request->all(), array(
            'rType'=>'required',
            'rName'=>'required'
        ),array(
            'required'=>'此欄位不可為空白'
        ));
        if($objValidator->fails()){
            return response()->json($objValidator->errors(),400);//422
        }else{
            $sturel->rType=$rType;
            $sturel->rName=$rName;
            $sturel->rAge=$rAge;
            $sturel->rEdu=$rEdu;
            $sturel->rJob=$rJob;
            $sturel->save();
            return response()->json("修改親屬資料成功",200,$headers, JSON_UNESCAPED_UNICODE);
        }
        return response()->json("修改親屬資料失敗",400,$headers, JSON_UNESCAPED_UNICODE);
    }
    //修改履歷結束
}
