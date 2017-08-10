<?php

namespace App\Services;
use App\Journal as JournalEloquent;


class JournalServices{
    public function studentEditJournal_ser($re)
    {
        $journal=JournalEloquent::where('journalID',$re['journalID'])->first();
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