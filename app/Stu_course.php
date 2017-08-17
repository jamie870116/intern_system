<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_course extends Model
{
    protected $table='stu_course';
    protected $primaryKey = 'SCid';
    public  $timestamps=true;

    protected $fillable = [
        'c_account','sid','tid','courseId','mid','assessmentStatus'
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

    //取得學生使用者資料
    public function user_stu()
    {
        return $this->hasOne('App\User','id','sid');
    }

    //取得企業使用者資料
    public function user_com()
    {
        return $this->hasOne('App\User','account','c_account');
    }

    //取得老師使用者資料
    public function user_tea()
    {
        return $this->hasOne('App\User','id','tid');
    }

    //取得履歷資料
    public function stu_basic()
    {
        return $this->hasOne('App\Stu_basic','sid','sid');
    }
}
