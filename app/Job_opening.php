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
        'c_account','jtypes','jduties',
        'jdetails','jsalary_up','jcontact_name','jsalary_low','jaddress','jdeadline','jNOP'
        ,'jcontact_phone','jcontact_email'
        ,'jdelete_reason'
    ];

    public function scopeGetAll($query)
    {
        $now=Carbon::now();
        return $query->where('jdeadline','>',$now);
    }

    public function scopeByTypes($query,$type)
    {
        if($type>1){
            return $query;
        }else{
            return $query->where('jtypes',$type);
        }

    }

    public function scopeSortByUpdates_DESC($query)
    {
        return $query->orderby('updated_at','desc');
    }

    public function scopeSortByUpdates_ASC($query)
    {
        return $query->orderby('updated_at','asc');
    }

    public function scopeSortBySalary_DESC($query)
    {
        return $query->orderby('jsalary_up','desc');
    }
    public function scopeSortBySalary_ASC($query)
    {
        return $query->orderby('jsalary_up','asc');
    }

}
