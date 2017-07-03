<?php
namespace App\Services;

use Mail;
class registerService
{
	public static  function randomkeys($length){
		$key="";
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		for($i=0;$i<$length;$i++){
			$key .= $pattern{rand(0,35)};
		}
		return $key;
	}

	public static  function sendmail($mail,$code){
		$data = ['mail'=>$mail, 'code'=>$code];
		$flag=Mail::send('test.send', $data, function($message) use($data)
		{
			$message->to($data['mail'], $data['code'])->subject('會員驗證信');
		});

		return response()->json('sended',200);

	}
}