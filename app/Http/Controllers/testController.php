<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use View;

class testController extends Controller
{
    public function showForm(){

        return View::make('test.uploadTest');
    }

    public function iconUpload(Request $request)
    {

        $file = $request->file('user_icon_file');
        if($file){
            $extension = $file->getClientOriginalExtension();
            $file_name = strval(time()).str_random(5).'.'.$extension;

            $destination_path = public_path().'/user-upload/';

            if ($request->hasFile('user_icon_file')) {
                $upload_success = $file->move($destination_path, $file_name);
                echo  "<img src='user-upload/".$file_name."' >" ;
            } else {
                echo "img upload failed!";
            }
        }else{
            echo '未選擇檔案';
        }



    }
}
