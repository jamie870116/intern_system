<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table='reviews';
    protected $primaryKey = 'reId';
    public  $timestamps=true;

    protected $fillable = [
        'SCid','reContent','reRead'
    ];

}
