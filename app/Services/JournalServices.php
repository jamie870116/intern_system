<?php

namespace App\Services;
use App\Journal as JournalEloquent;
use App\Station_Letter;
use App\Stu_course;
use Carbon\Carbon;


class JournalServices{

    public function studentEditJournal_ser($re)
    {

        $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
        $course=Stu_course::find($journal->SCid)->courses()->first();
        $student=Stu_course::find($journal->SCid)->user_stu()->first();
        $company=Stu_course::find($journal->SCid)->user_com()->first();
        $teacher=Stu_course::find($journal->SCid)->user_tea()->first();
        $now = Carbon::now();
        if($now < $course->courseEnd){
            $passDeadLine=false;
        }else{
            $passDeadLine=true;
        }
        if($passDeadLine){
            return '週誌已過期，無法修改';
        }else{
            if($journal->journalDetail_1==null){
                $st_letter=new Station_Letter();
                $st_letter->lStatus=13;
                $st_letter->lTitle='學生有新的週誌';
                $st_letter->lRecipient=$company->account;
                $st_letter->lRecipientName=$company->u_name;
                $st_letter->lContent=$student->u_name.'已填寫完週誌，請至學生管理頁面查看';
                $st_letter->lNotes='';
                $st_letter->save();

                $st_letter->lStatus=13;
                $st_letter->lTitle='學生有新的週誌';
                $st_letter->lRecipient=$teacher->account;
                $st_letter->lRecipientName=$teacher->u_name;
                $st_letter->lContent=$student->u_name.'已填寫完週誌，請至學生管理頁面查看';
                $st_letter->lNotes='';
                $st_letter->save();
            }
            $journal->journalDetail_1=$re['journalDetail_1'];
            $journal->journalDetail_2=$re['journalDetail_2'];
            $journal->journalStart=$re['journalStart'];
            $journal->journalEnd=$re['journalEnd'];
            $journal->journalInstructor=$re['journalInstructor'];
            $journal->save();
        }

        return '週誌輸入成功';
    }
}