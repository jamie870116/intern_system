<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/7/19
 * Time: 下午 03:44
 */

namespace App\Services;
use App\Interviews;
use App\Jobs\sendInterviewNoticeMail;
use App\Match as MatchEloquent;
use App\User;

class MatchServices
{
    public function studentSubmitResume_ser($re){
        $match= new MatchEloquent($re);
        $match->save();
        if (MatchEloquent::count() != 0) {
            return '新增媒合資料成功';
        } else {
            return '新增媒合資料失敗';
        }
    }

    public function companyRejectResume_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($match){
            if($match->mstatus==1){
                $match->mfailedreason=$re['mfailedreason'];
                $match->mstatus=2;
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '拒絕媒合成功';
                } else {
                    return '拒絕媒合失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

    public function companyAcceptResume_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($re['mstatus']==1){
            $status=3;
        }else{
            $status=6;
        }
        if($match){
            if($match->mstatus==1){
                $match->mstatus=$status;
                $match->save();
                if (MatchEloquent::count() != 0||$status==6) {
                    return '接受媒合成功，進行接下來的流程去吧';
                } elseif (MatchEloquent::count() != 0||$status==3){

                }else {
                    return '接受媒合失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }
//
    public function companySendInterviewNotice_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        $user=User::where('id',$match->sid)->first();
        if($match){
            if($match->mstatus==3){
              $interview=new Interviews($re);
                $interview->save();
                if (Interviews::count() != 0) {
                    $data = ['mail'=> $user->mail, 'interview'=>$interview];
                    dispatch(new sendInterviewNoticeMail($data));
                    return '成功';
                } else {
                    return '失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

    public function studentAcceptInterview_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($re['mstatus']==1){
            $status=4;
        }else{
            $status=5;
        }
        if($match){
            if($match->mstatus==3){
                $match->mstatus=$status;
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '接受面試成功，進行接下來的流程去吧';
                } else {
                    return '接受面試失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

}