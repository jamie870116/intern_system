<?php

namespace App\Services;


use App\Journal;
use App\Stu_course;
use App\Teacher_profile_pic;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use JWTAuth;
use Storage;

class GradeServices
{
    public function teacherUploadProfilePic_ser($request,$file)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $teaPic = Teacher_profile_pic::where('tid', $id)->first();
        if($teaPic){
            if ($file) {
                $img = Image::make($file);
                $img->resize(400, 300);
                $extension = $file->getClientOriginalExtension();
                $file_name = strval(time()) . str_random(5) . '_pro.' . $extension;

                if ($request->hasFile('profilePic')) {
                    if ($teaPic->profilePic != null) {

                        $file_path = 'public/user-upload/' . $teaPic->profilePic;
                        $file = Storage::exists('public/user-upload/' . $teaPic->profilePic);

//                    Log::error(Storage::exists('public/user-upload/' . $teaPic->profilePic));

                        if ($file) {
                            Storage::delete($file_path);
                        } else {
                            return 'failed';
                        }
                    }
                    $path = $request->file('profilePic')->storeAs(
                        'public/user-upload/', $file_name
                    );
                    //<img src='storage/user-upload/1501257619SWUxK.png' >
                    $teaPic->tid=$id;
                    $teaPic->profilePic = $file_name;
                    $teaPic->save();
                } else {
                    return "頭貼上傳失敗";
                }
            }else{
                return "頭貼上傳失敗";
            }
        }else{
            $teaPic= new Teacher_profile_pic();
            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $file_name = strval(time()) . str_random(5) . '_pro.' . $extension;

                if ($request->hasFile('profilePic')) {
                    $path = $request->file('profilePic')->storeAs(
                        'public/user-upload/', $file_name
                    );
                    //<img src='storage/user-upload/1501257619SWUxK.png' >
                    $teaPic->tid=$id;
                    $teaPic->profilePic = $file_name;
                    $teaPic->save();
                } else {
                    return "頭貼上傳失敗";
                }
            }else{
                return "頭貼上傳失敗";
            }
        }


        return "上傳頭貼成功";
    }


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

    public function teacherScoreStudentJournal_ser($re){
        $journal=Journal::find($re['journalID'])->first();
        if($journal){
            $journal->journalComments_teacher=$re['journalComments_teacher'];
            $journal->grade_teacher=$re['grade_teacher'];
            $journal->scoredTime_tea=Carbon::now();
            $journal->save();
            return '批改週誌成功';
        }else{
            return '查無此週誌';
        }
    }

    public function companyGetStudentJournalListBySCid_ser($re){

        $journal= Stu_course::findOrFail($re['SCid'])->journals;
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

    public function adminGetStudentJournalListBySCid_ser($re){

        $journal= Stu_course::findOrFail($re['SCid'])->journals;
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

    public function companyScoreStudentJournal_ser($re){
        $journal=Journal::find($re['journalID'])->first();
        if($journal){
            $journal->journalComments_ins=$re['journalComments_ins'];
            $journal->grade_ins=$re['grade_ins'];
            $journal->scoredTime_com=Carbon::now();
            $journal->save();
            return '批改週誌成功';
        }else{
            return '查無此週誌';
        }
    }
}