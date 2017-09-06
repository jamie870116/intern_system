<?php

namespace App\Services;


use App\Station_Letter;
use Carbon\Carbon;
use JWTAuth;
use App\Assessment_Com;
use App\Stu_course as Stu_courseEloquent;

class Assessment_ComServices{

    public function companyCreateAssessment_ser($re)
    {
        $Assessment_Com = new Assessment_Com();
        $Assessment_Com->SCid = $re['SCid'];
        $Assessment_Com->asStart = $re['asStart'];
        $Assessment_Com->asEnd = $re['asEnd'];
        $Assessment_Com->asDepartment = $re['asDepartment'];
        $Assessment_Com->asStuName = $re['asStuName'];
        $Assessment_Com->asComName = $re['asComName'];
        $Assessment_Com->asGrade1 = $re['asGrade1'];
        $Assessment_Com->asGrade2 = $re['asGrade2'];
        $Assessment_Com->asGrade3 = $re['asGrade3'];
        $Assessment_Com->asGrade4 = $re['asGrade4'];
        $Assessment_Com->asGrade5 = $re['asGrade5'];
        $Assessment_Com->asComment1 = $re['asComment1'];
        $Assessment_Com->asComment2 = $re['asComment2'];
        $Assessment_Com->asComment3 = $re['asComment3'];
        $Assessment_Com->asComment4 = $re['asComment4'];
        $Assessment_Com->asComment5 = $re['asComment5'];
        $Assessment_Com->comment = $re['comment'];
        $Assessment_Com->asSickLeave_days = $re['asSickLeave_days'];
        $Assessment_Com->asSickLeave_hours = $re['asSickLeave_hours'];
        $Assessment_Com->asOfficialLeave_days = $re['asOfficialLeave_days'];
        $Assessment_Com->asOfficialLeave_hours = $re['asOfficialLeave_hours'];
        $Assessment_Com->asCasualLeave_days = $re['asCasualLeave_days'];
        $Assessment_Com->asCasualLeave_hours = $re['asCasualLeave_hours'];
        $Assessment_Com->asMourningLeave_days = $re['asMourningLeave_days'];
        $Assessment_Com->asMourningLeave_hours = $re['asMourningLeave_hours'];
        $Assessment_Com->asAbsenteeism_days = $re['asAbsenteeism_days'];
        $Assessment_Com->asAbsenteeism_hours = $re['asAbsenteeism_hours'];
        $Assessment_Com->save();
        $teacher=Stu_courseEloquent::find($re['SCid'])->user_tea()->first();
        $student=Stu_courseEloquent::find($re['SCid'])->user_stu()->first();
        $st_letter=new Station_Letter();
        $st_letter->lStatus=15;
        $st_letter->lTitle='廠商已經批改實習課程';
        $st_letter->lRecipient=$teacher->account;
        $st_letter->lRecipientName=$teacher->u_name;
        $st_letter->lContent='';
        $st_letter->lNotes='';
        $st_letter->save();
        $Stu_c=Stu_courseEloquent::where('SCid',$Assessment_Com->SCid)->first();
        if(Carbon::now() > $Stu_c->courseEnd){
            $Stu_c->assessmentStatus = 2;
            $Stu_c->save();
        }
        return $Assessment_Com->asId;
    }


    public function companyEditAssessment_ser($re)
    {

        $Assessment_Com=Assessment_Com::where('asId',$re['asId'])->first();
        $Stu_c=Stu_courseEloquent::where('SCid',$Assessment_Com->SCid)->first();
        if($Stu_c->assessmentStatus==3){
            return '老師已評分，無法再行修改，請聯絡系辦';
        }elseif($Assessment_Com){
            $Assessment_Com->asStart = $re['asStart'];
            $Assessment_Com->asEnd = $re['asEnd'];
            $Assessment_Com->asDepartment = $re['asDepartment'];
            $Assessment_Com->asStuName = $re['asStuName'];
            $Assessment_Com->asComName = $re['asComName'];
            $Assessment_Com->asGrade1 = $re['asGrade1'];
            $Assessment_Com->asGrade2 = $re['asGrade2'];
            $Assessment_Com->asGrade3 = $re['asGrade3'];
            $Assessment_Com->asGrade4 = $re['asGrade4'];
            $Assessment_Com->asGrade5 = $re['asGrade5'];
            $Assessment_Com->asComment1 = $re['asComment1'];
            $Assessment_Com->asComment2 = $re['asComment2'];
            $Assessment_Com->asComment3 = $re['asComment3'];
            $Assessment_Com->asComment4 = $re['asComment4'];
            $Assessment_Com->asComment5 = $re['asComment5'];
            $Assessment_Com->comment = $re['comment'];
            $Assessment_Com->asSickLeave_days = $re['asSickLeave_days'];
            $Assessment_Com->asSickLeave_hours = $re['asSickLeave_hours'];
            $Assessment_Com->asOfficialLeave_days = $re['asOfficialLeave_days'];
            $Assessment_Com->asOfficialLeave_hours = $re['asOfficialLeave_hours'];
            $Assessment_Com->asCasualLeave_days = $re['asCasualLeave_days'];
            $Assessment_Com->asCasualLeave_hours = $re['asCasualLeave_hours'];
            $Assessment_Com->asMourningLeave_days = $re['asMourningLeave_days'];
            $Assessment_Com->asMourningLeave_hours = $re['asMourningLeave_hours'];
            $Assessment_Com->asAbsenteeism_days = $re['asAbsenteeism_days'];
            $Assessment_Com->asAbsenteeism_hours = $re['asAbsenteeism_hours'];
            $Assessment_Com->save();
            return '修改成果評量成功';
        }else{
            return '找不到';
        }

    }
}