<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_course extends Model
{
    protected $table='stu_course';
    protected $primaryKey = 'SCid';
    public  $timestamps=true;

    protected $fillable = [
        'c_account','sid','tid','courseId','mid'
    ];

    //取得課程資料
    public function courses()
    {
        return $this->belongsTo('App\Course','courseId','courseId');
    }

    //取得週誌列表
    public function journals()
    {
        return $this->hasMany('App\Journal','SCid','SCid');
    }

    //取得課程資料
    public function match()
    {
        return $this->belongsTo('App\Match','mid','mid');
    }

    //取得實習心得
    public function reviews()
    {
        return $this->hasOne('App\Reviews','','SCid');
    }
}
