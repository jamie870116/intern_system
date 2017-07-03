<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_relatives extends Model
{
    protected $table='stu_relatives';
    protected $primaryKey = 'rid';
    public  $timestamps=false;
	protected $fillable = [
		'sid','rType','rName','rAge','rEdu','rJob'
	];
}
