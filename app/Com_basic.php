<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Com_basic extends Model
{
    use SoftDeletingTrait;

    protected $table='com_basic';
    protected $primaryKey = 'c_account';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'c_account','ctypes','caddress',
        'cfax','cdeleteReason','tmiestamps'
    ];
}