<?php
namespace App\Services;


use App\Com_basic as comEloquent;
use App\User as userEloquent;
use JWTAuth;

class CompanyServices
{


	public function editCompanyDetails_ser($re){
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
		$com = comEloquent::where('c_account',$user->account)->first();

        $com->ctypes=$re['ctypes'];
        $com->caddress=$re['caddress'];
        $com->cfax=$re['cfax'];
        $com->cintroduction=$re['cintroduction'];
        $com->cempolyee_num=$re['cempolyee_num'];
		$com->save();
		if (comEloquent::count() != 0) {
			return '修改廠商資料成功';
		} else {
			return '修改廠商資料失敗';
		}
	}

	public function adminDeleteCompany_ser($re){
		$com = comEloquent::where('c_account',$re['c_account'])->first();
		$user= userEloquent::where('account',$re['c_account'])->first();
		$com->cdeleteReason=$re['cdeleteReason'];
		$com->save();
        $com->delete();
        $user->started=2;

		$com->save();
		if (comEloquent::count() != 0) {
			return '刪除廠商成功';
		} else {
			return '刪除廠商失敗';
		}
	}

	//依帳號查詢廠商資料
	public function getCompanyDetailsByAccount_ser($re){
		$com = comEloquent::where('c_account',$re['c_account'])->first();

		if ($com) {
			return $com;
		} else {
			return '取得廠商失敗';
		}
	}
}
