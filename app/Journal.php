<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table='journal';
    protected $primaryKey = 'journalID';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','journalOrder','journalDetail_1','journalDetail_2',
        'journalStart','journalEnd','journalInstructor','journalComments_ins',
        'journalComments_teacher','grade_ins','grade_teacher'
    ];
}
