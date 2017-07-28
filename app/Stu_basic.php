<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_basic extends Model
{
    protected $table='stu_basic';
    protected $primaryKey = 'sid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','chiName','engName','bornedPlace','nativePlace','birthday','gender','address','email','contact',
        'ES','ER','EW','TOEIC','TOEFL','autobiography','Oname','OS','OR','OW','eduSystem','graduateYear',
        'graduatedSchool','department','section','profilePic'
    ];


}
