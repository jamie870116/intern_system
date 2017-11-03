<?php

namespace App\Services;


use App\Intern_proposal;
use App\Journal;
use App\Reviews;
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
//                    if ($teaPic->profilePic != null) {
//
//                        $file_path = 'public/user-upload/' . $teaPic->profilePic;
//                        $file = Storage::exists('public/user-upload/' . $teaPic->profilePic);
//
////                    Log::error(Storage::exists('public/user-upload/' . $teaPic->profilePic));
//
//                        if ($file) {
//                            Storage::delete($file_path);
//                        } else {
//                            return 'failed';
//                        }
//                    }
                    $path = public_path('storage/user-upload/' . $file_name);
                    Image::make($file->getRealPath())->resize(400, 300)->save($path);
//                    $path = $request->file('profilePic')->storeAs(
//                        'public/user-upload/', $file_name
//                    );
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
            $reviews=Reviews::where('SCid',$stu_course->SCid)->first();
            $googleFrom='https://docs.google.com/forms/d/1E_AN52T7SrulZC3l29RhdWpohyDjAkDn76M3kmrKSZs/viewform?edit_requested=true';
            if($reviews) {
                $reviews->googleForm = $googleFrom;
                if ($reviews->reRead == 0)
                    $reviews->reRead = false;
                else
                    $reviews->reRead = true;
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;

                    $res=['journalList'=>$journal,'reviews'=>$reviews,'internProposal'=>$inP];
                    return $res;
                    }else{
                    $res=['journalList'=>$journal,'reviews'=>$reviews];
                    return $res;
                }

            }else{
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;
                    $res=['journalList'=>$journal,'reviews'=>'','internProposal'=>$inP,'googleFrom'=>$googleFrom];
                    return $res;
                }else{
                    $res=['journalList'=>$journal,'reviews'=>'','googleFrom'=>$googleFrom];
                    return $res;
                }

            }

        }else{
            return '取得週誌列表失敗';
        }
    }

    public function teacherScoreStudentJournal_ser($re){
        $journal=Journal::where('journalID',$re['journalID'])->first();
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
            $reviews=Reviews::where('SCid',$re['SCid'])->first();
            $googleFrom='https://docs.google.com/forms/d/1E_AN52T7SrulZC3l29RhdWpohyDjAkDn76M3kmrKSZs/viewform?edit_requested=true';
            if($reviews) {
                $reviews->googleForm = $googleFrom;
                if ($reviews->reRead == 0)
                    $reviews->reRead = false;
                else
                    $reviews->reRead = true;
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;
                    $res=['journalList'=>$journal,'reviews'=>$reviews,'internProposal'=>$inP];
                    return $res;
                }else{
                    $res=['journalList'=>$journal,'reviews'=>$reviews];
                    return $res;
                }

            }else{
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;
                    $res=['journalList'=>$journal,'reviews'=>'','internProposal'=>$inP,'googleFrom'=>$googleFrom];
                    return $res;
                }else{
                    $res=['journalList'=>$journal,'reviews'=>'','googleFrom'=>$googleFrom];
                    return $res;
                }
            }

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
            $reviews=Reviews::where('SCid',$re['SCid'])->first();
            $googleFrom='https://docs.google.com/forms/d/1E_AN52T7SrulZC3l29RhdWpohyDjAkDn76M3kmrKSZs/viewform?edit_requested=true';
            if($reviews) {
                $reviews->googleForm = $googleFrom;
                if ($reviews->reRead == 0)
                    $reviews->reRead = false;
                else
                    $reviews->reRead = true;
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;
                    $res=['journalList'=>$journal,'reviews'=>$reviews,'internProposal'=>$inP];
                    return $res;
                }else{
                    $res=['journalList'=>$journal,'reviews'=>$reviews];
                    return $res;
                }

            }else{
                $inP=Intern_proposal::where('SCid',$re['SCid'])->first();
                if($inP) {
                    $stu = Stu_course::find($re['SCid'])->user_stu()->first();
                    $com = Stu_course::find($re['SCid'])->user_com()->first();
                    $tea = Stu_course::find($re['SCid'])->user_tea()->first();
                    $inP->stuName = $stu->u_name;
                    $inP->stuNum = $stu->account;
                    $inP->teaName = $tea->u_name;
                    $inP->comName = $com->u_name;
                    $res=['journalList'=>$journal,'reviews'=>'','internProposal'=>$inP,'googleFrom'=>$googleFrom];
                    return $res;
                }else{
                    $res=['journalList'=>$journal,'reviews'=>'','googleFrom'=>$googleFrom];
                    return $res;
                }
            }

        }else{
            return '取得週誌列表失敗';
        }
    }

    public function companyScoreStudentJournal_ser($re){
        $journal=Journal::where('journalID',$re['journalID'])->first();
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