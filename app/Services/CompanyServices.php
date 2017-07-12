<?php
namespace App\Services;


use App\Com_basic as comEloquent;
use App\User as userEloquent;

class JobopeningServices
{

	public function createCompany_ser($re){
		$com = new comEloquent();

        $com->c_account=$re['c_account'];
        $com->c_account=$re['ctypes'];
        $com->c_account=$re['caddress'];
        $com->c_account=$re['cfax'];
		$com->save();
		if (comEloquent::count() != 0) {
			return '新增廠商資料成功';
		} else {
			return '新增廠商資料失敗';
		}
	}

	public function editCompany_ser($re){
		$com = comEloquent::where('c_account',$re['c_account'])->first();

        $com->c_account=$re['ctypes'];
        $com->c_account=$re['caddress'];
        $com->c_account=$re['cfax'];
		$com->save();
		if (comEloquent::count() != 0) {
			return '修改廠商資料成功';
		} else {
			return '修改廠商資料失敗';
		}
	}

	public function deleteCompany_ser($re){
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

	//
	public function getCompanyByAccount_ser($re){
		$com = comEloquent::where('c_account',$re['c_account'])->first();

		if ($com) {
			return $com;
		} else {
			return '刪除廠商失敗';
		}
	}
}
