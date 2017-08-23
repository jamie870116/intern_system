<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_Teach extends Model
{
    protected $table='assessment_teach';
    protected $primaryKey = 'asTId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','teacherGrade1','teacherGrade2','teacherGrade3',
        'teacherGrade4','teacherGrade5','teacherGrade6','teacherGrade7',
        'teacherGrade8','teacherGrade9','teacherGrade10','comment','totalScore'
    ];
}










