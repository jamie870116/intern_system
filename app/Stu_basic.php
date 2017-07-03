<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stu_basic extends Model
{
    protected $table='stu_basic';
    protected $primaryKey = 'sid';
    public  $timestamps=false;
	protected $fillable = [
		'sid','chiName','engName','bornedPlace','nativePlace','brithday','gender','height','weight','bloodtype','address','email','contact','CL','CS','CR','CW','EL','ES','ER','EW','TL','TS','dataBase','programmingLanguage','webDesign','document','imageProcessing','drawingSoftware','animation','OS','musicEditor'
	];

}
