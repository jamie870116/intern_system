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

}
