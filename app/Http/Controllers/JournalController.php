<?php

namespace App\Http\Controllers;

use App\Intern_proposal;
use App\Services\JournalServices;
use App\Stu_course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;
use Log;
use Validator;

use App\Reviews;
use App\Stu_course as Stu_courseEloquent;
use App\User as UserEloquent;
use App\Course as CourseEloquent;
use App\Journal as JournalEloquent;
use App\Assessment_Com as Assessment_ComEloquent;

class JournalController extends Controller
{
    protected $JournalServices;

    public function __construct(JournalServices $JournalServices)
    {
        $this->middleware('student');
        $this->JournalServices = $JournalServices;
    }

    //該學生實習列表
    public function studentGetInternList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_courseEloquent::where('sid', $user->id)->get();
        $intern_list = array();
        foreach ($stu_course as $stu_cour) {
            $journalCom = UserEloquent::where('account', $stu_cour->c_account)->first();
            $course=Stu_course::find($stu_cour->SCid)->courses()->first();
            $now = Carbon::now();

            if($now < $course->courseEnd){
               $passDeadLine=false;
            }else{
                $passDeadLine=true;
            }
            $com_b = UserEloquent::find($journalCom->id)->company()->first();
            $list = array('SCid'=>$stu_cour->SCid,'profilePic'=>$com_b->profilePic,'com_name'=> $journalCom->u_name, 'courseName'=>$course->courseName,'passDeadLine'=>$passDeadLine);

            $intern_list[] = $list;

        }
        return response()->json(['intern_list'=>$intern_list], 200, [], JSON_UNESCAPED_UNICODE);
    }

    //該學生週誌列表
    public function studentGetJournalList(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'SCid' => 'required|integer',
        ), array(
            'SCid.required' => '請輸入SCid',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $journal=JournalEloquent::where('SCid',$re['SCid'])->get();
            $course=Stu_course::findOrfail($re['SCid'])->courses()->first();
            $now = Carbon::now();
            if($now < $course->courseEnd){
                $passDeadLine=false;
            }else{
                $passDeadLine=true;
            }
            $stu=Stu_course::find($re['SCid'])->user_stu()->first();
            $com=Stu_course::find($re['SCid'])->user_com()->first();
            $tea=Stu_course::find($re['SCid'])->user_tea()->first();
            if(!$journal){
                return response()->json(array('找不到週誌列表'), 400, [], JSON_UNESCAPED_UNICODE);
            }else {
                foreach ($journal as $j){
                    $j->stuName=$stu->u_name;
                    $j->stuNum=$stu->account;
                    $j->comName=$com->u_name;
                    $j->teaName=$tea->u_name;
                    $j->journalStart=Carbon::parse($j->journalStart)->format('Y-m-d');
                    $j->journalEnd=Carbon::parse($j->journalEnd)->format('Y-m-d');
                    $j->passDeadLine=$passDeadLine;
                }
                $reviews=Reviews::where('SCid',$re['SCid'])->first();
                $googleFrom='https://docs.google.com/forms/d/1E_AN52T7SrulZC3l29RhdWpohyDjAkDn76M3kmrKSZs/viewform?edit_requested=true';
                if($reviews){
                    $reviews->googleForm=$googleFrom;
                    if($reviews->reRead==0)
                        $reviews->reRead=false;
                    else
                        $reviews->reRead=true;
                    $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                    if($inP) {
                        $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                        $com = Stu_course::find($re['SCid'])->user_com()->first();
                        $tea = Stu_course::find($re['SCid'])->user_tea()->first();
//                        $inP->stuName = $stu->u_name;
//                        $inP->stuNum = $stu->account;
//                        $inP->teaName = $tea->u_name;
//                        $inP->comName = $com->u_name;
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
                        return response()->json(['journalList'=>$journal,'reviews'=>$reviews,'internProposal'=>$inPro], 200, [], JSON_UNESCAPED_UNICODE);
                    }else{
                        return response()->json(['journalList'=>$journal,'reviews'=>$reviews], 200, [], JSON_UNESCAPED_UNICODE);
                    }

                }else{
                    $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                    if($inP) {
                        $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                        $com = Stu_course::find($re['SCid'])->user_com()->first();
                        $tea = Stu_course::find($re['SCid'])->user_tea()->first();
//                        $inP->stuName = $stu->u_name;
//                        $inP->stuNum = $stu->account;
//                        $inP->teaName = $tea->u_name;
//                        $inP->comName = $com->u_name;
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
                        return response()->json(['journalList'=>$journal,'googleFrom'=>$googleFrom,'internProposal'=>$inPro], 200, [], JSON_UNESCAPED_UNICODE);
                    }else{
                        return response()->json(['journalList'=>$journal,'googleFrom'=>$googleFrom], 200, [], JSON_UNESCAPED_UNICODE);
                    }

                }
            }
        }

    }

    //在學生輸入週誌之前的顯示
    public function getJournalDetailsBeforeInput(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'journalID' => 'required|integer',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
            $course=Stu_course::find($journal->SCid)->courses()->first();
            $stu=Stu_course::find($journal->SCid)->user_stu()->first();
            $com=Stu_course::find($journal->SCid)->user_com()->first();
            $tea=Stu_course::find($journal->SCid)->user_tea()->first();
            $now = Carbon::now();
            if($now < $course->courseEnd){
                $passDeadLine=false;
            }else{
                $passDeadLine=true;
            }
            if(!$journal){
                return response()->json(array('找不到週誌'), 400, [], JSON_UNESCAPED_UNICODE);
            }else {
                $journal->stuName=$stu->u_name;
                $journal->stuNum=$stu->account;
                $journal->comName=$com->u_name;
                $journal->teaName=$tea->u_name;
                $journal->journalStart=Carbon::parse($journal->journalStart)->format('Y-m-d');
                $journal->journalEnd=Carbon::parse($journal->journalEnd)->format('Y-m-d');
                $journal->passDeadLine=$passDeadLine;


                return response()->json(['journalList'=>$journal], 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //取得特定週誌
    public function getJournalDetailsByJournalID(Request $request)
    {
        $re = $request->all();
        $objValidator = Validator::make($request->all(), array(
            'journalID' => 'required|integer',
        ), array(
            'journalID.required' => '請輸入週誌ID',
            'integer' => '請輸入int',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
            $course=Stu_course::find($journal->SCid)->courses()->first();
            $stu=Stu_course::find($journal->SCid)->user_stu()->first();
            $com=Stu_course::find($journal->SCid)->user_com()->first();
            $tea=Stu_course::find($journal->SCid)->user_tea()->first();
            $now = Carbon::now();
            if($now < $course->courseEnd){
                $passDeadLine=false;
            }else{
                $passDeadLine=true;
            }
            if(!$journal){
                return response()->json(array('找不到週誌'), 400, [], JSON_UNESCAPED_UNICODE);
            }else {
                $journal->stuName=$stu->u_name;
                $journal->stuNum=$stu->account;
                $journal->comName=$com->u_name;
                $journal->teaName=$tea->u_name;
                $journal->journalStart=Carbon::parse($journal->journalStart)->format('Y-m-d');
                $journal->journalEnd=Carbon::parse($journal->journalEnd)->format('Y-m-d');
                $journal->passDeadLine=$passDeadLine;


                return response()->json(['journalList'=>$journal], 200, [], JSON_UNESCAPED_UNICODE);
            }
        }

    }

    //學生輸入週誌內容
    public function studentEditJournal(Request $request)
    {
        $re = $request->all();

        $objValidator = Validator::make($request->all(), array(
            'journalDetail_1' => 'required',
            'journalID' => 'required',
            'journalDetail_2' => 'required',
            'journalStart' => 'required|date',
            'journalEnd' => 'required|date',
            'journalInstructor' => 'required'
        ), array(
            'journalDetail_1.required' => '請輸入重要事件紀錄與觀察',
            'journalID.required' => '請輸入週誌ID',
            'journalDetail_2.required' => '請輸入觀察心得與個人看法',
            'journalStart.required' => '請選擇日誌開始日期',
            'journalEnd.required' => '請選擇日誌結束日期',
            'journalInstructor.required' => '請輸入企業指導員姓名',
            'date' => '請輸入日期',

        ));
        if ($objValidator->fails()) {
            $errors = $objValidator->errors();
            $error = array();
            foreach ($errors->all() as $message) {
                $error[] = $message;
            }
            return response()->json($error, 400);//422
        } else {
            $responses = $this->JournalServices->studentEditJournal_ser($re);
            if ($responses == '週誌輸入成功') {
                return response()->json(array($responses), 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(array($responses), 400, [], JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
