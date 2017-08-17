<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_Com extends Model
{
    protected $table='assessment_com';
    protected $primaryKey = 'asId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','asStart','asEnd','asGrade1',
        'asGrade2','asGrade3','asGrade4','asGrade5',
        'asComment1','asComment2','asComment3','asComment4','asComment5',
        'comment','asSickLeave_days','asSickLeave_hours','asOfficialLeave_days','asOfficialLeave_hours',
        'asCasualLeave_days','asCasualLeave_hours','asMourningLeave_days','asMourningLeave_hours',
        'asAbsenteeism_days','asAbsenteeism_hours','asDepartment'
    ];

    //取得使用者資料
    public function stuCourse()
    {
        return $this->hasOne('App\Stu_course','SCid');
    }
}

