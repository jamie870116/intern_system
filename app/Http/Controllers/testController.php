<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Stu_basic as stuBasicEloquent;
use View;

class testController extends Controller
{
    public function showForm(){

        return View::make('test.uploadTest');
    }

    public function iconUpload(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuBas = stuBasicEloquent::where('sid', $id)->first();

        $file = $request->file('profilePic');
        if($file){

            $extension = $file->getClientOriginalExtension();//取得副檔名
            $file_name = strval(time()).str_random(5).'.'.$extension;

            if ($request->hasFile('profilePic')) {
                if($stuBas->profilePic!=null){
                    //刪除舊擋start
                    $file_path = 'public/user-upload/'.$stuBas->profilePic;
                    $file=Storage::exists('public/user-upload/'.$stuBas->profilePic);

                    if($file){
                        Storage::delete($file_path);
                    }else{
                        return 'failed';
                    }
                }
                //刪除舊擋end
                $path = $request->file('profilePic')->storeAs(
                    'public/user-upload/', $file_name
                ); //將上傳檔案存至 'public/user-upload/'
                //前端路徑  <img src='storage/user-upload/1501257619SWUxK.png' >
                $stuBas->profilePic=$file_name;
            } else {
                return "檔案上傳失敗";
            }
        }



    }
}
