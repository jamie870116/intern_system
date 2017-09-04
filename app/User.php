<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'id';
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'u_name', 'email', 'password','u_status','u_tel','account','started','check_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password','check_code'
    ];

    public function scopeGetAll($query){
        return $query->where('u_status',0)->orWhere('u_status',1)->orWhere('u_status',2);
    }

    public function company(){
        return $this->hasOne('App\Com_basic','c_account','account');
    }

    public function jobOpens(){
        return $this->hasMany('App\Job_opening','c_account','account');
    }
}
