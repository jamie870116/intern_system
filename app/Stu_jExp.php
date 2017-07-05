<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_jExp extends Model
{
    protected $table='stu_jExp';
    protected $primaryKey = 'jid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','semester','jobTitle'
    ];
}
