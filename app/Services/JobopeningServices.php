<?php

namespace App\Services;


use App\Com_basic;
use App\Job_opening as job_opEloquent;
use App\Jobs\sendResultmail;
use App\Jobs\sendResultmail_faild;
use App\Match;
use App\User as userEloquent;
use Carbon\Carbon;
use JWTAuth;
use Log;

class JobopeningServices
{

    public function createJobOpening_ser($re)
    {
        if($re['jdeadline'] < Carbon::now()){
            return '日期錯誤';
        }else{
            $jobOpen = new job_opEloquent();
            $token = JWTAuth::getToken();
            $user = JWTAuth::toUser($token);
            $jobOpen->c_account = $user->account;
            $jobOpen->c_name = $user->u_name;
            $jobOpen->jtypes = $re['jtypes'];
            $jobOpen->jduties = $re['jduties'];
            $jobOpen->jdetails = $re['jdetails'];
            $jobOpen->jsalary_up = $re['jsalary_up'];
            $jobOpen->jsalary_low = $re['jsalary_low'];
            $jobOpen->jaddress = $re['jaddress'];
            $jobOpen->jdeadline = $re['jdeadline'];
            $jobOpen->jNOP = $re['jNOP'];
            $jobOpen->jStartDutyTime = $re['jStartDutyTime'];
            $jobOpen->jEndDutyTime = $re['jEndDutyTime'];
            $jobOpen->jcontact_name = $re['jcontact_name'];
            $jobOpen->jcontact_phone = $re['jcontact_phone'];
            $jobOpen->jcontact_email = $re['jcontact_email'];
//        $jobOpen->jdeadline =Carbon::parse($re['jdeadline'])->format('Y/m/d');
            $jobOpen->save();
            return $jobOpen->joid;
        }

    }

    public function editJobOpening_ser($re)
    {
        if($re['jdeadline'] < Carbon::now()){
            return '日期錯誤';
        }else{
            $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
            if($jobOpen){
                $jobOpen->jtypes = $re['jtypes'];
                $jobOpen->jduties = $re['jduties'];
                $jobOpen->jdetails = $re['jdetails'];
                $jobOpen->jsalary_up = $re['jsalary_up'];
                $jobOpen->jsalary_low = $re['jsalary_low'];
                $jobOpen->jaddress = $re['jaddress'];
                $jobOpen->jdeadline = $re['jdeadline'];
                $jobOpen->jNOP = $re['jNOP'];
                $jobOpen->jStartDutyTime = $re['jStartDutyTime'];
                $jobOpen->jEndDutyTime = $re['jEndDutyTime'];
                $jobOpen->jcontact_name = $re['jcontact_name'];
                $jobOpen->jcontact_phone = $re['jcontact_phone'];
                $jobOpen->jcontact_email = $re['jcontact_email'];
                $jobOpen->save();

                return '修改職缺資料成功';
            }else{
                return '修改職缺資料失敗';
            }
        }



    }

    public function deleteJobOpeningByAdmin_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();
        $jobOpen->jdelete_reason = $re['jdelete_reason'];

        $jobOpen->delete();

        return '職缺已刪除';
    }

    public function deleteJobOpeningByCom_ser($re)
    {
        $jobOpen = job_opEloquent::where('joid', $re['joid'])->first();

        $jobOpen->delete();

        return '職缺已刪除';
    }

    public function sortByTime_DESC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }

                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortByUpdates_DESC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortByTime_ASC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortByUpdates_ASC()->paginate(12);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortBySalary_DESC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortBySalary_DESC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }

    public function sortBySalary_ASC($re)
    {

        $keyword = '%' . $re['keyword'] . '%';
        $jtypes = $re['jtypes'];
        $jsalary_lows = $re['jsalary_lows'];


        if ($re['keyword'] != null) {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes);
                $jobOp = $jobOp->where('jduties', 'like', $keyword)->orWhere('jdetails', 'like', $keyword)->orWhere('c_name', 'like', $keyword)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        } else {
            if ($jsalary_lows != null) {
                $jobOp = job_opEloquent::GetAll()->where('jsalary_low', '>=', $jsalary_lows)->ByTypes($jtypes)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            } else {
                $jobOp = job_opEloquent::GetAll()->ByTypes($jtypes)->SortBySalary_ASC()->paginate(6);
                if ($jobOp) {
                    foreach ($jobOp as $j){
                        $j->jdeadline=Carbon::parse($j->jdeadline)->format('Y/m/d');
                        $j->jResume_num=Match::where('joid',$j->joid)->count();
                        $com=Com_basic::where('c_account',$j->c_account)->first();
                        $j->profilePic=$com->profilePic;
                        $token = JWTAuth::getToken();
                        $user = JWTAuth::toUser($token);
                        if($user->u_status==0){
                            $match=Match::where('joid',$j->joid)->where('sid',$user->id)->first();
                            if($match){
                                if($match->mstatus==2){
                                    $j->jResume_submitted=false;
                                }else{
                                    $j->jResume_submitted=true;
                                }
                            }else{
                                $j->jResume_submitted=false;
                            }
                        }
                    }
                    return $jobOp;
                } else {
                    return '取得職缺資料失敗';
                }
            }
        }
    }
}