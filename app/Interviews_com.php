<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews_com extends Model
{
    protected $table='interview_com';
    protected $primaryKey = 'insCId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','insCDate','insCNum','insCVisitWay','insCAns',
        'insCQuestionVer','insCComments'
    ];
}
