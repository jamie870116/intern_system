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

    public function scopeGetLatestVersion($query){
        $ver = $query->orderBy('insCQuestionVer','desc')->pluck('insCQuestionVer');

        return $query->where('insCQuestionVer',$ver[0]);
    }

    public function scopeGetVersion($query,$ver){
        return $query->where('insCQuestionVer',$ver);
    }
}
