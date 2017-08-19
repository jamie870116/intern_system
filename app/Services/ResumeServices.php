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
        if (stuJExpEloquent::count() != 0) {
            return $stuJExp->jid;
        } else {
            return '新增工作資料失敗';
        }

    }

    public function newWorksDataById($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuWor = new stuWorksEloquent($re);
        $stuWor->sid = $id;

        $stuWor->save();

        if (stuWorksEloquent::count() != 0) { //rowcount
            return $stuWor->wid;
        } else {
            return '新增作品資料失敗';
        }
    }

    public function newAbilityById($re){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stuA = new stuAbilityEloquent($re);
        $stuA->sid = $id;

        $stuA->save();

        if (stuAbilityEloquent::count() != 0) { //rowcount
            return $stuA->abiid;
        } else {
            return '新增能力資料失敗';
        }
    }

    //新增履歷結束

    //修改履歷開始
    public function editBasicDataById_ser($request,$file,$l_file)
    {

        $re = $request->all();
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $stuBas = stuBasicEloquent::where('sid', $id)->first();

        if($file){
        $extension = $file->getClientOriginalExtension();
        $file_name = strval(time()).str_random(5).'_pro.'.$extension;

        if ($request->hasFile('profilePic')) {
            if($stuBas->profilePic!=null){

                $file_path = 'public/user-upload/'.$stuBas->profilePic;
                $file=Storage::exists('public/user-upload/'.$stuBas->profilePic);

                Log::error(Storage::exists('public/user-upload/'.$stuBas->profilePic));

                if($file){
                    Storage::delete($file_path);
                }else{
                    return 'failed';
                }
            }
            $path = $request->file('profilePic')->storeAs(
                'public/user-upload/', $file_name
            );
            //<img src='storage/user-upload/1501257619SWUxK.png' >
            $stuBas->profilePic=$file_name;
        } else {
            return "頭貼上傳失敗";
        }
    }
        if($l_file){
            $extension = $l_file->getClientOriginalExtension();
            $file_name = strval(time()).str_random(5).'_lic.'.$extension;

            if ($request->hasFile('licenceFile')) {
                if($stuBas->profilePic!=null){

                    $file_path = 'public/user-upload/licences/'.$stuBas->licenceFile;
                    $l_file=Storage::exists('public/user-upload/licences/'.$stuBas->licenceFile);

                    Log::error(Storage::exists('public/user-upload/licences/'.$stuBas->licenceFile));

                    if($l_file){
                        Storage::delete($file_path);
                    }else{
                        return 'failed';
                    }
                }
                $path = $request->file('licenceFile')->storeAs(
                    'public/user-upload/licences/', $file_name
                );
                //<img src='storage/user-upload/licences/1501257619SWUxK.png' >
                $stuBas->licenceFile=$file_name;
            } else {
                return "證照檔案上傳失敗";
            }
        }
        $stuBas->chiName = $re['chiName'];
        $stuBas->engName = $re['engName'];
        $stuBas->bornedPlace = $re['bornedPlace'];
        $stuBas->birthday = $re['birthday'];
        $stuBas->gender = $re['gender'];
        $stuBas->address = $re['address'];
        $stuBas->email = $re['email'];
        $stuBas->contact = $re['contact'];
        $stuBas->ES = $re['ES'];
        $stuBas->ER = $re['ER'];
        $stuBas->EW = $re['EW'];
        $stuBas->TOEIC = $re['TOEIC'];
        $stuBas->TOEFL = $re['TOEFL'];
        $stuBas->autobiography = $re['autobiography'];
        $stuBas->Oname = $re['Oname'];
        $stuBas->OS = $re['OS'];
        $stuBas->OR = $re['OR'];
        $stuBas->OW = $re['OW'];
        $stuBas->eduSystem = $re['eduSystem'];
        $stuBas->graduateYear = $re['graduateYear'];
        $stuBas->graduatedSchool = $re['graduatedSchool'];
        $stuBas->department = $re['department'];
        $stuBas->section = $re['section'];
        $stuBas->save();
        if (stuBasicEloquent::count() != 0) { //rowcount
            return '修改基本資料成功';
        } else {
            return '修改基本資料失敗';
        }
    }




    public function deleteJobExperienceById_ser($re)
    {
        $stuJExp = stuJExpEloquent::where('jid', $re['jid'])->first();
        $stuJExp->delete();
        if (stuJExpEloquent::count() != 0) {
            return '刪除工作資料成功';
        } else {
            return '刪除工作資料失敗';
        }
    }


    public function deleteWorksDataById_ser($re)
    {
        $stuWor = stuWorksEloquent::where('wid', $re['wid'])->first();
        $stuWor->delete();
        if (stuWorksEloquent::count() != 0) {
            return '刪除作品資料成功';
        } else {
            return '刪除作品資料失敗';
        }
    }

    public function deleteAbilityById_ser($re){
        $stuA = stuAbilityEloquent::where('abiid', $re['abiid'])->first();
        $stuA->delete();
        if (stuAbilityEloquent::count() != 0) {
            return '刪除能力資料成功';
        } else {
            return '刪除能力資料失敗';
        }
    }
    //修改履歷結束
}