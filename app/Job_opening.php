<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_opening extends Model
{
	use SoftDeletingTrait;

    protected $table='jopOpening';
    protected $primaryKey = 'joid';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'c_account','jtypes','jduties',
        'jdetails','jsalary','jcontact_name'
        ,'jcontact_phone','jcontact_email'
        ,'jstatus','jdelete_reason'
    ];
}
