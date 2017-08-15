<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Interviews_stu_questions extends Model
{
    protected $table='interview_stu_questions';
    protected $primaryKey = 'insQId';
    public  $timestamps=true;

    protected $fillable = [
        'insQuestion','insQuestionVer'
    ];

    public function scopeGetLatestVersion($query){
        $ver = $query->orderBy('insQuestionVer','desc')->pluck('insQuestionVer');

        return $query->where('insQuestionVer',$ver[0]);
    }

    public function scopeGetVersion($query,$ver){
        return $query->where('insQuestionVer',$ver);
    }
}
