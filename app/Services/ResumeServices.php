<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 2017/7/3
 * Time: 下午 10:33
 */

namespace App\Services;

use App\Stu_basic as stuBasicEloquent;
use App\Stu_edu as stuEduEloquent;
use App\Stu_jExp as stuJExpEloquent;
use App\Stu_licence as stulicenceEloquent;
use App\Stu_relatives as stuRelativesEloquent;
use App\Stu_works as stuWorksEloquent;
use Log;

class ResumeServices
{
//新增履歷開始
    public function newEduDataById($re, $id)
    {
        $school = $re['school'];
        $department = $re['department'];
        $degree = $re['degree'];
        $enterDate = $re['enterDate'];
        $exitDate = $re['exitDate'];
        $graduate = $re['graduate'];

        $stuEdu = new stuEduEloquent();
        $stuEdu->sid = $id;
        $stuEdu->school = $school;
        $stuEdu->department = $department;
        $stuEdu->degree = $degree;
        $stuEdu->enterDate = $enterDate;
        $stuEdu->exitDate = $exitDate;
        $stuEdu->graduate = $graduate;
        $stuEdu->save();
        if (stuEduEloquent::count() != 0) {
            return '新增學歷資料成功';
        } else {
            return '新增學歷資料失敗';
        }
    }

    public function newJobExperienceById($re, $id)
    {

        $semester = $re['semester'];
        $jobTitle = $re['jobTitle'];

        $stuJExp = new stuJExpEloquent();
        $stuJExp->sid = $id;
        $stuJExp->semester = $semester;
        $stuJExp->jobTitle = $jobTitle;
        $stuJExp->save();
        if (stuJExpEloquent::count() != 0) {
            return '新增工作資料成功';
        } else {
            return '新增工作資料失敗';
        }

    }

    public function newLicenseById($re, $id)
    {

        $agency = $re['agency'];
        $lname = $re['lname'];
        $ldate = $re['ldate'];

        $stulic = new stulicenceEloquent();
        $stulic->sid = $id;
        $stulic->agency = $agency;
        $stulic->lname = $lname;
        $stulic->ldate = $ldate;
        $stulic->save();
        if (stulicenceEloquent::count() != 0) { //rowcount
            return '新增證照資料成功';
        } else {
            return '新增證照資料失敗';
        }
    }

    public function newWorksDataById($re, $id)
    {
        $wName = $re['wName'];
        $wLink = $re['wLink'];
        $wCreatedDate = $re['wCreatedDate'];

        $stuWor = new stuWorksEloquent();
        $stuWor->sid = $id;
        $stuWor->wName = $wName;
        $stuWor->wLink = $wLink;
        $stuWor->wCreatedDate = $wCreatedDate;
        $stuWor->save();

        if (stuWorksEloquent::count() != 0) { //rowcount
            return '新增作品資料成功';
        } else {
            return '新增作品資料失敗';
        }

    }

    public function newRelativeDataById($re, $id)
    {
        $rType = $re['rType'];
        $rName = $re['rName'];
        $rAge = $re['rAge'];
        $rEdu = $re['rEdu'];
        $rJob = $re['rJob'];

        $sturel = new stuRelativesEloquent();
        $sturel->sid = $id;
        $sturel->rType = $rType;
        $sturel->rName = $rName;
        $sturel->rAge = $rAge;
        $sturel->rEdu = $rEdu;
        $sturel->rJob = $rJob;
        $sturel->save();

        if (stuRelativesEloquent::count() != 0) { //rowcount
            return '新增親屬資料成功';
        } else {
            return '新增親屬資料失敗';
        }
    }
    //新增履歷結束
    //
    //修改履歷開始
    public function editBasicDataById_ser($re, $id)
    {
        $stuBas = stuBasicEloquent::where('sid', $id)->first();
        $chiName = $re['chiName'];
        $engName = $re['engName'];
        $bornedPlace = $re['bornedPlace'];
        $nativePlace = $re['nativePlace'];
        $birthday = $re['birthday'];
        $gender = $re['gender'];
        $height = $re['height'];
        $weight = $re['weight'];
        $bloodtype = $re['bloodtype'];
        $address = $re['address'];
        $email = $re['email'];
        $contact = $re['contact'];

        $stuBas->chiName = $chiName;
        $stuBas->engName = $engName;
        $stuBas->bornedPlace = $bornedPlace;
        $stuBas->nativePlace = $nativePlace;
        $stuBas->birthday = $birthday;
        $stuBas->gender = $gender;
        $stuBas->height = $height;
        $stuBas->weight = $weight;
        $stuBas->bloodtype = $bloodtype;
        $stuBas->address = $address;
        $stuBas->email = $email;
        $stuBas->contact = $contact;
        $stuBas->save();
        if (stuBasicEloquent::count() != 0) { //rowcount
            return '修改基本資料成功';
        } else {
            return '修改基本資料失敗';
        }
    }

    public function editEduDataById_ser($re, $edu_id)
    {

        $stuEdu = stuEduEloquent::where('edu_id', $edu_id)->first();
        $school = $re['school'];
        $department = $re['department'];
        $degree = $re['degree'];
        $enterDate = $re['enterDate'];
        $exitDate = $re['exitDate'];
        $graduate = $re['graduate'];

        $stuEdu->school = $school;
        $stuEdu->department = $department;
        $stuEdu->degree = $degree;
        $stuEdu->enterDate = $enterDate;
        $stuEdu->exitDate = $exitDate;
        $stuEdu->graduate = $graduate;
        $stuEdu->save();
        if (stuEduEloquent::count() != 0) {
            return '修改學歷資料成功';
        } else {
            return '修改學歷資料失敗';
        }

    }

    public function editJobExperienceById_ser($re, $jid)
    {
        $stuJExp = stuJExpEloquent::where('jid', $jid)->first();
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

    public function editLicenseById_ser($re, $lid)
    {
        $stulic = stulicenceEloquent::where('lid', $lid)->first();
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

    public function editLanguageById_ser($re, $id)
    {
        $stuBas = stuBasicEloquent::where('sid', $id)->first();
        $CL = $re['cl'];
        $CS = $re['cs'];
        $CR = $re['cr'];
        $CW = $re['cw'];
        $EL = $re['el'];
        $ES = $re['es'];
        $ER = $re['er'];
        $EW = $re['ew'];
        $TL = $re['tl'];
        $TS = $re['ts'];

        $stuBas->CL = $CL;
        $stuBas->CS = $CS;
        $stuBas->CR = $CR;
        $stuBas->CW = $CW;
        $stuBas->EL = $EL;
        $stuBas->ES = $ES;
        $stuBas->ER = $ER;
        $stuBas->EW = $EW;
        $stuBas->TL = $TL;
        $stuBas->TS = $TS;
        $stuBas->save();
        if (stuBasicEloquent::count() != 0) {
            return '修改語言能力成功';
        } else {
            return '修改語言能力失敗';
        }
    }

    public function editAbilityById_ser($re, $id)
    {
        $stuBas = stuBasicEloquent::where('sid', $id)->first();
        $dataBase = $re['dataBase'];
        $programmingLanguage = $re['programmingLanguage'];
        $webDesign = $re['webDesign'];
        $document = $re['document'];
        $imageProcessing = $re['imageProcessing'];
        $drawingSoftware = $re['drawingSoftware'];
        $animation = $re['animation'];
        $OS = $re['OS'];
        $musicEditor = $re['musicEditor'];

        $stuBas->dataBase = $dataBase;
        $stuBas->programmingLanguage = $programmingLanguage;
        $stuBas->webDesign = $webDesign;
        $stuBas->document = $document;
        $stuBas->imageProcessing = $imageProcessing;
        $stuBas->drawingSoftware = $drawingSoftware;
        $stuBas->animation = $animation;
        $stuBas->OS = $OS;
        $stuBas->musicEditor = $musicEditor;
        $stuBas->save();
        if (stuBasicEloquent::count() != 0) {
            return '修改電腦技術資料成功';
        } else {
            return '修改電腦技術資料失敗';
        }
    }

    public function editWorksDataById_ser($re, $wid)
    {
        $stuWor = stuWorksEloquent::where('wid', $wid)->first();
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

    public function editRelativeDataById_ser($re, $rid)
    {
        $sturel = stuRelativesEloquent::where('rid', $rid)->first();
        $rType = $re['rType'];
        $rName = $re['rName'];
        $rAge = $re['rAge'];
        $rEdu = $re['rEdu'];
        $rJob = $re['rJob'];
        Log::error($sturel);
        $sturel->rType = $rType;
        $sturel->rName = $rName;
        $sturel->rAge = $rAge;
        $sturel->rEdu = $rEdu;
        $sturel->rJob = $rJob;
        $sturel->save();
        if (stuRelativesEloquent::count() != 0) {
            return '修改親屬資料成功';
        } else {
            return '修改親屬資料失敗';
        }
    }
    //修改履歷結束
}