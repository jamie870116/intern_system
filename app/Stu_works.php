<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_works extends Model
{
    protected $table='stu_works';
    protected $primaryKey = 'wid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','wName','wLink','wCreatedDate'
    ];
}
