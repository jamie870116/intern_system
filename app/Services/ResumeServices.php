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
use App\Stu_licence as stulicenceEloquent;
use App\Stu_works as stuWorksEloquent;
use App\Stu_ability as stuAbilityEloquent;
use JWTAuth;
use Log;
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
            return '新增工作資料成功';
        } else {
            return '新增工作資料失敗';
        }

    }

    public function newLicenseById($re)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;

        $stulic = new stulicenceEloquent($re);
        $stulic->sid = $id;

        $stulic->save();
        if (stulicenceEloquent::count() != 0) { //rowcount
            return '新增證照資料成功';
        } else {
            return '新增證照資料失敗';
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
            return '新增作品資料成功';
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
            return '新增能力資料成功';
        } else {
            return '新增能力資料失敗';
        }
    }

    //新增履歷結束

    //修改履歷開始
    public function editBasicDataById_ser($re)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $id = $user->id;
        $stuBas = stuBasicEloquent::where('sid', $id)->first();
        $stuBas->chiName = $re['chiName'];
        $stuBas->engName = $re['engName'];
        $stuBas->bornedPlace = $re['bornedPlace'];
        $stuBas->nativePlace = $re['nativePlace'];
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




    public function editJobExperienceById_ser($re)
    {
        $stuJExp = stuJExpEloquent::where('jid', $re['jid'])->first();
        $semester = $re['semester'];
        $jobTitle = $re['jobTitle'];

        $stuJExp->semester = $semester;
        $stuJExp->jobTitle = $jobTitle;
        $stuJExp->save();
        if (stuJExpEloquent::count() != 0) {
            return '修改工作資料成功';
        } else {
            return '修改工作資料失敗';
        }
    }

    public function editLicenseById_ser($re)
    {
        $stulic = stulicenceEloquent::where('lid', $re['lid'])->first();
        $agency = $re['agency'];
        $lname = $re['lname'];
        $ldate = $re['ldate'];

        $stulic->agency = $agency;
        $stulic->lname = $lname;
        $stulic->ldate = $ldate;
        $stulic->save();
        if (stulicenceEloquent::count() != 0) {
            return '修改證照資料成功';
        } else {
            return '修改證照資料失敗';
        }
    }


    public function editWorksDataById_ser($re)
    {
        $stuWor = stuWorksEloquent::where('wid', $re['wid'])->first();
        $wName = $re['wName'];
        $wLink = $re['wLink'];
        $wCreatedDate = $re['wCreatedDate'];

        $stuWor->wName = $wName;
        $stuWor->wLink = $wLink;
        $stuWor->wCreatedDate = $wCreatedDate;
        $stuWor->save();
        if (stuWorksEloquent::count() != 0) {
            return '修改作品資料成功';
        } else {
            return '修改作品資料失敗';
        }
    }

    public function editAbilityById_ser($re){
        $stuA = stuAbilityEloquent::where('abiid', $re['abiid'])->first();

        $stuA->abiType = $re['abiType'];
        $stuA->abiName = $re['abiName'];

        $stuA->save();
        if (stuAbilityEloquent::count() != 0) {
            return '修改能力資料成功';
        } else {
            return '修改能力資料失敗';
        }
    }
    //修改履歷結束
}