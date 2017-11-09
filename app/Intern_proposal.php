<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intern_proposal extends Model
{
    protected $table='intern_proposal';
    protected $primaryKey = 'IPId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','stuClass','comDepartment','comInstructor',
        'IPStart','IPEnd','IPGoal','IPDescription','IPTopic1','IPTopic1Start','IPTopic1End',
        'IPTopic2','IPTopic2Start','IPTopic2End','IPTopic3','IPTopic3Start','IPTopic3End',
        'IPTopic4','IPTopic4Start','IPTopic4End','IPTopic5','IPTopic5Start','IPTopic5End',
        'IPTopic6','IPTopic6Start','IPTopic6End','IPTopic7','IPTopic7Start','IPTopic7End',
        'IPTopic8','IPTopic8Start','IPTopic8End','IPInstruction','IPComPlanning','IPTeaPlanning',
        'IPIndicators','IPAssessment','IPFeedback','IPRead'
    ];
}
