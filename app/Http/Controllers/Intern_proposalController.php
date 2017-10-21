<?php

namespace App\Http\Controllers;

use App\Intern_proposal;
use App\Services\Intern_proposalServices;
use App\Stu_course;
use Illuminate\Http\Request;
use Validator;

class Intern_proposalController extends Controller
{
    protected $Intern_proposalServices;

    public function __construct(Intern_proposalServices $Intern_proposalServices)
    {
        $this->middleware('student',['except'=>'getInternProposalBySCid']);
        $this->Intern_proposalServices = $Intern_proposalServices;
    }


    //取得實習計畫書
    public function getInternProposalBySCid(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'integer'=>'請輸入INT',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
            if($inP){
                $stu=Stu_course::find($re['SCid'])->user_stu()->first();
                $com=Stu_course::find($re['SCid'])->user_com()->first();
                $tea=Stu_course::find($re['SCid'])->user_tea()->first();
                $inP->stuName=$stu->u_name;
                $inP->stuNum=$stu->account;
                $inP->teaName=$tea->u_name;
                $inP->comName=$com->u_name;
                return response()->json($inP, 200, [], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json(['找不到'], 400, [], JSON_UNESCAPED_UNICODE);
            }

        }
    }

    //新增實習計畫書
    public function createProposalBySCid(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
            'stuClass' => 'required',
            'comDepartment'=> 'required',
            'comInstructor'=> 'required',
            'IPStart'=> 'required|date',
            'IPEnd'=> 'required|date',
            'IPGoal'=> 'required',
            'IPDescription'=> 'required',
            'IPTopic1'=> 'required',
            'IPTopic1Start'=> 'required|date',
            'IPTopic1End'=> 'required|date',
            'IPTopic2'=> 'required',
            'IPTopic2Start'=> 'required|date',
            'IPTopic2End'=> 'required|date',
            'IPTopic3'=> 'required',
            'IPTopic3Start'=> 'required|date',
            'IPTopic3End'=> 'required|date',
            'IPTopic4'=> 'required',
            'IPTopic4Start'=> 'required|date',
            'IPTopic4End'=> 'required|date',
            'IPTopic5'=> 'required',
            'IPTopic5Start'=> 'required|date',
            'IPTopic5End'=> 'required|date',
            'IPTopic6'=> 'required',
            'IPTopic6Start'=> 'required|date',
            'IPTopic6End'=> 'required|date',
            'IPTopic7'=> 'required',
            'IPTopic7Start'=> 'required|date',
            'IPTopic7End'=> 'required|date',
            'IPTopic8'=> 'required',
            'IPTopic8Start'=> 'required|date',
            'IPTopic8End'=> 'required|date',
            'IPInstruction'=> 'required',
            'IPComPlanning'=> 'required',
            'IPTeaPlanning'=> 'required',
            'IPIndicators'=> 'required',
            'IPAssessment'=> 'required',
            'IPFeedback'=> 'required',
        ), array(
            'SCid.required' => '請輸入SCid',
            'stuClass.required' => '請輸入班級',
            'comDepartment.required'=> '請輸入廠商部門',
            'comInstructor.required'=> '請輸入企業輔導員姓名',
            'IPStart.required'=> '請輸入實習開始日期',
            'IPEnd.required'=> '請輸入實習結束日期',
            'IPGoal.required'=> '請輸入實習目標',
            'IPDescription.required'=> '請輸入實習課程內涵',
            'IPTopic1.required'=> '請輸入實習主題之一',
            'IPTopic1Start.required'=> '請輸入實習主題之一開始日期',
            'IPTopic1End.required'=> '請輸入實習主題之一結束日期',
            'IPTopic2.required'=> '請輸入實習主題之二',
            'IPTopic2Start.required'=> '請輸入實習主題之二開始日期',
            'IPTopic2End.required'=> '請輸入實習主題之二結束日期',
            'IPTopic3.required'=> '請輸入實習主題之三',
            'IPTopic3Start.required'=> '請輸入實習主題之三開始日期',
            'IPTopic3End.required'=> '請輸入實習主題之三結束日期',
            'IPTopic4.required'=> '請輸入實習主題之四',
            'IPTopic4Start.required'=> '請輸入實習主題之四開始日期',
            'IPTopic4End.required'=> '請輸入實習主題之四結束日期',
            'IPTopic5.required'=> '請輸入實習主題之五',
            'IPTopic5Start.required'=> '請輸入實習主題之五開始日期',
            'IPTopic5End.required'=> '請輸入實習主題之五結束日期',
            'IPTopic6.required'=> '請輸入實習主題之六',
            'IPTopic6Start.required'=> '請輸入實習主題之六開始日期',
            'IPTopic6End.required'=> '請輸入實習主題之六結束日期',
            'IPTopic7.required'=> '請輸入實習主題之七',
            'IPTopic7Start.required'=> '請輸入實習主題之七開始日期',
            'IPTopic7End.required'=> '請輸入實習主題之七結束日期',
            'IPTopic8.required'=> '請輸入實習主題之八',
            'IPTopic8Start.required'=> '請輸入實習主題之八開始日期',
            'IPTopic8End.required'=> '請輸入實習主題之八結束日期',
            'IPInstruction.required'=> '請輸入實習機構參與實習課程說明',
            'IPComPlanning.required'=> '請輸入業界專家輔導實習課程規劃',
            'IPTeaPlanning.required'=> '請輸入學校老師輔導實習課程規劃',
            'IPIndicators.required'=> '請輸入實習成效考核指標或項目',
            'IPAssessment.required'=> '請輸入實習成效與教學評核方式',
            'IPFeedback.required'=> '請輸入實習課後回饋計畫',
            'integer'=>'請輸入INT',
            'date'=>'日期格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->Intern_proposalServices->createProposalBySCid_ser($re);
            if ($responses=='新增實習計畫書成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }

        }
    }

    //修改實習計畫書
    public function editProposalBySCid(Request $request){
        $re=$request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
            'stuClass' => 'required',
            'comDepartment'=> 'required',
            'comInstructor'=> 'required',
            'IPStart'=> 'required|date',
            'IPEnd'=> 'required|date',
            'IPGoal'=> 'required',
            'IPDescription'=> 'required',
            'IPTopic1'=> 'required',
            'IPTopic1Start'=> 'required|date',
            'IPTopic1End'=> 'required|date',
            'IPTopic2'=> 'required',
            'IPTopic2Start'=> 'required|date',
            'IPTopic2End'=> 'required|date',
            'IPTopic3'=> 'required',
            'IPTopic3Start'=> 'required|date',
            'IPTopic3End'=> 'required|date',
            'IPTopic4'=> 'required',
            'IPTopic4Start'=> 'required|date',
            'IPTopic4End'=> 'required|date',
            'IPTopic5'=> 'required',
            'IPTopic5Start'=> 'required|date',
            'IPTopic5End'=> 'required|date',
            'IPTopic6'=> 'required',
            'IPTopic6Start'=> 'required|date',
            'IPTopic6End'=> 'required|date',
            'IPTopic7'=> 'required',
            'IPTopic7Start'=> 'required|date',
            'IPTopic7End'=> 'required|date',
            'IPTopic8'=> 'required',
            'IPTopic8Start'=> 'required|date',
            'IPTopic8End'=> 'required|date',
            'IPInstruction'=> 'required',
            'IPComPlanning'=> 'required',
            'IPTeaPlanning'=> 'required',
            'IPIndicators'=> 'required',
            'IPAssessment'=> 'required',
            'IPFeedback'=> 'required',
        ), array(
            'SCid.required' => '請輸入SCid',
            'stuClass.required' => '請輸入班級',
            'comDepartment.required'=> '請輸入廠商部門',
            'comInstructor.required'=> '請輸入企業輔導員姓名',
            'IPStart.required'=> '請輸入實習開始日期',
            'IPEnd.required'=> '請輸入實習結束日期',
            'IPGoal.required'=> '請輸入實習目標',
            'IPDescription.required'=> '請輸入實習課程內涵',
            'IPTopic1.required'=> '請輸入實習主題之一',
            'IPTopic1Start.required'=> '請輸入實習主題之一開始日期',
            'IPTopic1End.required'=> '請輸入實習主題之一結束日期',
            'IPTopic2.required'=> '請輸入實習主題之二',
            'IPTopic2Start.required'=> '請輸入實習主題之二開始日期',
            'IPTopic2End.required'=> '請輸入實習主題之二結束日期',
            'IPTopic3.required'=> '請輸入實習主題之三',
            'IPTopic3Start.required'=> '請輸入實習主題之三開始日期',
            'IPTopic3End.required'=> '請輸入實習主題之三結束日期',
            'IPTopic4.required'=> '請輸入實習主題之四',
            'IPTopic4Start.required'=> '請輸入實習主題之四開始日期',
            'IPTopic4End.required'=> '請輸入實習主題之四結束日期',
            'IPTopic5.required'=> '請輸入實習主題之五',
            'IPTopic5Start.required'=> '請輸入實習主題之五開始日期',
            'IPTopic5End.required'=> '請輸入實習主題之五結束日期',
            'IPTopic6.required'=> '請輸入實習主題之六',
            'IPTopic6Start.required'=> '請輸入實習主題之六開始日期',
            'IPTopic6End.required'=> '請輸入實習主題之六結束日期',
            'IPTopic7.required'=> '請輸入實習主題之七',
            'IPTopic7Start.required'=> '請輸入實習主題之七開始日期',
            'IPTopic7End.required'=> '請輸入實習主題之七結束日期',
            'IPTopic8.required'=> '請輸入實習主題之八',
            'IPTopic8Start.required'=> '請輸入實習主題之八開始日期',
            'IPTopic8End.required'=> '請輸入實習主題之八結束日期',
            'IPInstruction.required'=> '請輸入實習機構參與實習課程說明',
            'IPComPlanning.required'=> '請輸入業界專家輔導實習課程規劃',
            'IPTeaPlanning.required'=> '請輸入學校老師輔導實習課程規劃',
            'IPIndicators.required'=> '請輸入實習成效考核指標或項目',
            'IPAssessment.required'=> '請輸入實習成效與教學評核方式',
            'IPFeedback.required'=> '請輸入實習課後回饋計畫',
            'integer'=>'請輸入INT',
            'date'=>'日期格式錯誤',
        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error=array();
            foreach ($errors->all() as $message) {
                $error[]=$message;
            }
            return response()->json($error,400);//422
        } else {
            $responses=$this->Intern_proposalServices->editProposalBySCid_ser($re);
            if ($responses=='修改實習計畫書成功') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }

        }
    }
}
