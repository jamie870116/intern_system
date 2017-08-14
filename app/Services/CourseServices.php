<?php

namespace App\Services;

use App\Course as courseEloquent;
use App\Course;
use App\Job_opening;
use App\Journal;
use App\Match as MatchEloquent;
use App\MatchLog as MatchLogEloquent;
use App\Stu_course as StuCourseEloquent;
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
        $course->save();
        if (courseEloquent::count() != 0) {
            return '新增課程資料成功';
        } else {
            return '新增課程資料失敗';
        }
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
            $course->save();
            if (courseEloquent::count() != 0) {
                return '修改課程資料成功';
            } else {
                return '修改課程資料失敗';
            }
        } else {
            return '查無此課程';
        }

    }

    public function adminDeleteCourse_ser($re)
    {
        $course = courseEloquent::where('courseId', $re['courseId'])->first();
        if ($course) {
            $course->delete();
            if (courseEloquent::count() != 0) {
                return '刪除課程資料成功';
            } else {
                return '刪除課程資料失敗';
            }
        } else {
            return '查無此課程';
        }
    }


    public function adminAddStudentToCourse_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();

        if ($match) {
            if ($match->mstatus == 9 || $match->mstatus == 11) {
                $match->mstatus = 11;
                $match->tid = $re['tid'];
                $jobOp = Job_opening::where('joid', $match->joid)->first();
                $jobOp->jNOP -= 1;
                $jobOp->save();
                $match->save();
                $log = new MatchLogEloquent();//給企業信件->none
                $log->mstatus = 11;
                $log->mid = $re['mid'];
                $log->save();
                $c = StuCourseEloquent::where('courseId', $re['courseId'])->where('sid', $match->sid)->first();
                if (!$c) {
                    $stu_c = new StuCourseEloquent();
                    $stu_c->c_account = $match->c_account;
                    $stu_c->sid = $match->sid;
                    $stu_c->tid = $re['tid'];
                    $stu_c->mid = $re['mid'];
                    $stu_c->courseId = $re['courseId'];
                    $stu_c->save();
                    $course = Course::where('courseId', $re['courseId'])->first();
                    if ($course) {
                        $first = $re['firstDay'];
                        for ($i = 0; $i < $course->courseJournal; $i++) {
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

                            } elseif ($type == 1) { //學期
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
                    } else {
                        return '查不到課程';
                    }
                    if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0 && StuCourseEloquent::count() != 0) {
                        return '加入學生成功';
                    } else {
                        return '加入學生失敗';
                    }
                } else {
                    $c->c_account = $match->c_account;
                    $c->sid = $match->sid;
                    $c->tid = $re['tid'];
                    $c->courseId = $re['courseId'];
                    $c->save();
                    $jo=Journal::where('SCid',$c->SCid)->get();
                    foreach ($jo as $j){
                        $j->delete();
                    }

                    $course = Course::where('courseId', $re['courseId'])->first();
                    if ($course) {
                        $first = $re['firstDay'];

                        for ($i = 0; $i < $course->courseJournal; $i++) {
                            Log::error($i);
                            $type=$jobOp->jtypes;

                            if ($type == 0) {  //暑期
                                $journal = new Journal();
                                $journal->SCid = $c->SCid;
                                $journal->journalOrder = $i+1;
                                if ($i == 0) {
                                    $journal->journalStart = Carbon::parse($first);
                                    $journal->journalEnd = Carbon::parse($first)->addWeeks(1)->subDay();

                                } else {
                                    $journal->journalStart = Carbon::parse($first)->addWeeks($i);
                                    $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 1)->subDay();
                                }
                                $journal->save();

                            } elseif ($type == 1) { //學期
                                $journal = new Journal();
                                $journal->SCid = $c->SCid;
                                $journal->journalOrder = $i+1;
                                if ($i == 0) {
                                    $journal->journalStart = Carbon::parse($first);
                                    $journal->journalEnd = Carbon::parse($first)->addWeeks(2)->subDay();

                                } else {
                                    $journal->journalStart = Carbon::parse($first)->addWeeks($i + 1);
                                    $journal->journalEnd = Carbon::parse($first)->addWeeks($i + 3)->subDay();
                                }
                                $journal->save();
                            } else {
                                exit;
                            }

                        }
                    } else {
                        return '查不到課程';
                    }
                    if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0 && StuCourseEloquent::count() != 0) {
                        return '加入學生成功';
                    } else {
                        return '加入學生失敗';
                    }
                }

            } else {
                return '流程錯誤';
            }

        } else {
            return '查無此媒合資料';
        }
    }

    public function adminDeleteStudentFromCourse_ser($SCId)
    {
        $stu_c = StuCourseEloquent::where('courseId', $SCId)->first();
        if ($stu_c) {
            $match = MatchEloquent::where('mid', $stu_c->mid)->first();
            $match->mstatus = 9;
            $match->save();
            $stu_c->delete();

            if (StuCourseEloquent::count() != 0) {
                return '刪除課程資料成功';
            } else {
                return '刪除課程資料失敗';
            }
        } else {
            return '查無此課程';
        }
    }
}