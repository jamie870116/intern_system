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

class ResumeService
{

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
//            return response()->json('新增學歷資料成功',200,[], JSON_UNESCAPED_UNICODE);
        } else {
            return '新增學歷資料失敗';
//            return response()->json('新增學歷資料失敗',400,[], JSON_UNESCAPED_UNICODE);
        }
    }

}