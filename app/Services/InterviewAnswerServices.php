<?php

namespace App\Services;
use App\Interviews_com as InterviewComEloquent;
use App\Interviews_com_questions;
use App\Interviews_stu as InterviewStuEloquent;
use App\Interviews_stu_questions;
use App\Stu_basic;
use App\Stu_course;
use App\User;


class InterviewAnswerServices{

    public function getNullComInterview_ser($re){
        $inCQ = Interviews_com_questions::GetLatestVersion()->get();
        $stu = Stu_course::find($re['SCid'])->user_stu()->first();
        $com = Stu_course::find($re['SCid'])->user_com()->first();
        $com_b = User::find($com->id)->company()->first();
        if($inCQ&&$stu&&$com_b){
            return array('InterviewQ'=>$inCQ,'stuName'=>$stu->u_name,'comTel'=>$com->u_tel,'comName'=>$com->u_name,'comAddress'=>$com_b->caddress,'SCid'=>$re['SCid']);
        }else{
            return '取得訪談紀錄失敗';
        }
    }

    public function getNullStuInterview_ser($re){
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        $stu = Stu_course::find($re['SCid'])->user_stu()->first();
        $com = Stu_course::find($re['SCid'])->user_com()->first();
        $com_b = User::find($com->id)->company()->first();
        if($inSQ&&$stu&&$com_b){
            return array('InterviewQ'=>$inSQ,'stuName'=>$stu->u_name,'comTel'=>$com->u_tel,'comName'=>$com->u_name,'comAddress'=>$com_b->caddress,'SCid'=>$re['SCid']);
        }else{
            return '取得訪談紀錄失敗';
        }
    }

    public function getInterviewBySCid_ser($SCid){
        $interCs=InterviewComEloquent::where('SCid',$SCid)->get();
        $interSs=InterviewStuEloquent::where('SCid',$SCid)->get();
        if($interCs && $interSs){
            foreach ($interCs as $interC){
                $stu = Stu_course::find($SCid)->user_stu()->first();
                $com = Stu_course::find($SCid)->user_com()->first();
                $com_b = User::find($com->id)->company()->first();
                $inCQ = Interviews_com_questions::GetVersion($interC->insCQuestionVer)->get();
                $inCQ_num = Interviews_com_questions::GetVersion($interC->insCQuestionVer)->count();
                $interC->questions=$inCQ;
                $interC->questions_num=$inCQ_num;
                $interC->stuName=$stu->u_name;
                $interC->stuNum=$stu->account;
                $interC->comTel=$com->u_tel;
                $interC->comName=$com->u_name;
                $interC->cAddress=$com_b->caddress;
                $interC->profilePic=$com_b->profilePic;
            }
            foreach ($interSs as $interS){
                $inSQ = Interviews_stu_questions::GetVersion($interS->insQuestionVer)->get();
                $inSQ_num = Interviews_stu_questions::GetVersion($interS->insQuestionVer)->count();
                $interS->questions=$inSQ;
                $interS->questions_num=$inSQ_num;

                $stu = Stu_course::find($SCid)->user_stu()->first();
                $com = Stu_course::find($SCid)->user_com()->first();
                $stu_b = Stu_course::find($SCid)->stu_basic()->first();
                $com_b = User::find($com->id)->company()->first();

                $interS->stuName=$stu->u_name;
                $interS->stuNum=$stu->account;
                $interS->comTel=$com->u_tel;
                $interS->comName=$com->u_name;
                $interS->cAddress=$com_b->caddress;
                $interS->profilePic=$stu_b->profilePic;
            }

                return ['InterviewComList'=>$interCs,'InterviewStuList'=>$interSs];

        }else{
            return '取得訪談紀錄失敗';
        }

    }

    public function teacherCreateComInterview_ser($re)
    {
        $inCQ_num = Interviews_com_questions::GetVersion($re['insCQuestionVer'])->count();
        $ans_length=$inCQ_num*2-1;
        if($ans_length==strlen($re['insCAns'])){
            $InterviewCom = new InterviewComEloquent();
            $InterviewCom->SCid = $re['SCid'];
            $InterviewCom->insCDate = $re['insCDate'];
            $InterviewCom->insCNum = $re['insCNum'];
            $InterviewCom->insCVisitWay = $re['insCVisitWay'];
            $InterviewCom->insCAns = $re['insCAns'];
            $InterviewCom->insCQuestionVer = $re['insCQuestionVer'];
            $InterviewCom->insCComments = $re['insCComments'];
            $InterviewCom->save();
            return '訪談紀錄新增成功';
        }else{
            return $ans_length;
        }

    }

    public function teacherEditComInterview_ser($re)
    {
        $inCQ_num = Interviews_com_questions::GetVersion($re['insCQuestionVer'])->count();
        $ans_length=$inCQ_num*2-1;
        if($ans_length==strlen($re['insCAns'])){
            $InterviewCom=InterviewComEloquent::where('insCId',$re['insCId'])->first();
            $InterviewCom->SCid = $re['SCid'];
            $InterviewCom->insCDate = $re['insCDate'];
            $InterviewCom->insCNum = $re['insCNum'];
            $InterviewCom->insCVisitWay = $re['insCVisitWay'];
            $InterviewCom->insCAns = $re['insCAns'];
            $InterviewCom->insCQuestionVer = $re['insCQuestionVer'];
            $InterviewCom->insCComments = $re['insCComments'];
            $InterviewCom->save();
            return '訪談紀錄修改成功';
        }else{
            return '答案數量錯誤';
        }

    }

    public function teacherCreateStuInterview_ser($re)
    {
        $inSQ_num = Interviews_stu_questions::GetVersion($re['insQuestionVer'])->count();
        $ans_length=$inSQ_num*2-1;
        if($ans_length==strlen($re['insAns'])){
            $InterviewCom = new InterviewStuEloquent();
            $InterviewCom->SCid = $re['SCid'];
            $InterviewCom->insDate = $re['insDate'];
            $InterviewCom->insNum = $re['insNum'];
            $InterviewCom->insStuClass = $re['insStuClass'];
            $InterviewCom->insVisitWay = $re['insVisitWay'];
            $InterviewCom->insAns = $re['insAns'];
            $InterviewCom->insQuestionVer = $re['insQuestionVer'];
            $InterviewCom->insComments = $re['insComments'];
            $InterviewCom->save();
            return '訪談紀錄新增成功';
        }else{
            return '答案數量錯誤';
        }

    }

    public function teacherEditStuInterview_ser($re)
    {
        $inSQ_num = Interviews_stu_questions::GetVersion($re['insQuestionVer'])->count();
        $ans_length=$inSQ_num*2-1;
        if($ans_length==strlen($re['insAns'])){
            $InterviewCom=InterviewStuEloquent::where('insId',$re['insId'])->first();
            $InterviewCom->SCid = $re['SCid'];
            $InterviewCom->insDate = $re['insDate'];
            $InterviewCom->insNum = $re['insNum'];
            $InterviewCom->insStuClass = $re['insStuClass'];
            $InterviewCom->insVisitWay = $re['insVisitWay'];
            $InterviewCom->insAns = $re['insAns'];
            $InterviewCom->insQuestionVer = $re['insQuestionVer'];
            $InterviewCom->insComments = $re['insComments'];
            $InterviewCom->save();
            return '訪談紀錄修改成功';
        }else{
            return '答案數量錯誤';
        }

    }
}