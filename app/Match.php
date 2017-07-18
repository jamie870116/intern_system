<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table='match';
    protected $primaryKey = 'mid';
    public  $timestamps=false;
    protected $fillable = [
        'sid','cid','tid','mfailedreason'
    ];
}
