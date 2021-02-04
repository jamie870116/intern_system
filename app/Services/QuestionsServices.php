<?php

namespace App\Services;

use App\Interviews_com_questions;
use App\Interviews_stu_questions;
use Log;

class QuestionsServices
{

    public function getInterviewsStuQuestionsByVer_ser($ver)
    {
        $inSQ = Interviews_stu_questions::GetVersion($ver)->get();
        if ($inSQ != null) {
            return $inSQ;
        } else {
            return '取得失敗';
        }
    }

    public function getInterviewsComQuestionsByVer_ser($ver)
    {
        $inCQ = Interviews_com_questions::GetVersion($ver)->get();
        if ($inCQ != null) {
            return $inCQ;
        } else {
            return '取得失敗';
        }
    }

    public function createNewStuQuestion_ser($question)
    {
        $in = Interviews_stu_questions::GetLatestVersion()->first();
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver = $in->insQuestionVer + 1;
            foreach ($inSQ as $i) {
                $newQ = new Interviews_stu_questions();
                $newQ->insQuestion = $i->insQuestion;
                $newQ->insQuestionVer = $ver;
                $newQ->save();
            }
            $newQ = new Interviews_stu_questions();
            $newQ->insQuestionVer = $ver;
            $newQ->insQuestion = $question['insQuestion'];
            $newQ->insAnswerType = $question['insAnswerType'];
            $newQ->save();

            return $newQ->insQId;
        } else {
            return array('找不到題目');
        }
    }

    public function createNewComQuestion_ser($question)
    {

        $in = Interviews_com_questions::GetLatestVersion()->first();
        $inSQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver = $in->insCQuestionVer + 1;
            foreach ($inSQ as $i) {
                $newQ = new Interviews_com_questions();
                $newQ->insCQuestion = $i->insCQuestion;
                $newQ->insCQuestionVer = $ver;
                $newQ->save();
            }
            $newQ = new Interviews_com_questions();
            $newQ->insCQuestionVer = $ver;
            $newQ->insCQuestion = $question['insCQuestion'];
            $newQ->insCAnswerType = $question['insCAnswerType'];

            $newQ->save();

            return $newQ->insCQId;
        } else {
            return array('找不到題目');
        }
    }

    //editNewStuQuestion_ser
    public function editNewStuQuestion_ser($re)
    {
        $in = Interviews_stu_questions::GetLatestVersion()->first();
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        $insQIds = explode('*', $re['insQId']);
        $insQuestions = explode('*', $re['insQuestion']);
        $insAnswerTypes = explode('*', $re['insAnswerType']);
        $c = count($insQIds);
        $q=array();

        if ($in && $inSQ) {

            $ver = $in->insQuestionVer + 1;
//            foreach ($inSQ as $i) {
//                for ($j = 0; $j < $c; $j++) {
//                    if ($i->insQId == $insQIds[$j]) {
//
//                        $newQ = new Interviews_stu_questions();
//                        $newQ->insQuestion =  $insQuestions[$j];
//                        $newQ->insAnswerType =  $insAnswerTypes[$j];
//                        $newQ->insQuestionVer = $ver;
//                        $newQ->save();
//                    } else {
//
//                       $q[]=$i->insQId;
//                    }
//                }
//            }
           $id=array();
           $eId=array();
           foreach ($inSQ as $i) {
            if(!in_array($i->insQId,$insQIds)){
                $eId[]= $i->insQId;
            }else{
            	$id[]= $i->insQId;
            }
           }

            for ($j = 0; $j < $c; $j++) {
                    if (in_array( $insQIds[$j],$id)) {
                        $newQ = new Interviews_stu_questions();
                        $newQ->insQuestion = $insQuestions[$j];
                        $newQ->insAnswerType = $insAnswerTypes[$j];
                        $newQ->insQuestionVer = $ver;
                        $newQ->save();
                    }
            }
            foreach ($eId as $qu){
                    $inq=Interviews_stu_questions::where('insQId',$qu)->first();
                    $newQ = new Interviews_stu_questions();
                    $newQ->insQuestion = $inq->insQuestion;
                    $newQ->insAnswerType = $inq->insAnswerType;
                    $newQ->insQuestionVer = $ver;
                    $newQ->save();
            }
            Log::error($id);
            Log::error($eId);

            return '學生訪談題目修改成功';
            // return $id;
        } else {
            return array('找不到題目');
        }
    }

    //
    public function deleteStuQuestion_ser($re)
    {
        $in = Interviews_stu_questions::GetLatestVersion()->first();
        $inSQ = Interviews_stu_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver = $in->insQuestionVer + 1;
            foreach ($inSQ as $i) {
                if ($i->insQId == $re['insQId']) {
                    $i->delete();
                } else {
                    $newQ = new Interviews_stu_questions();
                    $newQ->insQuestion = $i->insQuestion;
                    $newQ->insQuestionVer = $ver;
                    $newQ->save();
                }
            }

            return '刪除學生訪談題目成功';
        } else {
            return array('找不到題目');
        }
    }

    public function editNewComQuestion_ser($re)
    {
        $in = Interviews_com_questions::GetLatestVersion()->first();
        $inSQ = Interviews_com_questions::GetLatestVersion()->get();
        $insCQId = explode('*', $re['insCQId']);
        $insCQuestion = explode('*', $re['insCQuestion']);
        $insCAnswerType = explode('*', $re['insCAnswerType']);
        $c = count($insCQId);
        $q=array();
        if ($in && $inSQ) {
            $ver = $in->insCQuestionVer + 1;

			$id=array();
           $eId=array();
           foreach ($inSQ as $i) {
            if(!in_array($i->insCQId,$insCQId)){
                $eId[]= $i->insCQId;
            }else{
            	$id[]= $i->insCQId;
            }
           }
            for ($j = 0; $j < $c; $j++) {
                    if (in_array( $insCQId[$j],$id)) {
                       $newQ = new Interviews_com_questions();
                        $newQ->insCQuestion = $insCQuestion[$j];
                        $newQ->insCAnswerType = $insCAnswerType[$j];
                        $newQ->insCQuestionVer = $ver;
                        $newQ->save();
                    }
            }
            foreach ($eId as $qu){
                    $inq=Interviews_com_questions::where('insQId',$qu)->first();
                    $newQ = new Interviews_com_questions();
                    $newQ->insCQuestion = $inq->insCQuestion;
                    $newQ->insCAnswerType = $inq->insCAnswerType;
                    $newQ->insCQuestionVer = $ver;
                    $newQ->save();
            }

            return "企業訪談題目修改成功";
        } else {
            return array('找不到題目');
        }
    }

    public function deleteComQuestion_ser($re)
    {
        $in = Interviews_com_questions::GetLatestVersion()->first();
        $inSQ = Interviews_com_questions::GetLatestVersion()->get();
        if ($in && $inSQ) {
            $ver = $in->insCQuestionVer + 1;
            foreach ($inSQ as $i) {
                if ($i->insCQId == $re['insCQId']) {
                    $i->delete();
                } else {
                    $newQ = new Interviews_com_questions();
                    $newQ->insCQuestion = $i->insCQuestion;
                    $newQ->insCQuestionVer = $ver;
                    $newQ->save();
                }
            }

            return '企業訪談題目刪除成功';
        } else {
            return array('找不到題目');
        }
    }

}