<?php

namespace App\Services;
use App\Assessment_Teach as Assessment_TeachEloquent;
use App\Counseling_result;
use App\Interviews_com;
use App\Interviews_stu;
use App\Stu_course as Stu_courseEloquent;


class Assessment_TeachServices{

    public function teacherCreateAssessment_ser($re)
    {
        $Stu_c=Stu_courseEloquent::where('SCid',$re['SCid'])->first();
        if($Stu_c->assessmentStatus = 2){
            $Stu_c->assessmentStatus = 3;
            $Assessment_Teachs=Assessment_TeachEloquent::where('SCid',$re['SCid'])->first();
            if($Assessment_Teachs){
                $Assessment_Teachs->teacherGrade1 = $re['teacherGrade1'];
                $Assessment_Teachs->teacherGrade2 = $re['teacherGrade2'];
                $Assessment_Teachs->teacherGrade3 = $re['teacherGrade3'];
                $Assessment_Teachs->teacherGrade4 = $re['teacherGrade4'];
                $Assessment_Teachs->teacherGrade5 = $re['teacherGrade5'];
                $Assessment_Teachs->teacherGrade6 = $re['teacherGrade6'];
                $Assessment_Teachs->teacherGrade7 = $re['teacherGrade7'];
                $Assessment_Teachs->teacherGrade8 = $re['teacherGrade8'];
                $Assessment_Teachs->teacherGrade9 = $re['teacherGrade9'];
                $Assessment_Teachs->teacherGrade10 = $re['teacherGrade10'];
                $Assessment_Teachs->comment = $re['comment'];
                $Assessment_Teachs->totalScore = $re['totalScore'];
                $Assessment_Teachs->save();
                return $Assessment_Teachs->asTId;
            }else{
                $CR=Counseling_result::where('SCid',$re['SCid'])->first();
                $IC=Interviews_com::where('SCid',$re['SCid'])->first();
                $IS=Interviews_stu::where('SCid',$re['SCid'])->first();
                if($CR && $IC && $IS){
                    $Assessment_Teach = new Assessment_TeachEloquent();
                    $Assessment_Teach->SCid = $re['SCid'];
                    $Assessment_Teach->teacherGrade1 = $re['teacherGrade1'];
                    $Assessment_Teach->teacherGrade2 = $re['teacherGrade2'];
                    $Assessment_Teach->teacherGrade3 = $re['teacherGrade3'];
                    $Assessment_Teach->teacherGrade4 = $re['teacherGrade4'];
                    $Assessment_Teach->teacherGrade5 = $re['teacherGrade5'];
                    $Assessment_Teach->teacherGrade6 = $re['teacherGrade6'];
                    $Assessment_Teach->teacherGrade7 = $re['teacherGrade7'];
                    $Assessment_Teach->teacherGrade8 = $re['teacherGrade8'];
                    $Assessment_Teach->teacherGrade9 = $re['teacherGrade9'];
                    $Assessment_Teach->teacherGrade10 = $re['teacherGrade10'];
                    $Assessment_Teach->comment = $re['comment'];
                    $Assessment_Teach->totalScore = $re['totalScore'];
                    $Assessment_Teach->save();
                    $Stu_c->save();
                    return $Assessment_Teach->asTId;
                }else{
                    return '尚有未填寫資料，故無法進行評量';
                }

            }

        }else{
            return '廠商尚未填寫資料，故無法進行評量';
        }

    }
    public function teacherEditAssessment_ser($re)
    {
        $Assessment_Teach=Assessment_TeachEloquent::where('asTId',$re['asTId'])->first();
        $Assessment_Teach->teacherGrade1 = $re['teacherGrade1'];
        $Assessment_Teach->teacherGrade2 = $re['teacherGrade2'];
        $Assessment_Teach->teacherGrade3 = $re['teacherGrade3'];
        $Assessment_Teach->teacherGrade4 = $re['teacherGrade4'];
        $Assessment_Teach->teacherGrade5 = $re['teacherGrade5'];
        $Assessment_Teach->teacherGrade6 = $re['teacherGrade6'];
        $Assessment_Teach->teacherGrade7 = $re['teacherGrade7'];
        $Assessment_Teach->teacherGrade8 = $re['teacherGrade8'];
        $Assessment_Teach->teacherGrade9 = $re['teacherGrade9'];
        $Assessment_Teach->teacherGrade10 = $re['teacherGrade10'];
        $Assessment_Teach->comment = $re['comment'];
        $Assessment_Teach->totalScore = $re['totalScore'];
        $Assessment_Teach->save();
        return $Assessment_Teach->asTId;

    }
}
