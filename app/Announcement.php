<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table='announcement';
    protected $primaryKey = 'anId';
    public  $timestamps=true;

    protected $fillable = [
        'anTittle','anContent','anFile'
    ];

    public function scopeOrderByUpdated_DESC($query){
        return $query->orderBy('updated_at','desc');
    }

}
