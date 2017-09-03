<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_profile_pic extends Model
{
    protected $table='teacher_profile_pic';
    protected $primaryKey = 'tid';
    public  $timestamps=false;
    protected $fillable = [
        'tid','profilePic'
    ];
}
