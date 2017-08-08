<?php
namespace App\Services;
use App\Course as courseEloquent;
use App\Job_opening;
use App\Match as MatchEloquent;
use App\MatchLog as MatchLogEloquent;
use App\Stu_course as StuCourseEloquent;
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
        $course = courseEloquent::where('courseId',$re['courseId'])->first();
        if($course){
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
        }else{
            return '查無此課程';
        }

    }

    public function adminDeleteCourse_ser($re){
        $course = courseEloquent::where('courseId',$re['courseId'])->first();
        if($course){
            $course->delete();
            if (courseEloquent::count() != 0) {
                return '刪除課程資料成功';
            } else {
                return '刪除課程資料失敗';
            }
        }else{
            return '查無此課程';
        }
    }


    public function adminAddStudentToCourse_ser($re)
    {
        $match = MatchEloquent::where('mid', $re['mid'])->first();

        if ($match) {
            if ($match->mstatus == 9||$match->mstatus == 11) {
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
                $c=StuCourseEloquent::where('courseId',$re['courseId'])->where('sid',$match->sid)->first();
                if(!$c){
                    $stu_c=new StuCourseEloquent();
                    $stu_c->c_account=$match->c_account;
                    $stu_c->sid=$match->sid;
                    $stu_c->tid=$re['tid'];
                    $stu_c->courseId=$re['courseId'];
                    $stu_c->save();
                    if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0 && StuCourseEloquent::count()!=0) {
                        return '加入學生成功';
                    } else {
                        return '加入學生失敗';
                    }
                }else{
                    $c->c_account=$match->c_account;
                    $c->sid=$match->sid;
                    $c->tid=$re['tid'];
                    $c->courseId=$re['courseId'];
                    $c->save();
                    if (MatchEloquent::count() != 0 && MatchLogEloquent::count() != 0 && StuCourseEloquent::count()!=0) {
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

    public function adminDeleteStudentFromCourse_ser($SCId){
        $stu_c = StuCourseEloquent::where('courseId',$SCId)->first();
        if($stu_c){
            $stu_c->delete();
            if (StuCourseEloquent::count() != 0) {
                return '刪除課程資料成功';
            } else {
                return '刪除課程資料失敗';
            }
        }else{
            return '查無此課程';
        }
    }
}