<?php
namespace App\Services;


use App\Job_opening as job_opEloquent;
use App\Jobs\sendResultmail;
use App\User as userEloquent;
class JobopeningServices
{

	public function createJobOpening_ser($re){
		$jobOpen = new job_opEloquent();
        $jobOpen->c_account=$re['c_account'];
		$jobOpen->jtypes=$re['jtypes'];
		$jobOpen->jduties=$re['jduties'];
		$jobOpen->jdetails=$re['jdetails'];
		$jobOpen->jsalary=$re['jsalary'];
		$jobOpen->jcontact_name=$re['jcontact_name'];
		$jobOpen->jcontact_phone=$re['jcontact_phone'];
		$jobOpen->jcontact_email=$re['jcontact_email'];
		$jobOpen->save();
		if (job_opEloquent::count() != 0) {
			return '新增職缺資料成功，待審核';
		} else {
			return '新增職缺資料失敗';
		}
	}

	public function editJobOpening_ser($re){
		$jobOpen = job_opEloquent::where('joid',$re['joid'])->first();
		$jobOpen->jtypes=$re['jtypes'];
		$jobOpen->jduties=$re['jduties'];
		$jobOpen->jdetails=$re['jdetails'];
		$jobOpen->jsalary=$re['jsalary'];
		$jobOpen->jcontact_name=$re['jcontact_name'];
		$jobOpen->jcontact_phone=$re['jcontact_phone'];
		$jobOpen->jcontact_email=$re['jcontact_email'];
		$jobOpen->jstatus=0;
		$jobOpen->save();

		if (job_opEloquent::count() != 0) {
			return '修改職缺資料成功，職缺將撤下待重新審核';
		} else {
			return '修改職缺資料失敗';
		}
	}

	public function deleteJobOpening_ser($re){
		$jobOpen = job_opEloquent::where('joid',$re['joid'])->first();
		$jobOpen->jdelete_reason=$re['jdelete_reason'];
		$jobOpen->jstatus=3;
		$jobOpen->save();

		if (job_opEloquent::count() != 0) {
			return '職缺已刪除';
		} else {
			return '職缺刪除失敗';
		}
	}

	public function reviewJobOpening_ser($re){
		$jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
		$jobOpen->jstatus=$re['jstatus'];
		$jobOpen->save();

		if (job_opEloquent::count() != 0) {
			if($re['jstatus']==1){
				return '職缺審核通過';
			}else{
				return '職缺審核未通過';
			}
		} else {
			return '職缺未審核';
		}
	}
//寄審核結果通知信
    public static  function sendResultMail($content,$joid){
        $jobOpen = job_opEloquent::where('joid', $joid)->first();
        $company=userEloquent::where('account',$jobOpen->c_account)->first();
	    $mail=$company->email;
	    $contents ='您編號為'.$joid.'的'.$content;
        $data = ['mail'=>$mail, 'contents'=>$contents];
        dispatch(new sendResultmail($data));

        return response()->json('sended',200);

    }

}