<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interviews extends Model
{
    protected $table='interviews';
    protected $primaryKey = 'inid';
    public  $timestamps=true;

    protected $fillable = [
        'mid','inaddress','intime',
        'jcontact_name' ,'jcontact_phone','jcontact_email','innotice'
    ];
}
