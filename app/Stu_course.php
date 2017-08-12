<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_course extends Model
{
    protected $table='stu_course';
    protected $primaryKey = 'SCid';
    public  $timestamps=true;

    protected $fillable = [
        'c_account','sid','tid','courseId'
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
}
