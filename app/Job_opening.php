<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_opening extends Model
{
    protected $table='jopOpening';
    protected $primaryKey = 'joid';
    public  $timestamps=false;
    protected $fillable = [
        'c_account','jtypes','jduties','jdetails','jsalary','jcontact_name','jcontact_phone','jcontact_email','jstatus','jdelete_reason'
    ];
}
