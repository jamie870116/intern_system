<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_stu_questions extends Model
{
    protected $table='interview_stu_questions';
    protected $primaryKey = 'insQId';
    public  $timestamps=true;

    protected $fillable = [
        'insQuestion','insQuestionVer'
    ];
}
