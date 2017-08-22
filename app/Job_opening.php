<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job_opening extends Model
{
    use SoftDeletes;

    protected $table='jopOpening';
    protected $primaryKey = 'joid';
    protected $dates = ['deleted_at'];
    public  $timestamps=true;

    protected $fillable = [
        'c_account','jtypes','jduties','c_name',
        'jdetails','jsalary_up','jcontact_name','jsalary_low','jaddress','jdeadline','jNOP'
        ,'jcontact_phone','jcontact_email','jEndDutyTime','jStartDutyTime'
        ,'jdelete_reason'
    ];

    public function scopeGetAll($query)
    {
        $now=Carbon::now();
        $query->where('jdeadline','>',$now)->where('jNOP','>',0);
        return ;
    }

    public function scopeByTypes($query,$type)
    {
        if($type==-1){
            return $query;
        }else{
            return $query->where('jtypes',$type);
        }

    }

    public function scopeSortByUpdates_DESC($query)
    {
        return $query->orderby('joid','desc');
    }

    public function scopeSortByUpdates_ASC($query)
    {
        return $query->orderby('joid','asc');
    }

    public function scopeSortBySalary_DESC($query)
    {
        return $query->orderby('jsalary_low','desc');
    }
    public function scopeSortBySalary_ASC($query)
    {
        return $query->orderby('jsalary_low','asc');
    }

}
