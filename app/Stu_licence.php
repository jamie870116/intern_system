<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_licence extends Model
{
    protected $table='stu_licence';
    protected $primaryKey = 'lid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','agency','lname','ldate'
    ];
}
