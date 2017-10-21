<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2017/10/19
 * Time: 下午 09:11
 */

namespace App\Services;


use App\Intern_proposal;
use App\Stu_course;
use Carbon\Carbon;

class Intern_proposalServices
{

    public function createProposalBySCid_ser($re){
        $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
        if($inP){
            return '已新增';
        }else{
            $in=new Intern_proposal($re);
            $in->save();
            return '新增實習計畫書成功';
        }
    }

    public function editProposalBySCid_ser($re){

        $course=Stu_course::find($re['SCid'])->courses()->first();
        $now = Carbon::now();
        if($now < $course->courseEnd){
            $passDeadLine=false;
        }else{
            $passDeadLine=true;
        }
        if($passDeadLine) {
            return '課程已過期，無法修改';
        }else{
            $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
            if($inP){
                $inP->stuClass=$re['stuClass'];
                $inP->comDepartment=$re['comDepartment'];
                $inP->comInstructor=$re['comInstructor'];
                $inP->IPStart=$re['IPStart'];
                $inP->IPEnd=$re['IPEnd'];
                $inP->IPGoal=$re['IPGoal'];
                $inP->IPDescription=$re['IPDescription'];
                $inP->IPTopic1=$re['IPTopic1'];
                $inP->IPTopic1Start=$re['IPTopic1Start'];
                $inP->IPTopic1End=$re['IPTopic1End'];
                $inP->IPTopic2=$re['IPTopic2'];
                $inP->IPTopic2Start=$re['IPTopic2Start'];
                $inP->IPTopic2End=$re['IPTopic2End'];
                $inP->IPTopic3=$re['IPTopic3'];
                $inP->IPTopic3Start=$re['IPTopic3Start'];
                $inP->IPTopic3End=$re['IPTopic3End'];
                $inP->IPTopic4=$re['IPTopic4'];
                $inP->IPTopic4Start=$re['IPTopic4Start'];
                $inP->IPTopic4End=$re['IPTopic4End'];
                $inP->IPTopic5=$re['IPTopic5'];
                $inP->IPTopic5Start=$re['IPTopic5Start'];
                $inP->IPTopic5End=$re['IPTopic5End'];
                $inP->IPTopic6=$re['IPTopic6'];
                $inP->IPTopic6Start=$re['IPTopic6Start'];
                $inP->IPTopic6End=$re['IPTopic6End'];
                $inP->IPTopic7=$re['IPTopic7'];
                $inP->IPTopic7Start=$re['IPTopic7Start'];
                $inP->IPTopic7End=$re['IPTopic7End'];
                $inP->IPTopic8=$re['IPTopic8'];
                $inP->IPTopic8Start=$re['IPTopic8Start'];
                $inP->IPTopic8End=$re['IPTopic8End'];
                $inP->IPInstruction=$re['IPInstruction'];
                $inP->IPComPlanning=$re['IPComPlanning'];
                $inP->IPTeaPlanning=$re['IPTeaPlanning'];
                $inP->IPIndicators=$re['IPIndicators'];
                $inP->IPAssessment=$re['IPAssessment'];
                $inP->IPFeedback=$re['IPFeedback'];

                $inP->save();
                return '修改實習計畫書成功';
            }else{

                return '找不到';
            }
        }

    }

}