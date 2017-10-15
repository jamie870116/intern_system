<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counseling_result extends Model
{
    protected $table='counseling_result';
    protected $primaryKey = 'counselingId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','counselingAddress','counselingDate','cTeacherName',
        'counselingContent','counselingPic'
    ];
}
