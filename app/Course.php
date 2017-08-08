<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table='course';
    protected $primaryKey = 'courseId';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'courseName','courseJournal','courseDetail','courseStart',
        'courseEnd'
    ];
}
