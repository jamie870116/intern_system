<?php

namespace App\Services;
use App\interviews_com as InterviewComEloquent;
use App\Interviews_com_questions;
use App\interviews_stu as InterviewStuEloquent;
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
            return array('InterviewQ'=>$inCQ,'stuName'=>$stu->u_name,'comTel'=>$com->u_tel,'comName'=>$com->u_name,'comAddress'=>$com_b->caddress,$re['SCid']);
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
            return array('InterviewQ'=>$inSQ,'stuName'=>$stu->u_name,'comTel'=>$com->u_tel,'comName'=>$com->u_name,'comAddress'=>$com_b->caddress,$re['SCid']);
        }else{
            return '取得訪談紀錄失敗';
        }
    }

    public function getInterviewBySCid_ser($SCid){
        $interC=InterviewComEloquent::where('SCid',$SCid)->first();
        $interS=InterviewStuEloquent::where('SCid',$SCid)->first();
        if($interC && $interS){
            $inSQ = Interviews_stu_questions::GetVersion($interS->insQuestionVer)->get();
            $inCQ = Interviews_com_questions::GetVersion($interC->insCQuestionVer)->get();
            $inSQ_num = Interviews_stu_questions::GetVersion($interS->insQuestionVer)->count();
            $inCQ_num = Interviews_com_questions::GetVersion($interC->insCQuestionVer)->count();
            $interC->questions=$inCQ;
            $interS->questions=$inSQ;
            $interC->questions_num=$inSQ_num;
            $interS->questions_num=$inCQ_num;
            $stu = Stu_course::find($SCid)->user_stu()->first();
            $com = Stu_course::find($SCid)->user_com()->first();
            $com_b = User::find($com->id)->company()->first();

            $interC->stuName=$stu->u_name;
            $interC->stuNum=$stu->account;
            $interC->comTel=$com->u_tel;
            $interC->comName=$com->u_name;
            $interC->cAddress=$com_b->caddress;

            $interS->stuName=$stu->u_name;
            $interS->stuNum=$stu->account;
            $interS->comTel=$com->u_tel;
            $interS->comName=$com->u_name;
            $interS->cAddress=$com_b->caddress;

            if($inCQ && $inSQ && $stu && $com_b){
                return ['InterviewComList'=>$interC,'InterviewStuList'=>$interS];
            }else{
                return '取得訪談紀錄失敗';
            }
        }else{
            return '取得訪談紀錄失敗';
        }

    }

    public function teacherCreateComInterview_ser($re)
    {
        $InterviewCom = new InterviewComEloquent();
        $InterviewCom->SCid = $re['SCid'];
        $InterviewCom->insCDate = $re['insCDate'];
        $InterviewCom->insCNum = $re['insCNum'];
        $InterviewCom->insComName = $re['insComName'];
        $InterviewCom->insComTel = $re['insComTel'];
        $InterviewCom->insAddress = $re['insAddress'];
        $InterviewCom->insCVisitWay = $re['insCVisitWay'];
        $InterviewCom->insCAns = $re['insCAns'];
        $InterviewCom->insCQuestionVer = $re['insCQuestionVer'];
        $InterviewCom->insCComments = $re['insCComments'];
        if (InterviewComEloquent::count() != 0) {
            return '訪談紀錄新增成功';
        } else {
            return '訪談紀錄新增失敗';
        }
    }
    public function teacherEditComInterview_ser($re)
    {
        $InterviewCom=InterviewComEloquent::where('insCId',$re['insCId'])->first();
        $InterviewCom->SCid = $re['SCid'];
        $InterviewCom->insCDate = $re['insCDate'];
        $InterviewCom->insCNum = $re['insCNum'];
        $InterviewCom->insComName = $re['insComName'];
        $InterviewCom->insComTel = $re['insComTel'];
        $InterviewCom->insAddress = $re['insAddress'];
        $InterviewCom->insCVisitWay = $re['insCVisitWay'];
        $InterviewCom->insCAns = $re['insCAns'];
        $InterviewCom->insCQuestionVer = $re['insCQuestionVer'];
        $InterviewCom->insCComments = $re['insCComments'];
        if (InterviewComEloquent::count() != 0) {
            return '訪談紀錄修改成功';
        } else {
            return '訪談紀錄修改失敗';
        }
    }
    public function teacherCreateStuInterview_ser($re)
    {
        $InterviewCom = new InterviewStuEloquent();
        $InterviewCom->SCid = $re['SCid'];
        $InterviewCom->insCDate = $re['insCDate'];
        $InterviewCom->insNum = $re['insNum'];
        $InterviewCom->insStuName = $re['insStuName'];
        $InterviewCom->insStuClass = $re['insStuClass'];
        $InterviewCom->insAddress = $re['insAddress'];
        $InterviewCom->insVisitWay = $re['insVisitWay'];
        $InterviewCom->insAns = $re['insAns'];
        $InterviewCom->insQuestionVer = $re['insQuestionVer'];
        $InterviewCom->insComments = $re['insComments'];
        if (InterviewStuEloquent::count() != 0) {
            return '訪談紀錄新增成功';
        } else {
            return '訪談紀錄新增失敗';
        }
    }
    public function teacherEditStuInterview_ser($re)
    {
        $InterviewCom=InterviewStuEloquent::where('insId',$re['insId'])->first();
        $InterviewCom->SCid = $re['SCid'];
        $InterviewCom->insCDate = $re['insCDate'];
        $InterviewCom->insNum = $re['insNum'];
        $InterviewCom->insStuName = $re['insStuName'];
        $InterviewCom->insStuClass = $re['insStuClass'];
        $InterviewCom->insAddress = $re['insAddress'];
        $InterviewCom->insVisitWay = $re['insVisitWay'];
        $InterviewCom->insAns = $re['insAns'];
        $InterviewCom->insQuestionVer = $re['insQuestionVer'];
        $InterviewCom->insComments = $re['insComments'];
        if (InterviewStuEloquent::count() != 0) {
            return '訪談紀錄修改成功';
        } else {
            return '訪談紀錄修改失敗';
        }
    }
}