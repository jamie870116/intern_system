<?php

namespace App\Services;


use App\Stu_course;
use Carbon\Carbon;
use JWTAuth;

class GradeServices
{
    public function teacherGetStudentCourseList_ser($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_course::where('tid', $user->id)->where('sid',$re['sid'])->get();
        $courses=array();
        $courses[]=$re['sid'];
        if($stu_course){
            foreach ($stu_course as $s){
                $course = Stu_course::find($s->SCid)->courses;
                $course->courseStart=Carbon::parse($course->courseStart)->format('Y/m/d');
                $course->courseEnd=Carbon::parse($course->courseEnd)->format('Y/m/d');
                $courses[]=$course;
            }
            return $courses;
        }else{
            return '取得學生課程列表失敗';
        }

    }

    public function teacherGetStudentJournalList_ser($re){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $stu_course = Stu_course::where('tid', $user->id)->where('sid',$re['sid'])->where('courseId',$re['courseId'])->first();
        $journal= Stu_course::find($stu_course->SCid)->journals;
        if($journal){
            foreach ($journal as $j){
                $j->journalStart=Carbon::parse($j->journalStart)->format('Y/m/d');
                $j->journalEnd=Carbon::parse($j->journalEnd)->format('Y/m/d');
            }
            return $journal;
        }else{
            return '取得週誌列表失敗';
        }
    }

//    public function teacherScoreStudentJournal_ser($re){
//
//    }
}