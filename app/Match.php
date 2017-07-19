<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table='match';
    protected $primaryKey = 'mid';
    public  $timestamps=true;
    protected $fillable = [
        'sid','c_account','tid','mfailedreason','mstatus','joid'
    ];

}
