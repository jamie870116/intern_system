<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_ability extends Model
{
    protected $table='stu_ability';
    protected $primaryKey = 'abiid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','abiType','abiName'
    ];


}



