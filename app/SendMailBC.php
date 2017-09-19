<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendMailBC extends Model
{

    protected $table='send_mail_bc';
    protected $primaryKey = 'slId';
    public  $timestamps=true;

    protected $fillable = [
        'lStatus','lSender',
        'lRecipient','lTitle',
        'lContent','lNotes',
        'lSenderName','lRecipientName',
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
