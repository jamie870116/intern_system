<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station_Letter extends Model
{
    use SoftDeletes;

    protected $table='station_letter';
    protected $primaryKey = 'slId';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'lStatus','lSender',
        'lRecipient','lTitle',
        'lContent','lNotes',
        'read','favourite',
    ];


    public function scopeSortByUpdates_DESC($query)
    {
        return $query->orderby('updated_at','desc');
    }

    public function scopeSortByUpdates_ASC($query)
    {
        return $query->orderby('updated_at','asc');
    }
}
