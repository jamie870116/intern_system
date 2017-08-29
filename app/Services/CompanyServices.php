<?php

namespace App\Services;


use App\Com_basic as comEloquent;
use App\User as userEloquent;
use App\User;
use File;
use JWTAuth;
use Log;
use Storage;

class CompanyServices
{


    public function editCompanyDetails_ser($request, $file)
    {
        $re = $request->all();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $com = comEloquent::where('c_account', $user->account)->first();
        if ($file) {
//            $size = File::size($file);
//            $data = getimagesize($file);
//            $height = $data[0];
//            $weight = $data[1];
//            if ($size <= 1024) {
//                if ($height > 500 || $weight > 500) {
//                    return '圖片太大囉，最長的一邊要小於500';
//                } else {
//
//                }
//            } else {
//                return '圖片太大囉，要小於1MB';
//            }
            $extension = $file->getClientOriginalExtension();
            $file_name = strval(time()) . str_random(5) . '_pro.' . $extension;
            if ($request->hasFile('profilePic')) {
                if ($com->profilePic != null) {

                    $file_path = 'public/user-upload/' . $com->profilePic;
                    $file = Storage::exists('public/user-upload/' . $com->profilePic);
                    Log::error($com->profilePic);
                    if ($file) {
                        Storage::delete($file_path);
                    } else {
                        return 'failed';
                    }
                }
                $path = $request->file('profilePic')->storeAs(
                    'public/user-upload/', $file_name
                );
                //<img src='storage/user-upload/1501257619SWUxK.png' >
                $com->profilePic = $file_name;
            } else {
                return "頭貼上傳失敗";
            }


        }
        $user->u_name = $re['c_name'];
        $user->u_tel = $re['u_tel'];
        $user->save();
        $com->ctypes = $re['ctypes'];
        $com->c_name = $re['c_name'];
        $com->caddress = $re['caddress'];
        $com->cfax = $re['cfax'];
        $com->cintroduction = $re['cintroduction'];
        $com->cempolyee_num = $re['cempolyee_num'];
        $com->save();
        return '修改廠商資料成功';
    }

    public function adminDeleteCompany_ser($re)
    {
        $com = comEloquent::where('c_account', $re['c_account'])->first();
        $user = userEloquent::where('account', $re['c_account'])->first();
        $com->cdeleteReason = $re['cdeleteReason'];
        $com->save();
        $com->delete();
        $user->started = 2;

        $com->save();
        return '刪除廠商成功';
    }

    //依帳號查詢廠商資料
    public function getCompanyDetailsByAccount_ser($re)
    {
        $com = comEloquent::where('c_account', $re['c_account'])->first();
        $u = User::where('account', $re['c_account'])->first();
        if ($com && $u) {
            $com->tel = $u->u_tel;
            return $com;
        } else {
            return '取得廠商失敗';
        }
    }
}
