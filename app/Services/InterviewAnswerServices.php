<?php

namespace App\Services;
use App\interviews_com as InterviewComEloquent;
use App\interviews_stu as InterviewStuEloquent;


class InterviewAnswerServices{
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