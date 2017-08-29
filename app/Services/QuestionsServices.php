<?php
namespace App\Services;

use App\Interviews_com_questions;
use App\Interviews_stu_questions;

class QuestionsServices
{

    public function getInterviewsStuQuestionsByVer_ser($ver){
        $inSQ=Interviews_stu_questions::GetVersion($ver)->get();
        if($inSQ!=null){
            return $inSQ;
        }else{
            return '取得失敗';
        }
    }

    public function getInterviewsComQuestionsByVer_ser($ver){
        $inCQ=Interviews_com_questions::GetVersion($ver)->get();
        if($inCQ!=null){
            return $inCQ;
        }else{
            return '取得失敗';
        }
    }

    public function createNewStuQuestion_ser($question){
        $in = Interviews_stu_questions::GetLatestVersion()->first();
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver=$in->insQuestionVer+1;
            foreach ($inSQ as $i){
                $newQ=new Interviews_stu_questions();
                $newQ->insQuestion=$i->insQuestion;
                $newQ->insQuestionVer=$ver;
                $newQ->save();
            }
            $newQ=new Interviews_stu_questions();
            $newQ->insQuestionVer=$ver;
            $newQ->insQuestion=$question;
            $newQ->save();

            return '學生訪談題目新增成功';
        } else {
            return array('找不到題目');
        }
    }

    public function createNewComQuestion_ser($question){

        $in = Interviews_com_questions::GetLatestVersion()->first();
        $inSQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver=$in->insCQuestionVer+1;
            foreach ($inSQ as $i){
                $newQ=new Interviews_com_questions();
                $newQ->insCQuestion=$i->insCQuestion;
                $newQ->insCQuestionVer=$ver;
                $newQ->save();
            }
            $newQ=new Interviews_com_questions();
            $newQ->insCQuestionVer=$ver;
            $newQ->insCQuestion=$question;
            $newQ->save();

            return '學生訪談題目新增成功';
        } else {
            return array('找不到題目');
        }
    }

    //editNewStuQuestion_ser
    public function editNewStuQuestion_ser($re){
        $in = Interviews_stu_questions::GetLatestVersion()->first();
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver=$in->insQuestionVer+1;
            foreach ($inSQ as $i){
                if($i->insQId==$re['insQId']){
                    $newQ=new Interviews_stu_questions();
                    $newQ->insQuestion=$re['insQuestion'];
                    $newQ->insQuestionVer=$ver;
                    $newQ->save();
                }else{
                    $newQ=new Interviews_stu_questions();
                    $newQ->insQuestion=$i->insQuestion;
                    $newQ->insQuestionVer=$ver;
                    $newQ->save();
                }
            }

            return '學生訪談題目修改成功';
        } else {
            return array('找不到題目');
        }
    }

    public function editNewComQuestion_ser($re){
        $in = Interviews_com_questions::GetLatestVersion()->first();
        $inSQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver=$in->insCQuestionVer+1;
            foreach ($inSQ as $i){
                if($i->insCQId==$re['insCQId']){
                    $newQ=new Interviews_com_questions();
                    $newQ->insCQuestion=$re['insCQuestion'];
                    $newQ->insCQuestionVer=$ver;
                    $newQ->save();
                }else{
                    $newQ=new Interviews_com_questions();
                    $newQ->insCQuestion=$i->insCQuestion;
                    $newQ->insCQuestionVer=$ver;
                    $newQ->save();
                }
            }

            return '企業訪談題目修改成功';
        } else {
            return array('找不到題目');
        }
    }

}