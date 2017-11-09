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
        $this->middleware('student',['only'=>'editProposalBySCid','createProposalBySCid']);
        $this->middleware('teacher',['only'=>'teacherAccessInternProposalBySCid']);
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
//                $inP->stuName=$stu->u_name;
//                $inP->stuNum=$stu->account;
//                $inP->teaName=$tea->u_name;
//                $inP->comName=$com->u_name;
                $t1=['IPTopic'=>$inP->IPTopic1,'IPTopicStart'=>$inP->IPTopic1Start,'IPTopicEnd'=>$inP->IPTopic1End];
                $t2=['IPTopic'=>$inP->IPTopic2,'IPTopicStart'=>$inP->IPTopic2Start,'IPTopicEnd'=>$inP->IPTopic2End];
                $t3=['IPTopic'=>$inP->IPTopic3,'IPTopicStart'=>$inP->IPTopic3Start,'IPTopicEnd'=>$inP->IPTopic3End];
                $t4=['IPTopic'=>$inP->IPTopic4,'IPTopicStart'=>$inP->IPTopic4Start,'IPTopicEnd'=>$inP->IPTopic4End];
                $t5=['IPTopic'=>$inP->IPTopic5,'IPTopicStart'=>$inP->IPTopic5Start,'IPTopicEnd'=>$inP->IPTopic5End];
                $t6=['IPTopic'=>$inP->IPTopic6,'IPTopicStart'=>$inP->IPTopic6Start,'IPTopicEnd'=>$inP->IPTopic6End];
                $t7=['IPTopic'=>$inP->IPTopic7,'IPTopicStart'=>$inP->IPTopic7Start,'IPTopicEnd'=>$inP->IPTopic7End];
                $t8=['IPTopic'=>$inP->IPTopic8,'IPTopicStart'=>$inP->IPTopic8Start,'IPTopicEnd'=>$inP->IPTopic8End];
                $topicList=[$t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8];
//                        $topicList=[['IPTopic1'=>$inP->IPTopic1,'IPTopic1Start'=>$inP->IPTopic1Start,'IPTopic1End'=>$inP->IPTopic1End],['IPTopic2'=>$inP->IPTopic2,'IPTopic2Start'=>$inP->IPTopic2Start,'IPTopic2End'=>$inP->IPTopic2End]
//                            ,['IPTopic3'=>$inP->IPTopic3,'IPTopic3Start'=>$inP->IPTopic3Start,'IPTopic3End'=>$inP->IPTopic3End]
//                            ,['IPTopic4'=>$inP->IPTopic4,'IPTopic4Start'=>$inP->IPTopic4Start,'IPTopic4End'=>$inP->IPTopic4End],['IPTopic5'=>$inP->IPTopic5,'IPTopic5Start'=>$inP->IPTopic5Start,'IPTopic5End'=>$inP->IPTopic5End],['IPTopic6'=>$inP->IPTopic6,'IPTopic6Start'=>$inP->IPTopic6Start,'IPTopic6End'=>$inP->IPTopic6End]
//                            ,['IPTopic7'=>$inP->IPTopic7,'IPTopic7Start'=>$inP->IPTopic7Start,'IPTopic7End'=>$inP->IPTopic7End],['IPTopic8'=>$inP->IPTopic8,'IPTopic8Start'=>$inP->IPTopic8Start,'IPTopic8End'=>$inP->IPTopic8End]];
                $inPro=['IPId'=>$inP->IPId,'SCid'=>$inP->SCid,'stuClass'=>$inP->stuClass,'comDepartment'=>$inP->comDepartment,'comInstructor'=>$inP->comInstructor,'IPStart'=>$inP->IPStart
                    ,'IPEnd'=>$inP->IPEnd,'IPGoal'=>$inP->IPGoal,'IPDescription'=>$inP->IPDescription,'topicList'=>$topicList,'IPInstruction'=>$inP->IPInstruction,'IPComPlanning'=>$inP->IPComPlanning
                    ,'IPTeaPlanning'=>$inP->IPTeaPlanning,'IPIndicators'=>$inP->IPIndicators,'IPAssessment'=>$inP->IPAssessment,'IPFeedback'=>$inP->IPFeedback,'IPRead'=>$inP->IPRead
                    ,'stuName'=>$stu->u_name,'stuNum'=>$stu->account,'teaName'=>$tea->u_name,'comName'=>$com->u_name];
                return response()->json($inPro, 200, [], JSON_UNESCAPED_UNICODE);
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
    //老師查閱實習計畫
    public function teacherAccessInternProposalBySCid(Request $request){
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
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
            $responses = $this->Intern_proposalServices->teacherAccessInternProposalBySCid_ser($re['SCid']);
            if ($responses == '已查閱'||$responses == '更改為未查閱') {
                return response()->json([$responses], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([$responses], 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
