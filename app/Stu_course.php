<?php

namespace App;


use App\Match as MatchEloquent;
use Illuminate\Database\Eloquent\Model;

class Stu_course extends Model
{
    protected $table='stu_course';
    protected $primaryKey = 'SCid';
    public  $timestamps=true;

    protected $fillable = [
        'c_account','sid','tid','courseId'
    ];
    public function scopeGetTypeOfIntern($sid,$tid,$c_account)
    {
        $match = MatchEloquent::where('sid',$sid)->where('tid',$tid)->where('c_account',$c_account)->first();
        $jOp=Job_opening::where('joid',$match->joid)->first();
        return $jOp->jtypes;
    }
}
