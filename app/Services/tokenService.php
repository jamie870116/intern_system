<?php
namespace App\Services;

use App\Tokens as TokensEloquent;

class tokenService
{
	public static function token_gaintime($mail,$code){
		$token=TokensEloquent::where('id',Auth::id())->where('types',0)->first();
		$token->updated_at=date('Y-m-d H:i:s');
		$token->save();
		return 0;
	}
}