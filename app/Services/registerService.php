<?php
namespace App\Services;

use App\Jobs\SendEmail;

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

    public static  function sendmail($mail,$code,$u_name,$account){
        $data = ['mail'=>$mail, 'code'=>$code,'userName'=>$u_name,'account'=>$account];
        dispatch(new SendEmail($data));

        return response()->json('sended',200);

    }
}