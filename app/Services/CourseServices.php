<?php

namespace App\Services;

use App\Assessment_Com;
use App\Assessment_Teach;
use App\Course as courseEloquent;
use App\Course;
use App\Intern_proposal;
use App\Interviews_com;
use App\Interviews_stu;
use App\Job_opening;
use App\Journal;
use App\Match as MatchEloquent;
use App\MatchLog as MatchLogEloquent;
use App\Reviews;
use App\Station_Letter;
use App\Stu_basic;
use App\Stu_course as StuCourseEloquent;
use App\Stu_course;
use Carbon\Carbon;
use Log;

class CourseServices
{
    public function adminCreateCourse_ser($re)
    {
        $course = new courseEloquent();
        $course->courseName = $re['courseName'];
        $course->courseJournal = $re['courseJournal'];
        $course->courseDetail = $re['courseDetail'];
        $course->courseStart = $re['courseStart'];
        $course->courseEnd = $re['courseEnd'];
        $course->courseSchoolSystem = $re['courseSchoolSystem'];
        $course->save();
        return $course->courseId;
    }

    public function adminEditCourseByCourseID_ser($re)
    {
        $course = courseEloquent::where('courseId', $re['courseId'])->first();
        if ($course) {
            $course->courseName = $re['courseName'];
            $course->courseJournal = $re['courseJournal'];
            $course->courseDetail = $re['courseDetail'];
            $course->courseStart = $re['courseStart'];
            $course->courseEnd = $re['courseEnd'];
            $course->courseSchoolSystem = $re['courseSchoolSystem'];
            $course->save();
            return '修改課程資料成功';
        } else {
            return '查無此課程';
        }

    }

    public function adminDeleteCourse_ser($re)
    {
        $course = courseEloquent::where('courseId', $re['courseId'])->first();
        if ($course) {
            $stu_c=Stu_course::where('courseId',$re['courseId'])->get();
            foreach ($stu_c as $s){
                $j=Stu_course::find($s->SCid)->journals()->delete();
                $s->delete();
            }
            $course->delete();
            return '刪除課程資料成功';
        } else {
            return '查無此課程';
        }
    }


    public function adminAddStudentToCourse_ser($re)
    {
        $h=0;
        $f=$re['firstDay'];
        $error=array();
        $m = explode(",", $re['mid']);
        foreach ($m as $mid){
            $match = MatchEloquent::where('mid', $mid)->first();

            if ($match) {
                if ($match->mstatus == 9 || $match->mstatus == 11) {
                    $c = StuCourseEloquent::where('courseId', $re['courseId'])->where('sid', $match->sid)->first();
                    $std=Stu_basic::where('sid', $match->sid)->first();
                    if (!$c) {
                        $course = Course::where('courseId', $re['courseId'])->first();
                        $schoolSystem=$course->courseSchoolSystem;
                        if($schoolSystem==$std->eTypes){
                            $match->mstatus = 11;
                            $match->tid = $re['tid'];
                            $jobOp = Job_opening::withTrashed()->where('joid', $match->joid)->first();
                            $jobOp->jNOP -= 1;
                            $jobOp->save();
                            $match->save();
                            $log = new MatchLogEloquent();//給企業信件->none
                            $log->mstatus = 11;
                            $log->mid = $mid;
                            $log->save();

                            $stu_c = new StuCourseEloquent();
                            $stu_c->c_account = $match->c_account;
                            $stu_c->sid = $match->sid;
                            $stu_c->tid = $re['tid'];
                            $stu_c->mid = $mid;
                            $stu_c->courseId = $re['courseId'];
                            $stu_c->save();

                            $student=Stu_course::find($stu_c->SCid)->user_stu()->first();
                            $company=Stu_course::find($stu_c->SCid)->user_com()->first();
                            $teacher=Stu_course::find($stu_c->SCid)->user_tea()->first();

                            if ($course) {
                                $first = $f;
                                for ($i = 0; $i <= $course->courseJournal; $i++) {
                                    if( $i == $course->courseJournal){
                                        $review=new Reviews();
                                        $review->reContent='';
                                        $review->SCid=$stu_c->SCid;
                                        $review->save();
                                        $in=new Intern_proposal();
                                        $in->SCid=$stu_c->SCid;
                                        $in->save();
                                    }else{
                                        $type=$jobOp->jtypes;
                                        if ($type == 0) {  //暑期
                                            $journal = new Journal();
                                            $journal->SCid = $stu_c->SCid;
                                            $journal->journalOrder = $i;
                                            if ($i == 0) {
                                                $journal->journalStart = Carbon::parse($first);
                                                $journal->journalEnd = Carbon::parse($first)->addWeeks(1)->subDay();

                                            } else {
                                                $journal->journalStart = Carbon::parse($first)->addWeeks($i);
                                                $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 1)->subDay();
                                            }
                                            $journal->save();

                                        } elseif ($type == 1||$type == 3) { //學期 工讀生
                                            $journal = new Journal();
                                            $journal->SCid = $stu_c->SCid;
                                            $journal->journalOrder = $i;
                                            if ($i == 0) {
                                                $journal->journalStart = Carbon::parse($first);
                                                $journal->journalEnd = Carbon::parse($first)->addWeeks(2)->subDay();

                                            } else {
                                                $journal->journalStart = Carbon::parse($first)->addWeeks($i + 2);
                                                $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 4)->subDay();
                                            }
                                            $journal->save();
                                        }
                                    }

                                }
                                $st_letter=new Station_Letter();
                                $st_letter->lStatus=11;
                                $st_letter->lTitle='媒合成功通知信';
                                $st_letter->lRecipient=$teacher->account;
                                $st_letter->lRecipientName=$teacher->u_name;
                                $st_letter->lContent='您的學生 '.$student->u_name.'成為您的指導實習生';
                                $st_letter->lNotes='';
                                $st_letter->save();

                                $st_letter=new Station_Letter();
                                $st_letter->lStatus=11;
                                $st_letter->lTitle='媒合成功通知信';
                                $st_letter->lRecipient=$student->account;
                                $st_letter->lRecipientName=$student->u_name;
                                $st_letter->lContent='您已加入'.$course->courseName.'課程，'.'該課程的實習指導老師為 '.$teacher->u_name;
                                $st_letter->lNotes='';
                                $st_letter->save();

                                $st_letter=new Station_Letter();
                                $st_letter->lStatus=11;
                                $st_letter->lTitle='媒合成功通知信';
                                $st_letter->lRecipient=$company->account;
                                $st_letter->lRecipientName=$company->u_name;
                                $st_letter->lContent=$student->u_name.'已成為'.$company->u_name.'的實習生';
                                $st_letter->lNotes='';
                                $st_letter->save();
                                $error[]= '加入成功';
                            } else {
//                            return '查不到課程';
                                $error[]='查不到課程';
                            }
                            $h++;
                        }else{
                            $error[]='學生 '.$std->chiName.' 學制錯誤';
                        }

                    } else {
//                        $c->c_account = $match->c_account;
//                        $c->sid = $match->sid;
//                        $c->tid = $re['tid'];
//                        $c->courseId = $re['courseId'];
//                        $c->save();
//                        $jo=Journal::where('SCid',$c->SCid)->get();
//                        foreach ($jo as $j){
//                            $j->delete();
//                        }
//
//                        $course = Course::where('courseId', $re['courseId'])->first();
//                        if ($course) {
//                            $first =$f;
//
//                            for ($i = 0; $i < $course->courseJournal; $i++) {
//                                Log::error($i);
//                                $type=$jobOp->jtypes;
//
//                                if ($type == 0) {  //暑期
//                                    $journal = new Journal();
//                                    $journal->SCid = $c->SCid;
//                                    $journal->journalOrder = $i+1;
//                                    if ($i == 0) {
//                                        $journal->journalStart = Carbon::parse($first);
//                                        $journal->journalEnd = Carbon::parse($first)->addWeeks(1)->subDay();
//
//                                    } else {
//                                        $journal->journalStart = Carbon::parse($first)->addWeeks($i);
//                                        $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 1)->subDay();
//                                    }
//                                    $journal->save();
//
//                                } elseif ($type == 1) { //學期
//                                    $journal = new Journal();
//                                    $journal->SCid = $c->SCid;
//                                    $journal->journalOrder = $i+1;
//                                    if ($i == 0) {
//                                        $journal->journalStart = Carbon::parse($first);
//                                        $journal->journalEnd = Carbon::parse($first)->addWeeks(2)->subDay();
//
//                                    } else {
//                                        $journal->journalStart = Carbon::parse($first)->addWeeks($i + 1);
//                                        $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 3)->subDay();
//                                    }
//                                    $journal->save();
//                                } else {
//                                    exit;
//                                }
//                            }
//                            $h++;
//                        } else {
//                            return '查不到課程';
//                        }
//                        return '學生已在此課程之中';
                        $error[]='學生 '.$std->chiName.' 已在此課程之中';
                    }

                } else {
                    $error[]='媒合編號 '. $mid.' 流程錯誤';
//                    return '流程錯誤';
                }

            } else {
                $error[]='媒合編號 '. $mid.' 查無此媒合資料';
//                return '查無此媒合資料';
            }

        }
        return $error;

    }

    public function adminDeleteStudentFromCourse_ser($SCId)
    {
        $stu_c = StuCourseEloquent::where('SCId', $SCId)->first();
        if ($stu_c) {
            $match = MatchEloquent::where('mid', $stu_c->mid)->first();
            $match->mstatus = 9;
            $match->save();
            $journal=Journal::where('SCId', $SCId)->first();
            $journal->delete();
            $ac=Assessment_Com::where('SCId', $SCId)->first();
            if($ac)
                $ac->delete();
            $at=Assessment_Teach::where('SCId', $SCId)->first();
            if($at)
            $at->delete();
            $it=Interviews_com::where('SCId', $SCId)->first();
            if($it)
            $it->delete();
            $is=Interviews_stu::where('SCId', $SCId)->first();
            if($is)
            $is->delete();
            $re=Reviews::where('SCId', $SCId)->first();
            if($re)
            $re->delete();
            $stu_c->delete();

            return '刪除課程資料成功';
        } else {
            return '查無此課程';
        }
    }
}