<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    protected $table='tokens';
    protected $primaryKey = 'token';
	protected $fillable = [
		'token','id','types','updated_at'
	];
}
