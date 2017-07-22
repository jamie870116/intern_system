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
            return '學生送出媒合資料成功';
        } else {
            return '學生送出媒合資料失敗';
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
                    return '廠商拒絕媒合成功';
                } else {
                    return '廠商拒絕媒合失敗';
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
                    return '廠商直接錄取成功';
                } elseif (MatchEloquent::count() != 0||$status==3){
                    return '廠商接受面試成功';
                }else {
                    return '廠商接受面試失敗';
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
                if (MatchEloquent::count() != 0||$status==4) {
                    return '接受面試成功';
                }elseif (MatchEloquent::count() != 0||$status==5){
                    return '拒絕面試成功';
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
//companyFailedInterview_ser
    public function companyFailedInterview_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($match){
            if($match->mstatus==4){
                $match->mfailedreason=$re['mfailedreason'];
                $match->mstatus=8;
                $match->save();
                $user=User::where('id',$match->sid)->first();
                $data = ['mail'=> $user->mail, 'mfailedreason'=>$re['mfailedreason']];
                dispatch(new sendInterviewNoticeMail($data));
                if (MatchEloquent::count() != 0) {
                    return '廠商通知學生未綠取成功';
                } else {
                    return '廠商通知學生未綠取失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }
    //
    public function companyPassInterview_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($match){
            if($match->mstatus==4){
                $match->mstatus=7;
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '廠商通知學生綠取成功';
                } else {
                    return '廠商通知學生綠取失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }

    //
    public function studentAcceptJob_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();
        if($re['mstatus']==1){
            $status=9;
        }else{
            $status=10;
        }
        if($match){
            if($match->mstatus==7){
                $match->mstatus=$status;
                $match->save();
                if (MatchEloquent::count() != 0||$status==9) {
                    return '接受工作成功';
                }elseif (MatchEloquent::count() != 0||$status==10){
                    return '拒絕工作成功';
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
    //
    public function adminFillInTeacher_ser($re){
        $match=MatchEloquent::where('mid',$re['mid'])->first();

        if($match){
            if($match->mstatus==9){
                $match->mstatus=11;
                $match->tid=$re['id'];
                $match->save();
                if (MatchEloquent::count() != 0) {
                    return '選擇實習老師成功';
                }else {
                    return '選擇實習老師失敗';
                }
            }else{
                return '流程錯誤';
            }

        }else{
            return '查無此媒合資料';
        }
    }
}