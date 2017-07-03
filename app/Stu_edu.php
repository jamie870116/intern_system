<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_edu extends Model
{
    protected $table='stu_edu';
    protected $primaryKey = 'edu_id';
    public  $timestamps=false;
	protected $fillable = [
		'sid','school','department','degree','enterDate','exitDate','graduate'
	];
}
