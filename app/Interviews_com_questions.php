<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_com_questions extends Model
{
    protected $table='interview_com_questions';
    protected $primaryKey = 'insCQId';
    public  $timestamps=true;

    protected $fillable = [
        'insCQuestion','insCQuestionVer'
    ];
}
