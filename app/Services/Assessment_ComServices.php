<?php

namespace App\Services;

use JWTAuth;
use App\Assessment_Com as Assessment_ComEloquent;

class Assessment_ComServices{

    public function companyCreateAssessment_ser($re)
    {
        $Assessment_Com = new Assessment_ComEloquent($re);
        $Assessment_Com->save();
        if (Assessment_ComEloquent::count() != 0) {
            return '新增成果資料失敗';
        } else {
            return '新增職缺資料失敗';
        }
    }
}