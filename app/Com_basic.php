<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Com_basic extends Model
{
    use SoftDeletes;

    protected $table='com_basic';
    protected $primaryKey = 'c_account';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'c_account','ctypes','caddress','c_name',
        'cfax','cdeleteReason','cintroduction','cempolyee_num'
    ];
}
