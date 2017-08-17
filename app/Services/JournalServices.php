<?php

namespace App\Services;
use App\Journal as JournalEloquent;
use App\Stu_course;
use Carbon\Carbon;


class JournalServices{
    public function studentEditJournal_ser($re)
    {

        $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
        $course=Stu_course::find($journal->SCid)->courses()->first();
        $now = Carbon::now();
        if($now < $course->courseEnd){
            $passDeadLine=false;
        }else{
            $passDeadLine=true;
        }
        if($passDeadLine){
            return '週誌已過期，無法修改';
        }else{
            $journal->journalDetail_1=$re['journalDetail_1'];
            $journal->journalDetail_2=$re['journalDetail_2'];
            $journal->journalStart=$re['journalStart'];
            $journal->journalEnd=$re['journalEnd'];
            $journal->journalInstructor=$re['journalInstructor'];
            $journal->save();

            if (JournalEloquent::count() != 0) {
                return '週誌輸入成功';
            } else {
                return '週誌輸入失敗';
            }
        }

    }
}