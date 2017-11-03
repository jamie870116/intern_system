<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2017/7/3
 * Time: 下午 10:33
 */

namespace App\Services;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_works as stuWorksEloquent;
use App\Stu_ability as stuAbilityEloquent;
use File;

use Intervention\Image\Facades\Image;
use JWTAuth;
use Log;
use Storage;


class ResumeServices
{
//新增履歷開始


    public function newJobExperienceById($re)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuJExp = new stuJExpEloquent($re);
        $stuJExp->sid = $id;

        $stuJExp->save();
        return $stuJExp->jid;

    }

    public function newWorksDataById($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuWor = new stuWorksEloquent($re);
        $stuWor->sid = $id;

        $stuWor->save();

        return $stuWor->wid;
    }

    public function newAbilityById($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuA = new stuAbilityEloquent($re);
        $stuA->sid = $id;

        $stuA->save();

        return $stuA->abiid;
    }

    //新增履歷結束

    //修改履歷開始
    public function editBasicDataById_ser($request, $file, $l_file)
    {

        $re = $request->all();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $stuBas = stuBasicEloquent::where('sid', $id)->first();

        if ($file) {
            $img = Image::make($file);
            $img->resize(400, 300);
            $extension = $file->getClientOriginalExtension();
            $file_name = strval(time()) . str_random(5) . '_pro.' . $extension;

            if ($request->hasFile('profilePic')) {
//                if ($stuBas->profilePic != null) {
//
//                    $file_path = 'public/user-upload/' . $stuBas->profilePic;
//                    $file = Storage::exists('public/user-upload/' . $stuBas->profilePic);
//
//                    Log::error(Storage::exists('public/user-upload/' . $stuBas->profilePic));
//
//                    if ($file) {
//                        Storage::delete($file_path);
//                    } else {
//                        return 'failed';
//                    }
//                }
                $path = public_path('storage/user-upload/' . $file_name);
                Image::make($file->getRealPath())->resize(400, 300)->save($path);
//                $path = $request->file('profilePic')->storeAs(
//                    'public/user-upload/', $file_name
//                );
                //<img src='storage/user-upload/1501257619SWUxK.png' >
                $stuBas->profilePic = $file_name;
            } else {
                return "頭貼上傳失敗";
            }
        }
        if ($l_file) {
            $extension = $l_file->getClientOriginalExtension();
            $file_name = strval(time()) . str_random(5) . '_lic.' . $extension;

            if ($request->hasFile('licenceFile')) {
                if ($stuBas->licenceFile != null) {

                    $file_path = 'public/user-upload/licences/' . $stuBas->licenceFile;
                    $l_file = Storage::exists('public/user-upload/licences/' . $stuBas->licenceFile);

                    Log::error(Storage::exists('public/user-upload/licences/' . $stuBas->licenceFile));

                    if ($l_file) {
                        Storage::delete($file_path);
                    } else {
                        return 'failed';
                    }
                }
                $path = $request->file('licenceFile')->storeAs(
                    'public/user-upload/licences/', $file_name
                );
                //<img src='storage/user-upload/licences/1501257619SWUxK.png' >
                $stuBas->licenceFile = $file_name;
            } else {
                return "證照檔案上傳失敗";
            }
        }
        if (isset($re['Oname'])) {
            $stuBas->Oname = $re['Oname'];
            $stuBas->OS = $re['OS'];
            $stuBas->OR = $re['OR'];
            $stuBas->OW = $re['OW'];
        } elseif ($re['OS']!=0 || $re['OR']!=0 || $re['OW']!=0)
            return '請填寫其他語言名稱';
        $stuBas->chiName = $re['chiName'];
        $user->u_name=$re['chiName'];
        $user->save();
        $stuBas->engName = $re['engName'];
        $stuBas->bornedPlace = $re['bornedPlace'];
        $stuBas->birthday = $re['birthday'];
        $stuBas->gender = $re['gender'];
        $stuBas->address = $re['address'];
        $stuBas->email = $re['email'];
        $stuBas->contact = $re['contact'];
        $stuBas->eTypes = $re['eTypes'];
        $stuBas->ES = $re['ES'];
        $stuBas->ER = $re['ER'];
        $stuBas->EW = $re['EW'];
        if (isset($re['TOEIC']))
            $stuBas->TOEIC = $re['TOEIC'];
        if (isset($re['TOEFL']))
            $stuBas->TOEFL = $re['TOEFL'];
        $stuBas->autobiography = $re['autobiography'];
        $stuBas->graduateYear = $re['graduateYear'];
        $stuBas->graduatedSchool = $re['graduatedSchool'];
        if (isset($re['department']))
            $stuBas->department = $re['department'];
        if (isset($re['section']))
            $stuBas->section = $re['section'];
        $stuBas->save();
        return '修改基本資料成功';
    }

    public function studentUploadProfilePic_ser($request, $file)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $stuBas = stuBasicEloquent::where('sid', $id)->first();

        if ($file) {
            $extension = $file->getClientOriginalExtension();
            $file_name = strval(time()) . str_random(5) . '_pro.' . $extension;
            $img = Image::make($file);
            $img->resize(400, 300);
            if ($request->hasFile('profilePic')) {
                if ($stuBas->profilePic != null) {

                    $file_path = 'public/user-upload/' . $stuBas->profilePic;
                    $file = Storage::exists('public/user-upload/' . $stuBas->profilePic);

                    Log::error(Storage::exists('public/user-upload/' . $stuBas->profilePic));

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
                $stuBas->profilePic = $file_name;
            } else {
                return "頭貼上傳失敗";
            }
        }
        $stuBas->save();
        return  $stuBas->profilePic;
    }


    public function deleteJobExperienceById_ser($re)
    {
        $stuJExp = stuJExpEloquent::where('jid', $re['jid'])->first();
        if ($stuJExp) {
            $stuJExp->delete();
            return '刪除工作資料成功';
        } else {
            return '查無此資料';
        }

    }


    public function deleteWorksDataById_ser($re)
    {
        $stuWor = stuWorksEloquent::where('wid', $re['wid'])->first();
        if ($stuWor) {
            $stuWor->delete();
            return '刪除作品資料成功';
        } else {
            return '查無此資料';
        }

    }

    public function deleteAbilityById_ser($re)
    {
        $stuA = stuAbilityEloquent::where('abiid', $re['abiid'])->first();
        if ($stuA) {
            $stuA->delete();
            return '刪除能力資料成功';
        } else {
            return '查無此資料';
        }

    }
    //修改履歷結束
}