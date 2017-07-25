<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchLog extends Model
{
    use SoftDeletes;

    protected $table='matchLog';
    protected $primaryKey = 'logid';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'mstatus','mid','mailDeadline',
        'readed','favourite'
    ];
}
