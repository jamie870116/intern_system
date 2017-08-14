<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_stu extends Model
{
    protected $table='interview_stu';
    protected $primaryKey = 'insId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','insDate','insNum','insStuName'
        ,'insStuClass','insAddress','insVisitWay'
        ,'insAns','insQuestionVer','insComments'
    ];
}
