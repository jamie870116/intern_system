<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $table='match';
    protected $primaryKey = 'mid';
    public  $timestamps=true;
    protected $fillable = [
        'sid','c_account','tid','mfailedreason','mstatus','joid'
    ];

    public function scopeSortByUpdates_DESC($query)
    {
        return $query->orderby('updated_at','desc');
    }

    public function scopeSortByUpdates_ASC($query)
    {
        return $query->orderby('updated_at','asc');
    }

    //取得職缺資料
    public function jobOpen()
    {
        return $this->hasOne('App\Job_opening','joid','joid');
    }
}
